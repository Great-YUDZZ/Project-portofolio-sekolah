#!/usr/bin/env python3
"""
Generator Soundtrack & Sound Design 60 Detik (120 BPM) untuk Video Promosi 3D Jurusan TKJ
Menggunakan engine Leonxlnx/earshot v0.4.0:
  - earshot.forge.dsp & earshot.forge.fx (physical modal synthesis, PolyBLEP, Cytomic SVF, 16-line FDN reverb)
  - earshot.forge.bank (mallet/marimba, pluck/kalimba_soft, mallet/celesta, cut_hit, knock)
  - earshot.forge.kit ('launch' preset: bed_level, gain_db, place, space_run, stop_down)
  - skills/real-sound/scripts/master.py (28Hz HPF, mono < 120Hz, 2:1 bus comp, -14 LUFS, true-peak limiter)
"""

import json
import os
import subprocess
import sys

# Pastikan path earshot dan master.py terdaftar
EARSHOT_ROOT = "/home/yudz/.local/share/earshot"
MASTER_DIR = os.path.join(EARSHOT_ROOT, "skills", "real-sound", "scripts")
if EARSHOT_ROOT not in sys.path:
    sys.path.insert(0, EARSHOT_ROOT)
if MASTER_DIR not in sys.path:
    sys.path.insert(0, MASTER_DIR)

import numpy as np
import soundfile as sf
from scipy import signal

from earshot.forge import bank, dsp, fx, kit
import master

SR = 48000
DURATION = 60.0
FPS = 30
BPM = 120
BEAT_S = 60.0 / BPM      # 0.5 detik (15 frame)
BAR_S = BEAT_S * 4       # 2.0 detik (60 frame)
N_SAMPLES = int(DURATION * SR)


def note_to_hz(note_name: str) -> float:
    notes = {'C': 0, 'C#': 1, 'Db': 1, 'D': 2, 'D#': 3, 'Eb': 3,
             'E': 4, 'F': 5, 'F#': 6, 'Gb': 6, 'G': 7, 'G#': 8,
             'Ab': 8, 'A': 9, 'A#': 10, 'Bb': 10, 'B': 11}
    if len(note_name) == 3:
        key = note_name[:2]
        octave = int(note_name[2])
    else:
        key = note_name[0]
        octave = int(note_name[1])
    midi = (octave + 1) * 12 + notes[key]
    return 440.0 * (2.0 ** ((midi - 69) / 12.0))


def add_stereo(buf: np.ndarray, sig: np.ndarray, start_s: float, gain_db: float = 0.0, pan: float = 0.0):
    """Menambahkan sinyal mono atau stereo ke buffer utama dengan constant-power pan."""
    idx = int(round(start_s * SR))
    if idx < 0:
        sig = sig[-idx:]
        idx = 0
    if idx >= len(buf) or len(sig) == 0:
        return
    end = min(len(buf), idx + len(sig))
    seg = sig[:end - idx]
    gain = 10.0 ** (gain_db / 20.0)
    if seg.ndim == 1:
        seg_st = dsp.pan_to_stereo(seg, pan)
    else:
        seg_st = seg
    buf[idx:end] += seg_st * gain


