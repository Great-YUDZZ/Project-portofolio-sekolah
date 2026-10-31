#!/usr/bin/env python3
"""
Minimalist 3D Sound Design Generator for SKENSA Intro (5.5s, No Voiceover)
Timeline Synchronization:
- 0.08s - 2.58s: Soft 3D Spatial Air Movement (gentle filtered air glide as 3D layers travel across Z-space)
- 1.40s: Tactile Mechanical Click 1 (Outer 24-tooth gear locks into place)
- 2.00s: Tactile Mechanical Click 2 (Inner 8-tooth navy gear locks into place)
- 2.60s: Master Precision Lock Click (Central scholar & book emblem locks orthogonally at 0 deg)
- 2.62s - 5.45s: Warm Minimalist Harmonic Pad + Crystalline Light-Sweep Shimmer (2.65s - 3.45s)
"""

import math
import os
import random
import struct
import subprocess
import wave

SAMPLE_RATE = 48000
DURATION = 5.5
NUM_SAMPLES = int(SAMPLE_RATE * DURATION)


def add_tactile_click(
    left: list[float],
    right: list[float],
    time_sec: float,
    body_freq: float,
    click_freq: float,
    amp_scale: float,
    pan_l: float = 0.5,
) -> None:
    lock_idx = int(time_sec * SAMPLE_RATE)
    lock_len = int(0.15 * SAMPLE_RATE)
    pan_r = 1.0 - pan_l
    for j in range(lock_len):
        if lock_idx + j >= NUM_SAMPLES:
            break
        dt = j / SAMPLE_RATE
        thud = (
            math.sin(2.0 * math.pi * body_freq * dt * math.exp(-dt * 12.0))
            * math.exp(-dt * 36.0)
            * 0.20
            * amp_scale
        )
        click = (
            math.sin(2.0 * math.pi * click_freq * dt)
            * math.exp(-dt * 140.0)
            * 0.075
            * amp_scale
        )
        sample = thud + click
        left[lock_idx + j] += sample * (0.5 + (pan_l - 0.5) * 0.5)
        right[lock_idx + j] += sample * (0.5 + (pan_r - 0.5) * 0.5)


