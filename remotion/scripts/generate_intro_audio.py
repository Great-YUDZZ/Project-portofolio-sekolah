#!/usr/bin/env python3
"""
Cinematic Sound Design & Baritone Motto Voiceover Generator for SKENSA Intro (5.0s)
Timeline Synchronization:
- 0.00s - 1.25s: Deep Sub-Bass Riser + Precision Mechanical Gear Ratchet Ticks
- 0.55s - 1.35s: Cyan Core Whoosh + Central Emblem Metallic Lock-In (1.00s)
- 1.50s - 4.95s: Majestic Balinese Gong / Orchestral Brass Impact + Golden Shimmer Chord
- 1.58s - 4.65s: Authoritative Baritone Narrator ("Abhyāsad Dhäryate Vidyä. Peliharalah ilmu sampai menjadi tradisi.")
"""

import math
import os
import random
import struct
import subprocess
import wave

SAMPLE_RATE = 48000
DURATION = 5.0
NUM_SAMPLES = int(SAMPLE_RATE * DURATION)


def generate_sfx_bed(wav_path: str) -> None:
    random.seed(1962)  # Founded 1962 deterministic seed
    left = [0.0] * NUM_SAMPLES
    right = [0.0] * NUM_SAMPLES

    # 1. Deep Sub-Bass Riser (0.0s -> 1.48s)
    for i in range(int(0.0 * SAMPLE_RATE), int(1.50 * SAMPLE_RATE)):
        t = i / SAMPLE_RATE
        prog = t / 1.50
        freq = 38.0 + 34.0 * (prog ** 1.7)
        env = math.sin(prog * math.pi) * (0.28 + 0.25 * prog)
        val = math.sin(2.0 * math.pi * freq * t) + 0.35 * math.sin(2.0 * math.pi * (freq * 2.0) * t)
        left[i] += val * env * 0.45
        right[i] += val * env * 0.45

    # 2. Mechanical Gear Ratchet Ticks (0.08s -> 1.25s, decelerating as gear locks)
    tick_times = [0.08, 0.14, 0.21, 0.29, 0.38, 0.48, 0.59, 0.71, 0.84, 0.98, 1.13, 1.26]
    for idx, t_start in enumerate(tick_times):
        start_idx = int(t_start * SAMPLE_RATE)
        tick_len = int(0.035 * SAMPLE_RATE)
        pan = 0.5 + 0.25 * math.sin(idx * 0.9)
        for j in range(tick_len):
            if start_idx + j >= NUM_SAMPLES:
                break
            dt = j / SAMPLE_RATE
            env = math.exp(-dt * 140.0)
            # Metallic precision click (high resonance + low thud)
            sig = (
                0.6 * math.sin(2.0 * math.pi * 1450.0 * dt)
                + 0.4 * math.sin(2.0 * math.pi * 2820.0 * dt)
                + 0.5 * math.sin(2.0 * math.pi * 220.0 * dt)
            )
            left[start_idx + j] += sig * env * 0.22 * pan
            right[start_idx + j] += sig * env * 0.22 * (1.0 - pan)

    # 3. Cyan Core Expansion Whoosh (0.50s -> 1.35s) & Central Lock Impact (0.98s)
    lp_state_l = 0.0
    lp_state_r = 0.0
    for i in range(int(0.50 * SAMPLE_RATE), int(1.38 * SAMPLE_RATE)):
        t = (i / SAMPLE_RATE) - 0.50
        prog = t / 0.88
        env = math.sin(prog * math.pi) ** 1.8
        noise_l = random.uniform(-1.0, 1.0)
        noise_r = random.uniform(-1.0, 1.0)
        alpha = 0.04 + 0.18 * math.sin(prog * math.pi)
        lp_state_l = lp_state_l + alpha * (noise_l - lp_state_l)
        lp_state_r = lp_state_r + alpha * (noise_r - lp_state_r)
        left[i] += lp_state_l * env * 0.28
        right[i] += lp_state_r * env * 0.28

    # Central Emblem Snap-In Metallic Lock at 0.98s
    lock_start = int(0.98 * SAMPLE_RATE)
    for j in range(int(0.28 * SAMPLE_RATE)):
        if lock_start + j >= NUM_SAMPLES:
            break
        dt = j / SAMPLE_RATE
        env = math.exp(-dt * 28.0)
        sig = (
            0.7 * math.sin(2.0 * math.pi * 92.0 * dt * math.exp(-dt * 8.0))
            + 0.35 * math.sin(2.0 * math.pi * 640.0 * dt) * math.exp(-dt * 45.0)
            + 0.25 * math.sin(2.0 * math.pi * 1920.0 * dt) * math.exp(-dt * 70.0)
        )
        left[lock_start + j] += sig * env * 0.42
        right[lock_start + j] += sig * env * 0.42

    # 4. STAGE 4 (1.50s): Grand Balinese Gong / Orchestral Brass Impact + Golden Shimmer Chord
    hit_start = int(1.48 * SAMPLE_RATE)
    # D Major / Majestic Fifths & Ninths: D1, D2, A2, D3, F#3, A3, D4, E4, A4
    chord_notes = [
        (36.71, 0.55, 1.2, 0.50),   # Sub D1
        (73.42, 0.50, 1.1, 0.48),   # Deep Brass/Gong D2
        (110.00, 0.32, 1.3, 0.35),  # Fifth A2
        (146.83, 0.35, 1.4, 0.65),  # Octave D3
        (185.00, 0.22, 1.6, 0.30),  # Major Third F#3
        (220.00, 0.25, 1.7, 0.70),  # Fifth A3
        (293.66, 0.18, 2.0, 0.40),  # High D4
        (587.33, 0.10, 2.6, 0.62),  # Golden Shimmer D5
        (880.00, 0.07, 3.0, 0.38),  # Crystal Chime A5
    ]

    for j in range( NUM_SAMPLES - hit_start ):
        dt = j / SAMPLE_RATE
        # Fast cinematic attack (18ms)
        attack = min(1.0, dt / 0.018)
        # Subtle Balinese Gong ombak (warm beating modulation ~2.4Hz)
        ombak = 1.0 + 0.08 * math.sin(2.0 * math.pi * 2.4 * dt)

        sample_l = 0.0
        sample_r = 0.0

        # Initial cinematic impact punch (first 180ms)
        if dt < 0.22:
            punch_env = math.exp(-dt * 24.0)
            punch_freq = 115.0 * math.exp(-dt * 12.0) + 38.0
            punch = math.sin(2.0 * math.pi * punch_freq * dt) * punch_env * 0.55
            sample_l += punch
            sample_r += punch

        for freq, amp, decay_rate, pan in chord_notes:
            env = attack * math.exp(-dt * decay_rate)
            # Warm brass/gong harmonic richness
            tone = (
                math.sin(2.0 * math.pi * freq * ombak * dt)
                + 0.28 * math.sin(2.0 * math.pi * (freq * 2.0) * dt) * math.exp(-dt * 1.8)
                + 0.12 * math.sin(2.0 * math.pi * (freq * 3.0) * dt) * math.exp(-dt * 2.5)
            )
            sample_l += tone * amp * env * pan
            sample_r += tone * amp * env * (1.0 - pan)

        # Smooth fade out in last 0.35s of the 5.0s clip
        total_t = (hit_start + j) / SAMPLE_RATE
        tail_fade = 1.0
        if total_t > 4.60:
            tail_fade = max(0.0, (5.0 - total_t) / 0.40)

        left[hit_start + j] += sample_l * 0.42 * tail_fade
        right[hit_start + j] += sample_r * 0.42 * tail_fade

    # Write 16-bit PCM Stereo WAV
    with wave.open(wav_path, 'w') as wf:
        wf.setnchannels(2)
        wf.setsampwidth(2)
        wf.setframerate(SAMPLE_RATE)
        frames = bytearray()
        for i in range(NUM_SAMPLES):
            l_val = max(-0.96, min(0.96, left[i]))
            r_val = max(-0.96, min(0.96, right[i]))
            frames.extend(struct.pack('<hh', int(l_val * 32767), int(r_val * 32767)))
        wf.writeframes(frames)