def build_music_bed() -> np.ndarray:
    """
    Membangun music bed 120 BPM berdurasi 60 detik (30 bar) menggunakan instrumen fisik earshot.forge.bank
    dan sintesis analog hangat earshot.forge.dsp + FDN reverb earshot.forge.fx.
    """
    print("[earshot] Merender instrumen dasar dari earshot.forge.bank...")
    r = dsp.rng(2026)
    bed = np.zeros((N_SAMPLES, 2), dtype=np.float64)

    # 1. Pre-render komponen ritmik dari earshot bank agar deterministik & cepat
    kick_punch, _ = bank.render("cut_hit/kick", seed=11, peak_db=-1.0)
    sub_pulse, _ = bank.render("cut_hit/sub", seed=17, peak_db=-1.0)
    wood_tock, _ = bank.render("knock/wood", seed=5, peak_db=-1.0)
    domino_tick, _ = bank.render("fit/tick/domino", seed=2, peak_db=-1.0)
    plastic_snap, _ = bank.render("knock/plastic", seed=3, peak_db=-1.0)

    # 2. Pre-render nada-nada melodis dari earshot bank (marimba, kalimba_soft, celesta, glock)
    scale_notes = ["F3", "G3", "A3", "Bb3", "C4", "D4", "E4", "F4", "G4", "A4", "Bb4", "C5", "D5", "E5", "F5", "G5", "A5"]
    marimba_cache = {}
    kalimba_cache = {}
    celesta_cache = {}

    for n_str in scale_notes:
        hz = note_to_hz(n_str)
        if 150.0 <= hz <= 3000.0:
            marimba_cache[n_str], _ = bank.render("mallet/marimba", seed=1, pitch=hz, peak_db=-1.0)
            kalimba_cache[n_str], _ = bank.render("pluck/kalimba_soft", seed=2, pitch=hz, peak_db=-1.0)
            celesta_cache[n_str], _ = bank.render("mallet/celesta", seed=3, pitch=hz, peak_db=-1.0)

    # Progresi 4 Bar (Dm -> Bb -> F -> C) yang berulang sepanjang 30 bar
    chord_progression = [
        {
            "name": "Dm",
            "bass": "D2",
            "pad": ["D3", "A3", "D4", "F4"],
            "arp": ["D4", "A4", "D5", "F5", "C5", "A4", "F4", "A4"],
            "lead": ["A4", "D5", "F5", "E5"],
        },
        {
            "name": "Bb",
            "bass": "Bb1",
            "pad": ["Bb2", "F3", "Bb3", "D4"],
            "arp": ["Bb3", "F4", "Bb4", "D5", "C5", "Bb4", "F4", "D4"],
            "lead": ["D5", "F5", "C5", "A4"],
        },
        {
            "name": "F",
            "bass": "F1",
            "pad": ["F2", "C3", "A3", "C4"],
            "arp": ["F3", "C4", "F4", "A4", "C5", "A4", "F4", "C4"],
            "lead": ["C5", "A4", "F4", "G4"],
        },
        {
            "name": "C",
            "bass": "C2",
            "pad": ["C3", "G3", "C4", "E4"],
            "arp": ["G3", "C4", "E4", "G4", "C5", "G4", "E4", "C4"],
            "lead": ["G4", "C5", "E5", "C5"],
        },
    ]

    # Buffer terpisah untuk melodis yang akan diberi FDN Reverb earshot
    melodic_bus = np.zeros((N_SAMPLES, 2), dtype=np.float64)

    for bar in range(30):
        bar_start = bar * BAR_S
        prog = chord_progression[bar % 4]

        # Tentukan energi bab berdasarkan nomor bar
        # Bab 1: Bar 0..4 (0-10s)
        # Bab 2: Bar 5..9 (10-20s)
        # Bab 3: Bar 10..16 (20-34s)
        # Bab 4: Bar 17..23 (34-48s)
        # Bab 5: Bar 24..29 (48-60s)
        if bar < 5:
            energy = 0.78 if bar > 0 else 0.68
        elif bar < 10:
            energy = 0.88
        elif bar < 17:
            energy = 0.96
        elif bar < 24:
            energy = 1.00
        elif bar < 28:
            energy = 0.90
        else:
            # Bar 28-29 (56s - 60s): Outro resolve
            energy = 0.72

        energy_db = 20.0 * np.log10(energy)

        # --- A. Warm Analog Pad & Sub Foundation per Bar (2.0s) ---
        pad_dur = BAR_S + 0.15
        pad_sig = np.zeros(dsp.n_of(pad_dur), dtype=np.float64)
        for p_idx, note_name in enumerate(prog["pad"]):
            f_hz = note_to_hz(note_name)
            # Detuned PolyBLEP saw + sine
            s1 = dsp.osc(f_hz * 0.997, shape="saw", seconds=pad_dur, phase=0.1 * p_idx)
            s2 = dsp.osc(f_hz * 1.003, shape="saw", seconds=pad_dur, phase=0.3 * p_idx)
            s_sub = dsp.osc(f_hz, shape="tri", seconds=pad_dur)
            pad_sig += 0.22 * (s1 + s2) + 0.35 * s_sub

        # Filter pad dengan Cytomic SVF (hangat, tidak tajam)
        cutoff_curve = dsp.curve([(0.0, 550.0), (1.0, 950.0 * energy), (pad_dur, 600.0)], len(pad_sig), "exp")
        pad_filtered = dsp.svf(pad_sig, cutoff_curve, q=0.75, mode="low")
        pad_env = dsp.env_curve([(0.0, 0.02), (0.18, 1.0), (BAR_S - 0.15, 0.85), (pad_dur, 0.001)], pad_dur, "lin")
        pad_st = dsp.stereo(pad_filtered * pad_env, r, width=0.55, pan=0.0)
        add_stereo(melodic_bus, pad_st, bar_start, gain_db=-14.5 + energy_db)

        # --- B. Pulsing 120 BPM Bassline & Kick Drum (4 Ketukan per Bar) ---
        bass_hz = note_to_hz(prog["bass"])
        for beat in range(4):
            beat_t = bar_start + beat * BEAT_S

            # Di bar 28-29 (setelah 56.0s), biarkan hanya nada sustain outro yang bersih
            if bar >= 28 and beat > 0:
                continue

            # Kick 120 BPM
            kick_gain = -5.5 + energy_db if beat in (0, 2) else -7.0 + energy_db
            add_stereo(bed, kick_punch, beat_t, gain_db=kick_gain)
            if beat == 0:
                add_stereo(bed, sub_pulse, beat_t, gain_db=-8.0 + energy_db)

            # Bass note pada tiap ketukan (dan off-beat pada Bab 2, 3, 4)
            b_dur = 0.44
            b_osc = (
                0.70 * dsp.osc(bass_hz, shape="sine", seconds=b_dur)
                + 0.30 * dsp.osc(bass_hz * 2.0, shape="saw", seconds=b_dur)
            )
            b_filt = dsp.svf(b_osc, dsp.curve([(0.0, 420.0), (0.12, 190.0), (b_dur, 110.0)], len(b_osc), "exp"), q=1.1, mode="low")
            # Sidechain envelope terhadap kick
            b_env = dsp.env_curve([(0.0, 0.15), (0.045, 1.0), (0.28, 0.65), (b_dur, 0.001)], b_dur, "lin")
            add_stereo(bed, b_filt * b_env, beat_t, gain_db=-9.5 + energy_db, pan=0.0)

            # Off-beat Groove (Domino Tick & Wood Knock)
            if bar < 28:
                add_stereo(bed, domino_tick, beat_t + 0.25, gain_db=-13.5 + energy_db, pan=0.22 if beat % 2 == 0 else -0.22)
                if beat in (1, 3) and bar >= 2:
                    add_stereo(bed, wood_tock, beat_t, gain_db=-11.5 + energy_db, pan=-0.12)
                if bar >= 10 and beat in (1, 3):
                    add_stereo(bed, plastic_snap, beat_t + 0.375, gain_db=-15.0 + energy_db, pan=0.28)

        # --- C. Marimba & Kalimba 1/8 Note Arpeggio (8 Step per Bar, 0.25s per Step) ---
        if bar < 28:
            for step, n_name in enumerate(prog["arp"]):
                step_t = bar_start + step * (BEAT_S / 2.0)
                pan_pos = 0.32 * np.sin(step * np.pi / 4.0)
                if n_name in marimba_cache:
                    m_gain = -11.5 + energy_db if step % 2 == 0 else -13.5 + energy_db
                    add_stereo(melodic_bus, marimba_cache[n_name], step_t, gain_db=m_gain, pan=pan_pos)
                if bar >= 5 and n_name in kalimba_cache and (step % 2 == 1 or bar >= 10):
                    k_gain = -12.5 + energy_db
                    add_stereo(melodic_bus, kalimba_cache[n_name], step_t, gain_db=k_gain, pan=-pan_pos)

        # --- D. Celesta Counter-Motif pada Bab 3, 4 & 5 ---
        if 10 <= bar < 28:
            for beat_i, lead_note in enumerate(prog["lead"]):
                if lead_note in celesta_cache and (beat_i in (0, 2) or (bar >= 17 and beat_i == 3)):
                    c_t = bar_start + beat_i * BEAT_S
                    add_stereo(melodic_bus, celesta_cache[lead_note], c_t, gain_db=-12.0 + energy_db, pan=0.18 * (1 if beat_i % 2 == 0 else -1))

    # Finale Sustain Chord pada Bar 28-29 (56.0s - 59.95s) agar akhir video terasa megah & tuntas
    finale_dur = 3.85
    finale_sig = np.zeros(dsp.n_of(finale_dur), dtype=np.float64)
    for n_name in ["D3", "A3", "D4", "F4", "A4", "D5"]:
        f_hz = note_to_hz(n_name)
        finale_sig += 0.25 * dsp.osc(f_hz * 0.998, "saw", finale_dur) + 0.25 * dsp.osc(f_hz * 1.002, "tri", finale_dur)
    finale_filt = dsp.svf(finale_sig, dsp.curve([(0.0, 1400.0), (2.5, 850.0), (finale_dur, 420.0)], len(finale_sig), "exp"), q=0.8, mode="low")
    finale_env = dsp.env_curve([(0.0, 0.05), (0.12, 1.0), (2.6, 0.75), (finale_dur, 0.01)], finale_dur, "lin")
    add_stereo(melodic_bus, dsp.stereo(finale_filt * finale_env, r, width=0.65), 56.0, gain_db=-9.5)

    # Berikan FDN Reverb earshot pada melodic_bus
    print("[earshot] Memproses melodic bus melalui 16-line FDN reverb (fx.reverb)...")
    melodic_rev = fx.reverb(
        melodic_bus,
        r,
        rt60=1.35,
        size=0.65,
        predelay=0.015,
        damp=0.55,
        wet=0.26,
        stereo=True,
        ir_seed=77,
        grid=True,
    )[:N_SAMPLES]

    bed += melodic_rev

    # Terapkan Stop-Down (mix.stop_down) sebelum transisi bab utama: 10.0s, 20.0s, 34.0s, 48.0s, 56.0s
    stop_down_cuts = [10.0, 20.0, 34.0, 48.0, 56.0]
    gain_env = np.ones(N_SAMPLES, dtype=np.float64)
    for t_cut in stop_down_cuts:
        sd_start = int((t_cut - 0.36) * SR)
        sd_end = int(t_cut * SR)
        if 0 <= sd_start < sd_end <= N_SAMPLES:
            length = sd_end - sd_start
            u = np.linspace(0.0, 1.0, length)
            # Turun hingga -8.5 dB (0.375 linear) lalu kembali tepat saat hit di t_cut
            dip = 1.0 - 0.625 * np.sin(u * np.pi) ** 1.4
            gain_env[sd_start:sd_end] *= dip

    bed *= gain_env[:, None]
    # Tambahkan ruang akustik halus dan noise floor mikrofon agar natural
    bed = dsp.mic(bed, r, low_cut=30.0, air_db=-1.0, floor_db=-64.0)
    return bed