def generate_minimalist_sfx(wav_path: str) -> None:
    random.seed(1962)
    left = [0.0] * NUM_SAMPLES
    right = [0.0] * NUM_SAMPLES

    # 1. Soft 3D Spatial Air Movement during Blueprint Awakening & Exploded Assembly (0.08s -> 2.58s)
    lp_l = 0.0
    lp_r = 0.0
    lp2_l = 0.0
    lp2_r = 0.0
    start_whoosh = int(0.08 * SAMPLE_RATE)
    end_whoosh = int(2.58 * SAMPLE_RATE)
    whoosh_len = end_whoosh - start_whoosh

    for i in range(start_whoosh, end_whoosh):
        prog = (i - start_whoosh) / whoosh_len
        # Gentle two-wave breath matching the blueprint awakening and deep Z-assembly
        env = (math.sin(prog * math.pi) ** 1.6) * (
            0.78 + 0.22 * math.sin(prog * math.pi * 2.5)
        )
        pan_l = 0.64 - 0.14 * prog
        pan_r = 0.36 + 0.14 * prog

        n_l = random.uniform(-1.0, 1.0)
        n_r = random.uniform(-1.0, 1.0)
        cutoff = 0.012 + 0.036 * math.sin(prog * math.pi)
        lp_l += cutoff * (n_l - lp_l)
        lp_r += cutoff * (n_r - lp_r)
        lp2_l += cutoff * (lp_l - lp2_l)
        lp2_r += cutoff * (lp_r - lp2_r)

        t = (i - start_whoosh) / SAMPLE_RATE
        warm_sub = (
            math.sin(2.0 * math.pi * (56.0 + 28.0 * prog) * t) * env * 0.11
        )

        left[i] += (lp2_l * env * 0.13 * pan_l) + warm_sub
        right[i] += (lp2_r * env * 0.13 * pan_r) + warm_sub

    # 2. Multi-Step Tactile Mechanical Gear Locks (1.40s, 2.00s, and 2.60s)
    # Lock 1: Outer 24-tooth gear locks at 1.40s
    add_tactile_click(
        left,
        right,
        time_sec=1.40,
        body_freq=92.0,
        click_freq=1380.0,
        amp_scale=0.68,
        pan_l=0.56,
    )
    # Lock 2: Inner 8-tooth navy gear locks at 2.00s
    add_tactile_click(
        left,
        right,
        time_sec=2.00,
        body_freq=104.0,
        click_freq=1560.0,
        amp_scale=0.78,
        pan_l=0.44,
    )
    # Lock 3: Master central scholar & book lock at 2.60s
    add_tactile_click(
        left,
        right,
        time_sec=2.60,
        body_freq=116.0,
        click_freq=1780.0,
        amp_scale=1.00,
        pan_l=0.50,
    )

    # 3. Minimalist Warm Harmonic Chime Pad upon Master Lock (2.60s -> 5.45s)
    chime_start = int(2.60 * SAMPLE_RATE)
    notes = [
        (146.83, 0.16, 1.05, 0.50),  # D3
        (220.00, 0.12, 1.15, 0.44),  # A3
        (293.66, 0.10, 1.30, 0.56),  # D4
        (369.99, 0.07, 1.50, 0.40),  # F#4
        (440.00, 0.06, 1.70, 0.60),  # A4
    ]

    for j in range(NUM_SAMPLES - chime_start):
        dt = j / SAMPLE_RATE
        attack = min(1.0, dt / 0.05)
        s_l = 0.0
        s_r = 0.0

        for freq, amp, decay, pan in notes:
            env = attack * math.exp(-dt * decay)
            tone = math.sin(2.0 * math.pi * freq * dt) + 0.14 * math.sin(
                2.0 * math.pi * (freq * 2.0) * dt
            ) * math.exp(-dt * 2.2)
            s_l += tone * amp * env * pan
            s_r += tone * amp * env * (1.0 - pan)

        total_t = (chime_start + j) / SAMPLE_RATE
        fade_out = 1.0
        if total_t > 4.75:
            fade_out = max(0.0, (5.46 - total_t) / 0.71)

        left[chime_start + j] += s_l * fade_out
        right[chime_start + j] += s_r * fade_out

    # 4. Subtle Light-Sweep & Motto Shimmer (2.65s -> 3.45s, stereo left-to-right)
    sweep_start = int(2.65 * SAMPLE_RATE)
    sweep_end = int(3.45 * SAMPLE_RATE)
    sweep_len = sweep_end - sweep_start
    for i in range(sweep_start, sweep_end):
        prog = (i - sweep_start) / sweep_len
        dt = (i - sweep_start) / SAMPLE_RATE
        env = math.sin(prog * math.pi) ** 1.8
        pan_r = 0.25 + 0.55 * prog
        pan_l = 1.0 - pan_r
        shimmer = (
            0.030 * math.sin(2.0 * math.pi * 587.33 * dt)
            + 0.020 * math.sin(2.0 * math.pi * 880.00 * dt)
        ) * env
        left[i] += shimmer * pan_l
        right[i] += shimmer * pan_r

    with wave.open(wav_path, 'w') as wf:
        wf.setnchannels(2)
        wf.setsampwidth(2)
        wf.setframerate(SAMPLE_RATE)
        frames = bytearray()
        for i in range(NUM_SAMPLES):
            l_val = max(-0.92, min(0.92, left[i]))
            r_val = max(-0.92, min(0.92, right[i]))
            frames.extend(
                struct.pack('<hh', int(l_val * 32767), int(r_val * 32767))
            )
        wf.writeframes(frames)


def main() -> None:
    base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    tmp_dir = '/tmp/skensa_audio_build'
    os.makedirs(tmp_dir, exist_ok=True)

    sfx_wav = os.path.join(tmp_dir, 'sfx_minimalist_5_5s.wav')
    out_remotion_mp3 = os.path.join(base_dir, 'public', 'intro_audio.mp3')
    out_public_mp3 = os.path.abspath(
        os.path.join(base_dir, '..', 'public', 'media', 'intro_audio.mp3')
    )

    print(
        '1. Synthesizing 5.5s Minimalist 3D SFX (Multi-Step Gear Clicks at 1.4s, 2.0s, 2.6s + Shimmer)...'
    )
    generate_minimalist_sfx(sfx_wav)

    print('2. Encoding high-clarity stereo MP3...')
    filter_complex = (
        '[0:a]aecho=0.8:0.7:45|90:0.14|0.08,'
        'alimiter=limit=0.88:attack=5:release=50,'
        'afade=t=out:st=4.85:d=0.62[out]'
    )

    subprocess.run(
        [
            'ffmpeg',
            '-y',
            '-i',
            sfx_wav,
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
    print(
        f'Done! Minimalist 5.5s 3D audio written to:\n  - {out_remotion_mp3}\n  - {out_public_mp3}'
    )


if __name__ == '__main__':
    main()