def main() -> None:
    base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    tmp_dir = '/tmp/skensa_audio_build'
    os.makedirs(tmp_dir, exist_ok=True)

    sfx_wav = os.path.join(tmp_dir, 'sfx_bed.wav')
    tts_part1 = os.path.join(tmp_dir, 'tts_part1.mp3')
    tts_part2 = os.path.join(tmp_dir, 'tts_part2.mp3')
    out_remotion_mp3 = os.path.join(base_dir, 'public', 'intro_audio.mp3')
    out_public_mp3 = os.path.abspath(os.path.join(base_dir, '..', 'public', 'media', 'intro_audio.mp3'))

    print('1. Synthesizing 5.0s Cinematic SFX Bed (Sub-bass, Gear Ratchets, Gong/Brass Impact)...')
    generate_sfx_bed(sfx_wav)

    print('2. Generating Authoritative Baritone Narrator Voiceover via edge-tts (id-ID-ArdiNeural)...')
    # Part 1: Sanskrit Motto (spoken as central emblem locks in and golden impact strikes)
    subprocess.run(
        [
            '/home/yudz/.local/bin/uvx',
            'edge-tts',
            '--voice',
            'id-ID-ArdiNeural',
            '--rate=+6%',
            '--pitch=-6Hz',
            '--text',
            'Abhyasad Dharyate Widya.',
            '--write-media',
            tts_part1,
        ],
        check=True,
    )
    # Part 2: Indonesian Translation (spoken as motto banner & harmonic aura rings glow)
    subprocess.run(
        [
            '/home/yudz/.local/bin/uvx',
            'edge-tts',
            '--voice',
            'id-ID-ArdiNeural',
            '--rate=+10%',
            '--pitch=-5Hz',
            '--text',
            'Peliharalah ilmu sampai menjadi tradisi.',
            '--write-media',
            tts_part2,
        ],
        check=True,
    )

    print('3. Mastering SFX Bed + Grand Hall Reverb Narrator with FFmpeg...')
    # Trim leading/trailing silence from each TTS clip, align Part 1 at 1350ms and Part 2 at 2760ms
    filter_complex = (
        '[0:a]volume=0.85[sfx];'
        '[1:a]silenceremove=start_periods=1:start_silence=0.02:start_threshold=-40dB,'
        'asetpts=PTS-STARTPTS,adelay=1350|1350[v1];'
        '[2:a]silenceremove=start_periods=1:start_silence=0.02:start_threshold=-40dB,'
        'asetpts=PTS-STARTPTS,adelay=2760|2760[v2];'
        '[v1][v2]amix=inputs=2:duration=longest:dropout_transition=0:normalize=0,'
        'equalizer=f=130:width_type=o:width=1.2:g=4.5,'
        'equalizer=f=3200:width_type=o:width=1.5:g=2.8,'
        'aecho=0.85:0.75:55|110:0.22|0.12,'
        'volume=1.50[vo];'
        '[sfx][vo]amix=inputs=2:duration=first:dropout_transition=0:normalize=0,'
        'alimiter=limit=0.95:attack=5:release=50,'
        'afade=t=out:st=4.78:d=0.22[out]'
    )

    subprocess.run(
        [
            'ffmpeg',
            '-y',
            '-i',
            sfx_wav,
            '-i',
            tts_part1,
            '-i',
            tts_part2,
            '-filter_complex',
            filter_complex,
            '-map',
            '[out]',
            '-c:a',
            'libmp3lame',
            '-b:a',
            '320k',
            '-ar',
            '48000',
            out_remotion_mp3,
        ],
        check=True,
    )

    os.makedirs(os.path.dirname(out_public_mp3), exist_ok=True)
    subprocess.run(['cp', out_remotion_mp3, out_public_mp3], check=True)
    print(f'Done! Master audio written to:\n  - {out_remotion_mp3}\n  - {out_public_mp3}')


if __name__ == '__main__':
    main()