def place_kit_cues(music_bed: np.ndarray, kit_dir: str) -> tuple[np.ndarray, list[dict]]:
    """
    Menempatkan seluruh sound effect dari earshot launch kit (72 takes) di atas music bed
    menggunakan kit.bed_level(), kit.gain_db(), kit.place(), dan kit.space_run().
    """
    lock_path = os.path.join(kit_dir, "kit.lock.json")
    with open(lock_path, "r", encoding="utf-8") as f:
        lock = json.load(f)

    roles = lock["roles"]
    sfx_bus = np.zeros_like(music_bed)
    take_counters = {role_name: 0 for role_name in roles}
    cues_export = []

    def add_cue(role_name: str, cue_s: float, pan: float = 0.0, weight: float = 1.0, pitch_label: str = None, label: str = ""):
        role = roles.get(role_name)
        if not role or not role.get("takes"):
            return
        takes = role["takes"]
        if pitch_label:
            matched = [t for t in takes if t.get("pitch") == pitch_label]
            take = matched[0] if matched else takes[take_counters[role_name] % len(takes)]
        else:
            take = takes[take_counters[role_name] % len(takes)]
            take_counters[role_name] += 1

        wav_path = os.path.join(kit_dir, take["file"])
        y, sr_file = sf.read(wav_path, dtype="float64")
        if sr_file != SR:
            y = signal.resample_poly(y, SR, sr_file, axis=0)

        # Hitung level music bed 1 detik sebelum cue_s dan gain optimal dengan earshot.forge.kit
        bed_lvl = kit.bed_level(music_bed, max(cue_s, 0.35), sr=SR)
        gain_db = kit.gain_db(take, role, bed_lvl) + 20.0 * np.log10(max(weight, 0.25))
        start_s = kit.place(take, role, cue_s)

        add_stereo(sfx_bus, y, start_s, gain_db=gain_db, pan=pan)
        cues_export.append({
            "f": int(round(cue_s * FPS)),
            "t": round(cue_s, 3),
            "kind": role_name,
            "file": take["file"],
            "gain_db": round(float(gain_db), 2),
            "bed_lufs": round(float(bed_lvl), 2) if bed_lvl is not None else None,
            "pan": round(float(pan), 2),
            "label": label,
        })

    # =========================================================================
    # BAB 1: PEMBUKA (0.0s - 10.0s | Frame 0 - 300)
    # =========================================================================
    add_cue("hit", 0.04, pan=0.0, weight=1.0, label="Opening SKENSA 3D Core Reveal")
    add_cue("drop", 0.04, pan=0.0, weight=0.95, label="Opening Sub Drop")
    add_cue("whoosh.short", 0.45, pan=-0.25, weight=0.85, label="3D Ring Orbit Pass")

    # Judul Kinetik Bab 1: "TEKNIK" (1.0s), "KOMPUTER" (1.5s), "& JARINGAN" (2.0s)
    add_cue("pop", 1.00, pan=-0.25, weight=0.9, label="Kinetic Word: TEKNIK")
    add_cue("bell", 1.00, pan=-0.20, weight=0.8, pitch_label="D5", label="Chime D5")
    add_cue("pop", 1.50, pan=0.0, weight=0.9, label="Kinetic Word: KOMPUTER")
    add_cue("bell", 1.50, pan=0.0, weight=0.85, pitch_label="G5", label="Chime G5")
    add_cue("land", 2.00, pan=0.25, weight=1.0, label="Kinetic Word: & JARINGAN (Orange Shift)")
    add_cue("bell", 2.00, pan=0.20, weight=0.9, pitch_label="A5", label="Chime A5")

    add_cue("click.confirm", 3.50, pan=0.0, weight=0.8, label="Subtitle Tagline Reveal")
    add_cue("tock", 5.00, pan=-0.15, weight=0.75, label="3D Fiber Pulse Lock 1")
    add_cue("tock", 7.00, pan=0.15, weight=0.75, label="3D Fiber Pulse Lock 2")

    # =========================================================================
    # BAB 2: IDENTITAS JURUSAN (10.0s - 20.0s | Frame 300 - 600)
    # =========================================================================
    add_cue("whoosh.short", 9.48, pan=-0.15, weight=0.95, label="Chapter 1 Exit Sweep")
    add_cue("hit", 9.50, pan=0.0, weight=1.0, label="Visual Cut Peak 1 (9.50s)")
    add_cue("riser", 9.95, pan=0.0, weight=0.9, label="Riser into Chapter 2")
    add_cue("whoosh.long", 10.00, pan=0.15, weight=0.95, label="Camera Dolly to Station 2")
    add_cue("hit", 10.00, pan=0.0, weight=1.0, label="Chapter 2 Cut Hit")

    add_cue("pop", 10.50, pan=-0.2, weight=0.85, label="Kinetic Word: IDENTITAS")
    add_cue("click", 11.00, pan=0.2, weight=0.9, label="Kinetic Word: JURUSAN")

    # 3 Kartu Fakta Identitas Jurusan (12.0s, 13.5s, 15.0s)
    for idx, (t_card, pitch_n, p_pan) in enumerate([
        (12.00, "C4", -0.25),
        (13.50, "E4", 0.0),
        (15.00, "G4", 0.25),
    ]):
        add_cue("land", t_card, pan=p_pan, weight=0.85, label=f"Identity Card {idx + 1}")
        add_cue("text", t_card + 0.06, pan=p_pan, weight=0.8, pitch_label=pitch_n, label=f"Identity Pluck {idx + 1}")

    add_cue("whoosh.short", 17.00, pan=-0.2, weight=0.75, label="3D TKJ Monolith Orbit")

    # =========================================================================
    # BAB 3: FASILITAS LABORATORIUM (20.0s - 34.0s | Frame 600 - 1020)
    # =========================================================================
    add_cue("whoosh.short", 19.48, pan=0.15, weight=0.95, label="Chapter 2 Exit Sweep")
    add_cue("hit", 19.50, pan=0.0, weight=1.0, label="Visual Cut Peak 2 (19.50s)")
    add_cue("swell", 20.00, pan=0.0, weight=0.9, label="Reverse Swell into Chapter 3")
    add_cue("whoosh.long", 20.00, pan=-0.2, weight=0.95, label="Camera Glide to Station 3 Server Rack")
    add_cue("hit", 20.00, pan=0.0, weight=1.0, label="Chapter 3 Cut Hit")

    add_cue("pop", 20.50, pan=-0.2, weight=0.85, label="Kinetic Word: FASILITAS")
    add_cue("click", 21.00, pan=0.2, weight=0.9, label="Kinetic Word: STANDAR INDUSTRI")
    add_cue("snap", 21.80, pan=0.30, weight=0.9, label="3D Photo Panel Snap: lab_fiber.jpg")

    # 3 Poin Fasilitas (23.0s, 25.0s, 27.0s)
    for idx, (t_fac, p_pan) in enumerate([(23.00, -0.25), (25.00, -0.15), (27.00, -0.05)]):
        add_cue("land", t_fac, pan=p_pan, weight=0.9, label=f"Facility Item {idx + 1}")
        add_cue("click.confirm", t_fac + 0.08, pan=p_pan, weight=0.8, label=f"Facility Confirm {idx + 1}")

    # Typing / CLI Configuration run di Lab Routing (29.5s - 30.5s)
    key_times = kit.space_run([29.50, 29.60, 29.70, 29.82, 29.92, 30.04, 30.15], roles["key"]["min_gap_ms"])
    for k_idx, kt in enumerate(key_times):
        add_cue("key", kt, pan=-0.2 + 0.06 * k_idx, weight=0.65, label=f"Router CLI Key {k_idx + 1}")
    add_cue("key.return", 30.32, pan=0.2, weight=0.8, label="Router CLI Enter")

    # =========================================================================
    # BAB 4: KOMPETENSI & PRESTASI LOMBA (34.0s - 48.0s | Frame 1020 - 1440)
    # =========================================================================
    add_cue("riser", 33.95, pan=0.0, weight=0.95, label="Riser into Chapter 4")
    add_cue("whoosh.long", 34.00, pan=0.2, weight=0.95, label="Camera Orbit to Station 4 Trophy & Topology")
    add_cue("hit", 34.00, pan=0.0, weight=1.0, label="Chapter 4 Cut Hit")

    add_cue("pop", 34.50, pan=-0.2, weight=0.85, label="Kinetic Word: KOMPETENSI")
    add_cue("click", 35.00, pan=0.2, weight=0.9, label="Kinetic Word: & PRESTASI JUARA")
    add_cue("snap", 35.80, pan=0.30, weight=0.9, label="3D Photo Panel Snap: lks_2026.jpg")

    # 3 Skills Pills (36.5s, 37.0s, 37.5s)
    skill_times = kit.space_run([36.50, 37.00, 37.50], roles["pop"]["min_gap_ms"])
    for s_idx, st_time in enumerate(skill_times):
        add_cue("pop", st_time, pan=-0.25 + 0.25 * s_idx, weight=0.85, label=f"Skill Pill {s_idx + 1}")

    # 3 Prestasi Juara LKS & Cyber Security (39.0s, 41.0s, 43.0s)
    for idx, (t_ach, b_pitch, p_pan) in enumerate([
        (39.00, "A5", -0.2),
        (41.00, "C6", 0.0),
        (43.00, "D6", 0.2),
    ]):
        add_cue("land", t_ach, pan=p_pan, weight=0.95, label=f"Achievement Trophy {idx + 1}")
        add_cue("bell", t_ach + 0.04, pan=p_pan, weight=0.9, pitch_label=b_pitch, label=f"Medal Bell {b_pitch}")

    add_cue("whoosh.short", 45.50, pan=0.15, weight=0.8, label="3D Trophy Shimmer Spin")

    # =========================================================================
    # BAB 5: PROSPEK KARIR & PENUTUP (48.0s - 60.0s | Frame 1440 - 1800)
    # =========================================================================
    add_cue("swell", 48.00, pan=0.0, weight=0.9, label="Reverse Swell into Chapter 5")
    add_cue("whoosh.long", 48.00, pan=-0.15, weight=0.95, label="Camera Fly to Station 5 Data Center Towers")
    add_cue("hit", 48.00, pan=0.0, weight=1.0, label="Chapter 5 Cut Hit")

    add_cue("pop", 48.50, pan=-0.2, weight=0.85, label="Kinetic Word: PROSPEK KARIR")
    add_cue("click", 49.00, pan=0.2, weight=0.9, label="Kinetic Word: & MASA DEPAN")
    add_cue("snap", 49.80, pan=0.28, weight=0.9, label="3D Partner Panel Snap: PT Telkom Indonesia")

    # 3 Karir Utama (50.5s, 52.0s, 53.5s)
    for idx, (t_car, pitch_n, p_pan) in enumerate([
        (50.50, "D4", -0.22),
        (52.00, "G4", 0.0),
        (53.50, "A4", 0.22),
    ]):
        add_cue("land", t_car, pan=p_pan, weight=0.9, label=f"Career Card {idx + 1}")
        add_cue("text", t_car + 0.05, pan=p_pan, weight=0.85, pitch_label=pitch_n, label=f"Career Note {pitch_n}")

    # Final Hero Lockup (56.0s - 56.5s | Frame 1680 - 1695)
    add_cue("riser", 55.95, pan=0.0, weight=0.9, label="Final Lockup Riser")
    add_cue("hit", 56.00, pan=0.0, weight=1.0, label="Final Emblem Lockup Hit")
    add_cue("whoosh.short", 56.48, pan=0.0, weight=1.0, label="Final Hero Card Sweep (56.50s)")
    add_cue("hit", 56.50, pan=0.0, weight=1.15, label="Visual Cut Peak 3 (56.50s)")
    add_cue("drop", 56.50, pan=0.0, weight=1.05, label="Final Sub Drop (56.50s)")
    add_cue("bell", 56.52, pan=0.0, weight=1.0, pitch_label="D6", label="Final Resolve Chime D6")
    add_cue("click.confirm", 57.50, pan=0.0, weight=0.85, label="Final CTA Badge Lock")

    full_mix = music_bed + sfx_bus
    # Terapkan Stop-Down tepat sebelum puncak visual 56.50s agar kontras dinamika hit makin tegas
    sd_s = int(56.12 * SR)
    sd_e = int(56.46 * SR)
    if 0 <= sd_s < sd_e <= len(full_mix):
        u_sd = np.linspace(0.0, 1.0, sd_e - sd_s)
        dip_sd = 1.0 - 0.82 * np.sin(u_sd * np.pi) ** 1.2
        full_mix[sd_s:sd_e] *= dip_sd[:, None]

    return full_mix, cues_export


def main():
    base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    kit_dir = os.path.join(base_dir, "audio", "kit")
    out_dir = os.path.join(base_dir, "out")
    remotion_pub = os.path.join(base_dir, "public")
    laravel_media = os.path.join(os.path.dirname(base_dir), "public", "media")
    os.makedirs(out_dir, exist_ok=True)
    os.makedirs(remotion_pub, exist_ok=True)
    os.makedirs(laravel_media, exist_ok=True)

    # 1. Bangun music bed 120 BPM (60.0s)
    music_bed = build_music_bed()

    # 2. Tempatkan seluruh cue SFX dari earshot launch kit
    print("[earshot] Menempatkan 72-take launch kit cues dengan bed_level & gain_db...")
    raw_mix, cues_export = place_kit_cues(music_bed, kit_dir)

    # 3. Mastering menggunakan chain master.finish dari earshot/real-sound
    print("[earshot] Menjalankan mastering chain (master.finish: -14.0 LUFS, ceiling 0.77 / -2.3 dBTP)...")
    master_audio, master_info = master.finish(
        raw_mix,
        lufs=-14.0,
        ceiling=0.77,
        mono_hz=120,
        comp=True,
        drive=1.15,
        air=0.22,
        hp_hz=28,
        fade=0.0,
        end_fade=0.18,
        tail_zero=240,
    )

    master_metrics = master.measure(master_audio)

    # 4. Simpan WAV, MP3, dan file cues JSON
    wav_path = os.path.join(remotion_pub, "tkj_promo_audio.wav")
    mp3_remotion = os.path.join(remotion_pub, "tkj_promo_audio.mp3")
    mp3_laravel = os.path.join(laravel_media, "tkj_promo_audio.mp3")
    cues_path = os.path.join(out_dir, "tkj_cues.json")

    sf.write(wav_path, master_audio, SR, subtype="PCM_24")
    with open(cues_path, "w", encoding="utf-8") as f:
        json.dump(
            {
                "fps": FPS,
                "bpm": BPM,
                "total": int(DURATION * FPS),
                "events": cues_export,
                "master": master_metrics,
            },
            f,
            indent=2,
        )

    for dst in (mp3_remotion, mp3_laravel):
        subprocess.run(
            [
                "ffmpeg", "-y",
                "-i", wav_path,
                "-codec:a", "libmp3lame",
                "-b:a", "256k",
                dst,
            ],
            check=True,
            stdout=subprocess.DEVNULL,
            stderr=subprocess.DEVNULL,
        )

    print(f"[earshot] Audio selesai dirender: {mp3_remotion}")
    print(f"[earshot] Master metrics: {json.dumps(master_metrics)}")


if __name__ == "__main__":
    main()
