import React, { useMemo } from 'react';
import {
    AbsoluteFill,
    Audio,
    Easing,
    Img,
    interpolate,
    interpolateColors,
    spring,
    staticFile,
    useCurrentFrame,
    useVideoConfig,
} from 'remotion';
import { ThreeCanvas } from '@remotion/three';
import * as THREE from 'three';

/**
 * Palet Warna Resmi Video Promosi 3D TKJ SKENSA:
 * - Deep Navy (Logo Sekolah): #06132B, #071C3F, #0F2952
 * - Steel Blue (Logo Sekolah): #2B5B91
 * - SKENSA Cyan (Logo Sekolah): #35B8C4, #5CE1E6
 * - TKJ Shirt Orange (Identitas Baju Jurusan TKJ): #F97316, #EA580C, #FB923C
 * - Ice White: #F8FAFC
 * Tanpa warna kuning sama sekali.
 */
const PALETTE = {
    bgDeep: '#051024',
    navyDark: '#071C3F',
    navyMid: '#0F2952',
    steelBlue: '#2B5B91',
    cyan: '#35B8C4',
    cyanBright: '#5CE1E6',
    orange: '#F97316',
    orangeDeep: '#EA580C',
    orangeSoft: '#FB923C',
    white: '#F8FAFC',
    slateMuted: '#94A3B8',
};

const BPM = 120;
const FPS = 30;
const FRAMES_PER_BEAT = 15; // 0.5s per beat @ 30fps

// Koordinat 5 Stasiun 3D untuk Continuous Camera Journey
const STATIONS = [
    { pos: [0, 0, 0] as [number, number, number], cam: [0, 0.4, 8.8] as [number, number, number] },         // Bab 1: Pembuka (0 - 10s)
    { pos: [16, 1.2, -14] as [number, number, number], cam: [14.2, 1.6, -5.4] as [number, number, number] }, // Bab 2: Identitas (10 - 20s)
    { pos: [-16, 1.8, -28] as [number, number, number], cam: [-14.0, 2.2, -19.2] as [number, number, number] }, // Bab 3: Fasilitas (20 - 34s)
    { pos: [16, 2.2, -42] as [number, number, number], cam: [14.2, 2.6, -33.2] as [number, number, number] }, // Bab 4: Kompetensi & Prestasi (34 - 48s)
    { pos: [0, 2.8, -56] as [number, number, number], cam: [0, 3.2, -47.0] as [number, number, number] },   // Bab 5: Prospek Karir (48 - 56s)
    { pos: [0, 3.0, -56] as [number, number, number], cam: [0, 3.0, -48.2] as [number, number, number] },   // Finale Lockup (56 - 60s)
];

function createGearShape(outerRadius: number, innerRadius: number, holeRadius: number, teeth: number): THREE.Shape {
    const shape = new THREE.Shape();
    const step = (Math.PI * 2) / teeth;
    for (let i = 0; i < teeth; i++) {
        const a0 = i * step;
        const a1 = a0 + step * 0.22;
        const a2 = a0 + step * 0.32;
        const a3 = a0 + step * 0.68;
        const a4 = a0 + step * 0.78;
        const p0x = Math.cos(a0) * innerRadius;
        const p0y = Math.sin(a0) * innerRadius;
        if (i === 0) {
            shape.moveTo(p0x, p0y);
        } else {
            shape.lineTo(p0x, p0y);
        }
        shape.lineTo(Math.cos(a1) * innerRadius, Math.sin(a1) * innerRadius);
        shape.lineTo(Math.cos(a2) * outerRadius, Math.sin(a2) * outerRadius);
        shape.lineTo(Math.cos(a3) * outerRadius, Math.sin(a3) * outerRadius);
        shape.lineTo(Math.cos(a4) * innerRadius, Math.sin(a4) * innerRadius);
    }
    shape.closePath();

    const hole = new THREE.Path();
    hole.absarc(0, 0, holeRadius, 0, Math.PI * 2, true);
    shape.holes.push(hole);
    return shape;
}

/**
 * Kamera 3D berkesinambungan yang melintasi 5 Stasiun 3D sesuai bar 120 BPM
 */
const ContinuousCameraRig: React.FC<{ frame: number }> = ({ frame }) => {
    const camRef = React.useRef<THREE.Group>(null);
    const { camera } = useMemo(() => ({ camera: null }), []);

    // Keyframes perpindahan stasiun:
    // Bab 1: 0..270 (tahan di Stasiun 1), 270..315 (transisi ke Stasiun 2)
    // Bab 2: 315..570 (tahan di Stasiun 2), 570..615 (transisi ke Stasiun 3)
    // Bab 3: 615..990 (tahan di Stasiun 3), 990..1035 (transisi ke Stasiun 4)
    // Bab 4: 1035..1410 (tahan di Stasiun 4), 1410..1455 (transisi ke Stasiun 5)
    // Bab 5: 1455..1665 (tahan di Stasiun 5), 1665..1695 (kunci ke Finale)
    return null;
};

/**
 * Seluruh Dunia 3D TKJ (5 Stasiun + Jalur Kabel Serat Optik Antar Stasiun)
 * Kita menggerakkan grup dunia (World Group) terhadap kamera utama di [0, 0, 8.8]
 * agar pergerakan dolly, pan, dan orbit 100% deterministik di setiap frame Remotion.
 */
const TkjWorld3D: React.FC<{ frame: number }> = ({ frame }) => {
    const beatPhase = (frame % FRAMES_PER_BEAT) / FRAMES_PER_BEAT;
    const beatPulse = Math.exp(-beatPhase * 4.5);

    // Hitung interpolasi stasiun dengan kurva bezier sinematik
    const t12 = interpolate(frame, [275, 315], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.32, 0, 0.18, 1),
    });
    const t23 = interpolate(frame, [575, 615], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.32, 0, 0.18, 1),
    });
    const t34 = interpolate(frame, [995, 1035], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.32, 0, 0.18, 1),
    });
    const t45 = interpolate(frame, [1415, 1455], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.32, 0, 0.18, 1),
    });
    const t5F = interpolate(frame, [1665, 1695], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.25, 0.1, 0.25, 1),
    });

    // Posisi fokus stasiun saat ini
    const focusX =
        STATIONS[0].pos[0] +
        (STATIONS[1].pos[0] - STATIONS[0].pos[0]) * t12 +
        (STATIONS[2].pos[0] - STATIONS[1].pos[0]) * t23 +
        (STATIONS[3].pos[0] - STATIONS[2].pos[0]) * t34 +
        (STATIONS[4].pos[0] - STATIONS[3].pos[0]) * t45;

    const focusY =
        STATIONS[0].pos[1] +
        (STATIONS[1].pos[1] - STATIONS[0].pos[1]) * t12 +
        (STATIONS[2].pos[1] - STATIONS[1].pos[1]) * t23 +
        (STATIONS[3].pos[1] - STATIONS[2].pos[1]) * t34 +
        (STATIONS[4].pos[1] - STATIONS[3].pos[1]) * t45;

    const focusZ =
        STATIONS[0].pos[2] +
        (STATIONS[1].pos[2] - STATIONS[0].pos[2]) * t12 +
        (STATIONS[2].pos[2] - STATIONS[1].pos[2]) * t23 +
        (STATIONS[3].pos[2] - STATIONS[2].pos[2]) * t34 +
        (STATIONS[4].pos[2] - STATIONS[3].pos[2]) * t45;

    // Geser objek 3D ke area kosong yang ideal pada setiap bab agar tidak bertabrakan dengan kartu teks
    const stageOffsetX = interpolate(
        frame,
        [0, 275, 315, 575, 615, 995, 1035, 1415, 1455, 1665, 1695, 1800],
        [0, 0, 2.55, 2.55, 0.55, 0.55, 0.55, 0.55, 0.55, 0.55, 0, 0],
        { extrapolateLeft: 'clamp', extrapolateRight: 'clamp' }
    );

    const stageOffsetY = interpolate(
        frame,
        [0, 275, 315, 1665, 1695, 1800],
        [0.72, 0.72, -0.05, -0.05, 0.72, 0.72],
        { extrapolateLeft: 'clamp', extrapolateRight: 'clamp' }
    );

    // Visibilitas skala per stasiun agar stasiun yang jauh tidak mengotori latar belakang bab lain
    const s1Scale = interpolate(frame, [0, 280, 320], [0.76, 0.76, 0.001], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const s2Scale = interpolate(frame, [270, 315, 575, 620], [0.001, 0.92, 0.92, 0.001], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const s3Scale = interpolate(frame, [570, 615, 995, 1040], [0.001, 0.88, 0.88, 0.001], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const s4Scale = interpolate(frame, [990, 1035, 1415, 1460], [0.001, 0.92, 0.92, 0.001], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const s5Scale = interpolate(frame, [1410, 1455, 1665, 1695], [0.001, 0.88, 0.88, 0.45], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });

    // Kunci gerakan goyang saat sudah di Finale Lockup (>= 1695)
    const activeFloat = frame < 1695 ? Math.sin(frame * 0.04) * 0.05 : 0;
    const worldRotY = frame < 1695 ? Math.sin(frame * 0.025) * 0.06 : 0;

    // Geometri Roda Gigi SKENSA untuk Stasiun 1 & Finale
    const { outerGearGeo, innerGearGeo } = useMemo(() => {
        const g1 = new THREE.ExtrudeGeometry(createGearShape(1.55, 1.32, 1.02, 16), {
            depth: 0.22,
            bevelEnabled: true,
            bevelSegments: 3,
            steps: 1,
            bevelSize: 0.03,
            bevelThickness: 0.03,
        });
        g1.center();

        const g2 = new THREE.ExtrudeGeometry(createGearShape(0.95, 0.78, 0.42, 12), {
            depth: 0.28,
            bevelEnabled: true,
            bevelSegments: 3,
            steps: 1,
            bevelSize: 0.03,
            bevelThickness: 0.03,
        });
        g2.center();
        return { outerGearGeo: g1, innerGearGeo: g2 };
    }, []);

    // Jalur Serat Optik 3D yang menghubungkan Stasiun 1 -> 2 -> 3 -> 4 -> 5 saat kamera berpindah
    const highwayCurve = useMemo(() => {
        return new THREE.CatmullRomCurve3([
            new THREE.Vector3(0, -1.85, 0),
            new THREE.Vector3(16, -0.6, -14),
            new THREE.Vector3(-16, 0.0, -28),
            new THREE.Vector3(16, 0.4, -42),
            new THREE.Vector3(0, 1.0, -56),
        ]);
    }, []);

    const highwayGeoCyan = useMemo(() => new THREE.TubeGeometry(highwayCurve, 120, 0.032, 8, false), [highwayCurve]);

    return (
        <group
            position={[-focusX + stageOffsetX, -focusY + stageOffsetY + activeFloat, -focusZ]}
            rotation={[0, worldRotY, 0]}
        >
            {/* JALUR KABEL FIBER OPTIK UTAMA ANTAR STASIUN */}
            <mesh geometry={highwayGeoCyan}>
                <meshStandardMaterial
                    color={PALETTE.cyan}
                    emissive={PALETTE.cyan}
                    emissiveIntensity={0.35 + 0.25 * beatPulse}
                    roughness={0.25}
                    metalness={0.8}
                />
            </mesh>

            {/* =====================================================================
                STASIUN 1 (0s - 10s): PEMBUKA - EMBLEM 3D SKENSA & FIBER NETWORK CORE
               ===================================================================== */}
            <group position={STATIONS[0].pos} scale={s1Scale}>
                {/* Skala masuk saat pembuka */}
                <group
                    scale={spring({
                        frame,
                        fps: FPS,
                        config: { damping: 14, stiffness: 110, mass: 0.9 },
                    })}
                >
                    {/* Cincin Luar Bevel Deep Navy & Steel Blue */}
                    <mesh rotation={[0.18, frame * 0.008, 0]}>
                        <torusGeometry args={[2.15, 0.11, 24, 96]} />
                        <meshStandardMaterial color={PALETTE.steelBlue} metalness={0.85} roughness={0.2} />
                    </mesh>

                    {/* Roda Gigi Luar SKENSA (Cyan) */}
                    <mesh geometry={outerGearGeo} rotation={[0, 0, frame * 0.012]}>
                        <meshStandardMaterial
                            color={PALETTE.cyan}
                            emissive={PALETTE.cyan}
                            emissiveIntensity={0.2 + 0.25 * beatPulse}
                            metalness={0.75}
                            roughness={0.22}
                        />
                    </mesh>

                    {/* Roda Gigi Dalam TKJ (Vibrant Orange #F97316) */}
                    <mesh geometry={innerGearGeo} position={[0, 0, 0.14]} rotation={[0, 0, -frame * 0.018]}>
                        <meshStandardMaterial
                            color={PALETTE.orange}
                            emissive={PALETTE.orangeDeep}
                            emissiveIntensity={0.35 + 0.4 * beatPulse}
                            metalness={0.7}
                            roughness={0.25}
                        />
                    </mesh>

                    {/* Inti Kristal Jaringan 3D di Tengah */}
                    <mesh position={[0, 0, 0.25]} rotation={[frame * 0.02, frame * 0.03, 0]} scale={1 + 0.08 * beatPulse}>
                        <octahedronGeometry args={[0.38, 1]} />
                        <meshStandardMaterial
                            color={PALETTE.white}
                            emissive={PALETTE.cyanBright}
                            emissiveIntensity={0.6 + 0.4 * beatPulse}
                            wireframe
                        />
                    </mesh>

                    {/* 2 Cincin Gyro Fiber Optik (Orange & Cyan) */}
                    <mesh rotation={[Math.PI / 3 + frame * 0.015, frame * 0.02, 0]}>
                        <torusGeometry args={[2.55, 0.028, 16, 100]} />
                        <meshStandardMaterial
                            color={PALETTE.orange}
                            emissive={PALETTE.orange}
                            emissiveIntensity={0.75 + 0.45 * beatPulse}
                        />
                    </mesh>
                    <mesh rotation={[-Math.PI / 3 - frame * 0.012, frame * 0.018, Math.PI / 4]}>
                        <torusGeometry args={[2.8, 0.024, 16, 100]} />
                        <meshStandardMaterial
                            color={PALETTE.cyanBright}
                            emissive={PALETTE.cyan}
                            emissiveIntensity={0.65 + 0.4 * beatPulse}
                        />
                    </mesh>
                </group>
            </group>

            {/* =====================================================================
                STASIUN 2 (10s - 20s): IDENTITAS JURUSAN - 3D TKJ MONOLITH & ORANGE RINGS
               ===================================================================== */}
            <group position={STATIONS[1].pos} scale={s2Scale} rotation={[0, -0.32 + Math.sin(frame * 0.02) * 0.1, 0]}>
                {/* Platform Heksagonal Bertingkat */}
                <mesh position={[0, -1.65, 0]}>
                    <cylinderGeometry args={[2.6, 2.9, 0.28, 6]} />
                    <meshStandardMaterial color={PALETTE.navyMid} metalness={0.85} roughness={0.22} />
                </mesh>
                <mesh position={[0, -1.48, 0]}>
                    <cylinderGeometry args={[2.35, 2.45, 0.08, 6]} />
                    <meshStandardMaterial
                        color={PALETTE.orange}
                        emissive={PALETTE.orange}
                        emissiveIntensity={0.5 + 0.4 * beatPulse}
                    />
                </mesh>

                {/* 3 Pilar Monolit 3D (Merepresentasikan T - K - J & 3 Fokus Utama) */}
                {[-1.1, 0, 1.1].map((xPos, idx) => {
                    const h = idx === 1 ? 2.5 : 2.0;
                    const pillarColor = idx === 1 ? PALETTE.orange : idx === 0 ? PALETTE.cyan : PALETTE.steelBlue;
                    return (
                        <group key={idx} position={[xPos, -0.2 + Math.sin(frame * 0.05 + idx) * 0.08, 0]}>
                            <mesh>
                                <boxGeometry args={[0.68, h, 0.68]} />
                                <meshStandardMaterial
                                    color={PALETTE.navyDark}
                                    metalness={0.88}
                                    roughness={0.18}
                                />
                            </mesh>
                            {/* Bingkai Cahaya Pilar (Orange Seragam TKJ & Cyan SKENSA) */}
                            <mesh position={[0, 0, 0.35]}>
                                <boxGeometry args={[0.52, h - 0.2, 0.04]} />
                                <meshStandardMaterial
                                    color={pillarColor}
                                    emissive={pillarColor}
                                    emissiveIntensity={0.55 + 0.35 * beatPulse}
                                />
                            </mesh>
                        </group>
                    );
                })}

                {/* Cincin Data Mengelilingi Monolit */}
                <mesh rotation={[0.25, frame * 0.025, 0.1]}>
                    <torusGeometry args={[2.3, 0.035, 16, 80]} />
                    <meshStandardMaterial
                        color={PALETTE.cyanBright}
                        emissive={PALETTE.cyan}
                        emissiveIntensity={0.6}
                    />
                </mesh>
                <mesh rotation={[-0.35, -frame * 0.02, -0.15]}>
                    <torusGeometry args={[2.55, 0.03, 16, 80]} />
                    <meshStandardMaterial
                        color={PALETTE.orange}
                        emissive={PALETTE.orange}
                        emissiveIntensity={0.65 + 0.35 * beatPulse}
                    />
                </mesh>
            </group>

            {/* =====================================================================
                STASIUN 3 (20s - 34s): FASILITAS LAB - 3D 42U SERVER RACK & ROUTER BLADES
               ===================================================================== */}
            <group position={STATIONS[2].pos} scale={s3Scale} rotation={[0, -0.22 + Math.sin(frame * 0.018) * 0.08, 0]}>
                {/* Alas Rak Server */}
                <mesh position={[0, -2.0, 0]}>
                    <boxGeometry args={[2.8, 0.22, 2.2]} />
                    <meshStandardMaterial color={PALETTE.navyMid} metalness={0.85} roughness={0.25} />
                </mesh>

                {/* Kabinet Utama 42U Server Rack */}
                <mesh position={[0, 0.1, 0]}>
                    <boxGeometry args={[2.2, 3.9, 1.6]} />
                    <meshStandardMaterial color={'#051329'} metalness={0.9} roughness={0.2} />
                </mesh>

                {/* Tiang Vertikal Kiri & Kanan Rak Server (Aksen Orange TKJ & Cyan) */}
                <mesh position={[-1.06, 0.1, 0.82]}>
                    <boxGeometry args={[0.08, 3.85, 0.06]} />
                    <meshStandardMaterial color={PALETTE.orange} emissive={PALETTE.orange} emissiveIntensity={0.6} />
                </mesh>
                <mesh position={[1.06, 0.1, 0.82]}>
                    <boxGeometry args={[0.08, 3.85, 0.06]} />
                    <meshStandardMaterial color={PALETTE.cyan} emissive={PALETTE.cyan} emissiveIntensity={0.6} />
                </mesh>

                {/* 8 Unit Blade Router Cisco / MikroTik & Fiber OTB di dalam Rak */}
                {Array.from({ length: 8 }).map((_, rIdx) => {
                    const yPos = -1.35 + rIdx * 0.42;
                    const isOrangeBlade = rIdx % 2 === 0;
                    const ledPulse = ((frame + rIdx * 5) % 15) < 7 ? 1.0 : 0.25;
                    return (
                        <group key={rIdx} position={[0, yPos, 0.81]}>
                            {/* Faceplate Blade 1U */}
                            <mesh>
                                <boxGeometry args={[1.92, 0.31, 0.06]} />
                                <meshStandardMaterial color={PALETTE.navyMid} metalness={0.8} roughness={0.25} />
                            </mesh>
                            {/* Strip LED Indikator Port */}
                            <mesh position={[-0.45, 0, 0.04]}>
                                <boxGeometry args={[0.75, 0.07, 0.02]} />
                                <meshStandardMaterial
                                    color={isOrangeBlade ? PALETTE.orange : PALETTE.cyanBright}
                                    emissive={isOrangeBlade ? PALETTE.orange : PALETTE.cyan}
                                    emissiveIntensity={0.5 + 0.5 * ledPulse}
                                />
                            </mesh>
                            {/* Port SFP+ Fiber Optic di Kanan */}
                            {[0.25, 0.45, 0.65].map((px, pIdx) => (
                                <mesh key={pIdx} position={[px, 0, 0.04]}>
                                    <boxGeometry args={[0.1, 0.1, 0.02]} />
                                    <meshStandardMaterial
                                        color={pIdx === 1 ? PALETTE.orange : PALETTE.cyan}
                                        emissive={pIdx === 1 ? PALETTE.orange : PALETTE.cyan}
                                        emissiveIntensity={0.8 * beatPulse}
                                    />
                                </mesh>
                            ))}
                        </group>
                    );
                })}
            </group>

            {/* =====================================================================
                STASIUN 4 (34s - 48s): KOMPETENSI & PRESTASI - 3D TOPOLOGY SPHERE & TROPHY
               ===================================================================== */}
            <group position={STATIONS[3].pos} scale={s4Scale} rotation={[0, -0.25, 0]}>
                {/* Bola Geodesik Topologi Jaringan 3D */}
                <mesh rotation={[frame * 0.012, frame * 0.018, 0]} scale={1 + 0.04 * beatPulse}>
                    <icosahedronGeometry args={[1.95, 2]} />
                    <meshStandardMaterial
                        color={PALETTE.cyan}
                        emissive={PALETTE.cyan}
                        emissiveIntensity={0.35 + 0.25 * beatPulse}
                        wireframe
                    />
                </mesh>

                {/* Piala / Monumen Juara LKS 3D di Dalam Bola Topologi */}
                <group rotation={[0, frame * 0.025, 0]}>
                    {/* Base Piala */}
                    <mesh position={[0, -1.35, 0]}>
                        <cylinderGeometry args={[0.75, 0.95, 0.35, 8]} />
                        <meshStandardMaterial color={PALETTE.navyMid} metalness={0.9} roughness={0.18} />
                    </mesh>
                    {/* Cincin Aksen Base Orange */}
                    <mesh position={[0, -1.12, 0]}>
                        <cylinderGeometry args={[0.68, 0.72, 0.1, 8]} />
                        <meshStandardMaterial
                            color={PALETTE.orange}
                            emissive={PALETTE.orange}
                            emissiveIntensity={0.6 + 0.3 * beatPulse}
                        />
                    </mesh>
                    {/* Pilar Spiral Piala */}
                    <mesh position={[0, -0.25, 0]} rotation={[0, Math.PI / 4, 0]}>
                        <cylinderGeometry args={[0.28, 0.52, 1.65, 6]} />
                        <meshStandardMaterial color={PALETTE.white} metalness={0.85} roughness={0.15} />
                    </mesh>
                    {/* Mahkota Kristal Juara (Octahedron Berkilau Orange-Cyan) */}
                    <mesh position={[0, 0.95, 0]} scale={1 + 0.08 * beatPulse}>
                        <octahedronGeometry args={[0.62, 0]} />
                        <meshStandardMaterial
                            color={PALETTE.orange}
                            emissive={PALETTE.orangeDeep}
                            emissiveIntensity={0.55 + 0.4 * beatPulse}
                            metalness={0.8}
                            roughness={0.15}
                        />
                    </mesh>
                </group>
            </group>

            {/* =====================================================================
                STASIUN 5 & FINALE (48s - 60s): PROSPEK KARIR - 3D DATA CENTER TOWERS & EMBLEM
               ===================================================================== */}
            <group position={STATIONS[4].pos}>
                {/* Gugus 5 Menara Cloud Data Center di Horizon */}
                <group scale={s5Scale}>
                    {[
                        { x: -2.6, z: -1.4, h: 3.0, col: PALETTE.cyan },
                        { x: -1.3, z: -0.9, h: 3.7, col: PALETTE.orange },
                        { x: 0.0, z: -1.2, h: 4.3, col: PALETTE.cyanBright },
                        { x: 1.3, z: -0.9, h: 3.7, col: PALETTE.orange },
                        { x: 2.6, z: -1.4, h: 3.0, col: PALETTE.cyan },
                    ].map((tw, idx) => (
                        <group key={idx} position={[tw.x, -1.8 + tw.h / 2, tw.z]}>
                            <mesh>
                                <boxGeometry args={[0.82, tw.h, 0.82]} />
                                <meshStandardMaterial color={PALETTE.navyDark} metalness={0.9} roughness={0.2} />
                            </mesh>
                            {/* Garis Vertikal Serat Optik Menara */}
                            <mesh position={[0, 0, 0.42]}>
                                <boxGeometry args={[0.14, tw.h - 0.3, 0.03]} />
                                <meshStandardMaterial
                                    color={tw.col}
                                    emissive={tw.col}
                                    emissiveIntensity={0.55 + 0.35 * beatPulse}
                                />
                            </mesh>
                        </group>
                    ))}
                </group>

                {/* Emblem 3D SKENSA x TKJ yang Mengunci di Tengah saat Finale (56s - 60s) */}
                <group
                    position={[0, 0.55, 0.8]}
                    scale={interpolate(frame, [1655, 1692], [0.001, 0.85], {
                        extrapolateLeft: 'clamp',
                        extrapolateRight: 'clamp',
                        easing: Easing.out(Easing.back(1.4)),
                    })}
                >
                    <mesh geometry={outerGearGeo} rotation={[0, 0, frame < 1695 ? frame * 0.01 : 0]}>
                        <meshStandardMaterial
                            color={PALETTE.cyan}
                            emissive={PALETTE.cyan}
                            emissiveIntensity={0.35}
                            metalness={0.8}
                            roughness={0.2}
                        />
                    </mesh>
                    <mesh geometry={innerGearGeo} position={[0, 0, 0.14]} rotation={[0, 0, frame < 1695 ? -frame * 0.015 : 0]}>
                        <meshStandardMaterial
                            color={PALETTE.orange}
                            emissive={PALETTE.orange}
                            emissiveIntensity={0.45}
                            metalness={0.75}
                            roughness={0.22}
                        />
                    </mesh>
                </group>
            </group>
        </group>
    );
};

/**
 * Komponen Judul Kinetik yang berubah warna mengikuti ketukan 120 BPM
 * (#F8FAFC -> #35B8C4 -> #F97316)
 */
const KineticChapterTitle: React.FC<{
    frame: number;
    startFrame: number;
    chapterLabel: string;
    words: string[];
    align?: 'center' | 'left';
}> = ({ frame, startFrame, chapterLabel, words, align = 'left' }) => {
    const localFrame = frame - startFrame;
    const badgeSpring = spring({
        frame: Math.max(0, localFrame),
        fps: FPS,
        config: { damping: 14, stiffness: 140 },
    });

    return (
        <div
            style={{
                display: 'flex',
                flexDirection: 'column',
                alignItems: align === 'center' ? 'center' : 'flex-start',
                textAlign: align,
                gap: 10,
            }}
        >
            {/* Chapter Pill Badge */}
            <div
                style={{
                    display: 'inline-flex',
                    alignItems: 'center',
                    gap: 10,
                    padding: '6px 16px',
                    borderRadius: 999,
                    background: 'rgba(7, 28, 63, 0.85)',
                    border: `1px solid ${PALETTE.orange}`,
                    transform: `scale(${badgeSpring})`,
                    opacity: badgeSpring,
                }}
            >
                <span
                    style={{
                        width: 8,
                        height: 8,
                        borderRadius: '50%',
                        backgroundColor: PALETTE.orange,
                        boxShadow: `0 0 10px ${PALETTE.orange}`,
                    }}
                />
                <span
                    style={{
                        fontFamily: "'JetBrains Mono', 'Inter', monospace",
                        fontSize: 14,
                        fontWeight: 700,
                        letterSpacing: '0.18em',
                        textTransform: 'uppercase',
                        color: PALETTE.cyanBright,
                    }}
                >
                    {chapterLabel}
                </span>
            </div>

            {/* Baris Kata Kinetik dengan Color Shift Dinamis */}
            <div
                style={{
                    display: 'flex',
                    flexWrap: 'wrap',
                    justifyContent: align === 'center' ? 'center' : 'flex-start',
                    gap: '14px',
                }}
            >
                {words.map((word, wIdx) => {
                    const wordDelay = wIdx * 12; // Muncul per ketukan 120 BPM
                    const wSpring = spring({
                        frame: Math.max(0, localFrame - wordDelay),
                        fps: FPS,
                        config: { damping: 13, stiffness: 150, mass: 0.8 },
                    });

                    // Gelombang warna dinamis yang mengalir melalui kata-kata sesuai ketukan 120 BPM
                    const colorPhase = ((localFrame - wordDelay) / 24 + wIdx * 0.35) % 3;
                    const normalizedPhase = colorPhase < 0 ? colorPhase + 3 : colorPhase;
                    const dynamicColor = interpolateColors(
                        normalizedPhase,
                        [0, 1, 2, 3],
                        [PALETTE.white, PALETTE.cyanBright, PALETTE.orange, PALETTE.white]
                    );

                    const translateY = interpolate(wSpring, [0, 1], [32, 0]);

                    return (
                        <span
                            key={wIdx}
                            style={{
                                display: 'inline-block',
                                fontFamily: "'Plus Jakarta Sans', 'Inter', sans-serif",
                                fontSize: align === 'center' ? 66 : 54,
                                fontWeight: 900,
                                letterSpacing: '-0.02em',
                                lineHeight: 1.08,
                                color: dynamicColor,
                                transform: `translateY(${translateY}px) scale(${0.85 + 0.15 * wSpring})`,
                                opacity: wSpring,
                                textShadow: '0 8px 28px rgba(5, 16, 36, 0.85)',
                            }}
                        >
                            {word}
                        </span>
                    );
                })}
            </div>
        </div>
    );
};

/**
 * Kartu Fakta Minimalis dengan Aksen Garis Kiri TKJ Orange / SKENSA Cyan
 */
const MinimalFactCard: React.FC<{
    frame: number;
    appearFrame: number;
    index: number;
    title: string;
    subtitle: string;
    accentColor?: string;
}> = ({ frame, appearFrame, index, title, subtitle, accentColor }) => {
    const prog = spring({
        frame: Math.max(0, frame - appearFrame),
        fps: FPS,
        config: { damping: 15, stiffness: 135, mass: 0.85 },
    });

    const borderCol = accentColor || (index % 2 === 0 ? PALETTE.orange : PALETTE.cyan);
    const tx = interpolate(prog, [0, 1], [-36, 0]);

    return (
        <div
            style={{
                display: 'flex',
                alignItems: 'center',
                gap: 18,
                padding: '16px 22px',
                borderRadius: 14,
                background: 'linear-gradient(135deg, rgba(7, 28, 63, 0.92) 0%, rgba(15, 41, 82, 0.84) 100%)',
                border: '1px solid rgba(53, 184, 196, 0.28)',
                borderLeft: `5px solid ${borderCol}`,
                transform: `translateX(${tx}px)`,
                opacity: prog,
                boxShadow: '0 14px 32px rgba(3, 10, 24, 0.55)',
            }}
        >
            <div
                style={{
                    minWidth: 38,
                    height: 38,
                    borderRadius: 10,
                    backgroundColor: 'rgba(5, 16, 36, 0.9)',
                    border: `1px solid ${borderCol}`,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontFamily: "'JetBrains Mono', monospace",
                    fontSize: 15,
                    fontWeight: 800,
                    color: borderCol,
                }}
            >
                0{index + 1}
            </div>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 3 }}>
                <span
                    style={{
                        fontFamily: "'Plus Jakarta Sans', 'Inter', sans-serif",
                        fontSize: 21,
                        fontWeight: 800,
                        color: PALETTE.white,
                        letterSpacing: '-0.01em',
                    }}
                >
                    {title}
                </span>
                <span
                    style={{
                        fontFamily: "'Inter', sans-serif",
                        fontSize: 15,
                        fontWeight: 500,
                        color: PALETTE.slateMuted,
                    }}
                >
                    {subtitle}
                </span>
            </div>
        </div>
    );
};

/**
 * Panel Foto 3D Perspektif (3D Perspective Showcase Card) untuk menampilkan foto asli lab & prestasi LKS
 */
const Perspective3DPhotoPanel: React.FC<{
    frame: number;
    appearFrame: number;
    imageSrc: string;
    tag: string;
    caption: string;
}> = ({ frame, appearFrame, imageSrc, tag, caption }) => {
    const enter = spring({
        frame: Math.max(0, frame - appearFrame),
        fps: FPS,
        config: { damping: 14, stiffness: 120 },
    });

    const rotY = -14 + Math.sin(frame * 0.04) * 3.5;
    const rotX = 4 + Math.cos(frame * 0.03) * 2.0;

    return (
        <div
            style={{
                perspective: 1200,
                opacity: enter,
                transform: `scale(${0.86 + 0.14 * enter})`,
            }}
        >
            <div
                style={{
                    width: 430,
                    borderRadius: 20,
                    padding: 12,
                    background: 'linear-gradient(145deg, rgba(7, 28, 63, 0.95), rgba(15, 41, 82, 0.85))',
                    border: `2px solid ${PALETTE.cyan}`,
                    boxShadow: '0 24px 50px rgba(2, 8, 20, 0.75)',
                    transform: `rotateY(${rotY}deg) rotateX(${rotX}deg)`,
                    transformStyle: 'preserve-3d',
                }}
            >
                <div
                    style={{
                        position: 'relative',
                        width: '100%',
                        height: 250,
                        borderRadius: 12,
                        overflow: 'hidden',
                        border: '1px solid rgba(248, 250, 252, 0.15)',
                    }}
                >
                    <Img
                        src={staticFile(imageSrc)}
                        style={{
                            width: '100%',
                            height: '100%',
                            objectFit: 'cover',
                            transform: `scale(${1.02 + Math.sin(frame * 0.015) * 0.02})`,
                        }}
                    />
                    {/* Badge Tag di Sudut Atas */}
                    <div
                        style={{
                            position: 'absolute',
                            top: 14,
                            left: 14,
                            padding: '6px 14px',
                            borderRadius: 8,
                            backgroundColor: 'rgba(5, 16, 36, 0.88)',
                            border: `1px solid ${PALETTE.orange}`,
                            fontFamily: "'JetBrains Mono', monospace",
                            fontSize: 12,
                            fontWeight: 700,
                            color: PALETTE.orangeSoft,
                            letterSpacing: '0.1em',
                        }}
                    >
                        {tag}
                    </div>
                </div>
                <div
                    style={{
                        marginTop: 12,
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'space-between',
                        padding: '4px 6px',
                    }}
                >
                    <span
                        style={{
                            fontFamily: "'Plus Jakarta Sans', 'Inter', sans-serif",
                            fontSize: 16,
                            fontWeight: 700,
                            color: PALETTE.white,
                        }}
                    >
                        {caption}
                    </span>
                    <span
                        style={{
                            fontFamily: "'JetBrains Mono', monospace",
                            fontSize: 12,
                            fontWeight: 700,
                            color: PALETTE.cyanBright,
                        }}
                    >
                        SMKN 1 DENPASAR
                    </span>
                </div>
            </div>
        </div>
    );
};

export const TkjPromo: React.FC = () => {
    const frame = useCurrentFrame();
    const { width, height, durationInFrames } = useVideoConfig();

    const beatPhase = (frame % FRAMES_PER_BEAT) / FRAMES_PER_BEAT;
    const beatPulse = Math.exp(-beatPhase * 5.0);

    // Visibilitas masing-masing Bab (dengan fade transisi halus)
    const ch1Opacity = interpolate(frame, [0, 12, 275, 295], [0, 1, 1, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const ch2Opacity = interpolate(frame, [295, 315, 575, 595], [0, 1, 1, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const ch3Opacity = interpolate(frame, [595, 615, 995, 1015], [0, 1, 1, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const ch4Opacity = interpolate(frame, [1015, 1035, 1415, 1435], [0, 1, 1, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const ch5Opacity = interpolate(frame, [1435, 1455, 1655, 1675], [0, 1, 1, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const finaleOpacity = interpolate(frame, [1670, 1692, 1790, 1800], [0, 1, 1, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });

    // Penanda Bab Aktif untuk Top HUD Navigation Bar
    const activeChapterIndex =
        frame < 300 ? 0 : frame < 600 ? 1 : frame < 1020 ? 2 : frame < 1440 ? 3 : 4;

    const chapterLabels = [
        '01 PEMBUKA',
        '02 IDENTITAS',
        '03 FASILITAS LAB',
        '04 KOMPETENSI & PRESTASI',
        '05 PROSPEK KARIR',
    ];

    return (
        <AbsoluteFill
            style={{
                backgroundColor: PALETTE.bgDeep,
                backgroundImage: `
                    radial-gradient(circle at 50% 42%, rgba(43, 91, 145, 0.32) 0%, rgba(7, 28, 63, 0.88) 58%, #040D1F 100%)
                `,
                overflow: 'hidden',
            }}
        >
            {/* Audio Track 60s 120 BPM yang dirender & dimastering dengan Leonxlnx/earshot */}
            <Audio src={staticFile('tkj_promo_audio.mp3')} volume={1} />

            {/* Grid Blueprint Tipis di Background */}
            <AbsoluteFill
                style={{
                    backgroundImage: `
                        linear-gradient(to right, rgba(53, 184, 196, 0.05) 1px, transparent 1px),
                        linear-gradient(to bottom, rgba(53, 184, 196, 0.05) 1px, transparent 1px)
                    `,
                    backgroundSize: '64px 64px',
                }}
            />

            {/* KANVAS 3D UTAMA (Three.js + @remotion/three) */}
            <AbsoluteFill>
                <ThreeCanvas
                    width={width}
                    height={height}
                    camera={{ position: [0, 0.2, 8.8], fov: 42 }}
                >
                    <ambientLight intensity={0.85} color={PALETTE.white} />
                    <directionalLight position={[8, 12, 10]} intensity={2.2} color={PALETTE.white} />
                    <pointLight position={[-8, 5, 6]} intensity={1.8} color={PALETTE.cyanBright} />
                    <pointLight position={[8, -4, 5]} intensity={1.9} color={PALETTE.orange} />
                    <TkjWorld3D frame={frame} />
                </ThreeCanvas>
            </AbsoluteFill>

            {/* TOP HUD BAR: Identitas Sekolah & Progress Bab */}
            <div
                style={{
                    position: 'absolute',
                    top: 36,
                    left: 64,
                    right: 64,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'space-between',
                    zIndex: 20,
                }}
            >
                <div style={{ display: 'flex', alignItems: 'center', gap: 14 }}>
                    <div
                        style={{
                            padding: '6px 14px',
                            borderRadius: 8,
                            backgroundColor: PALETTE.orange,
                            fontFamily: "'JetBrains Mono', monospace",
                            fontSize: 14,
                            fontWeight: 800,
                            color: PALETTE.white,
                            letterSpacing: '0.08em',
                        }}
                    >
                        TKJ SKENSA
                    </div>
                    <span
                        style={{
                            fontFamily: "'Plus Jakarta Sans', sans-serif",
                            fontSize: 15,
                            fontWeight: 700,
                            color: PALETTE.white,
                            letterSpacing: '0.06em',
                        }}
                    >
                        SMK NEGERI 1 DENPASAR
                    </span>
                </div>

                {/* Indikator 5 Bab */}
                <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
                    {chapterLabels.map((lbl, idx) => {
                        const isActive = idx === activeChapterIndex;
                        return (
                            <div
                                key={idx}
                                style={{
                                    padding: '6px 13px',
                                    borderRadius: 999,
                                    backgroundColor: isActive
                                        ? 'rgba(249, 115, 22, 0.22)'
                                        : 'rgba(7, 28, 63, 0.65)',
                                    border: `1px solid ${
                                        isActive ? PALETTE.orange : 'rgba(53, 184, 196, 0.22)'
                                    }`,
                                    fontFamily: "'JetBrains Mono', monospace",
                                    fontSize: 11,
                                    fontWeight: isActive ? 800 : 600,
                                    color: isActive ? PALETTE.white : PALETTE.slateMuted,
                                    letterSpacing: '0.06em',
                                }}
                            >
                                {lbl}
                            </div>
                        );
                    })}
                </div>
            </div>

            {/* =========================================================================
                HUD BAB 1 (0s - 10s): PEMBUKA
               ========================================================================= */}
            {ch1Opacity > 0.01 && (
                <AbsoluteFill
                    style={{
                        opacity: ch1Opacity,
                        justifyContent: 'flex-end',
                        alignItems: 'center',
                        paddingBottom: 88,
                        paddingLeft: 80,
                        paddingRight: 80,
                    }}
                >
                    <KineticChapterTitle
                        frame={frame}
                        startFrame={24}
                        chapterLabel="PROGRAM KEAHLIAN UNGGULAN // SMKN 1 DENPASAR"
                        words={['TEKNIK', 'KOMPUTER', '& JARINGAN']}
                        align="center"
                    />
                    <p
                        style={{
                            marginTop: 16,
                            fontFamily: "'Inter', sans-serif",
                            fontSize: 22,
                            fontWeight: 500,
                            color: PALETTE.slateMuted,
                            textAlign: 'center',
                            maxWidth: 820,
                            opacity: interpolate(frame, [95, 115], [0, 1], {
                                extrapolateLeft: 'clamp',
                                extrapolateRight: 'clamp',
                            }),
                        }}
                    >
                        Membangun arsitek infrastruktur jaringan, administrasi server, dan teknologi serat optik berstandar industri.
                    </p>
                </AbsoluteFill>
            )}

            {/* =========================================================================
                HUD BAB 2 (10s - 20s): IDENTITAS JURUSAN
               ========================================================================= */}
            {ch2Opacity > 0.01 && (
                <AbsoluteFill
                    style={{
                        opacity: ch2Opacity,
                        paddingTop: 120,
                        paddingLeft: 76,
                        paddingRight: 76,
                        display: 'flex',
                        flexDirection: 'row',
                        alignItems: 'center',
                        justifyContent: 'space-between',
                    }}
                >
                    <div style={{ width: '54%', display: 'flex', flexDirection: 'column', gap: 24 }}>
                        <KineticChapterTitle
                            frame={frame}
                            startFrame={305}
                            chapterLabel="BAB 02 // IDENTITAS KOMPETENSI KEAHLIAN"
                            words={['IDENTITAS', 'JURUSAN', 'TKJ']}
                            align="left"
                        />
                        <div style={{ display: 'flex', flexDirection: 'column', gap: 14, marginTop: 8 }}>
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={360}
                                index={0}
                                title="Kode Jurusan: TKJ (Bidang Komputer & Informatika)"
                                subtitle="Bagian dari Program Teknik Jaringan Komputer dan Telekomunikasi (TJKT)"
                                accentColor={PALETTE.cyan}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={405}
                                index={1}
                                title="Fokus Inti: Jaringan, Cloud Server & Fiber Optik"
                                subtitle="Integrasi perangkat keras jaringan enterprise, sistem operasi server, dan keamanan siber"
                                accentColor={PALETTE.orange}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={450}
                                index={2}
                                title="Identitas Seragam Praktik: Vibrant Orange TKJ"
                                subtitle="Simbol ketangguhan teknis, kreativitas rekayasa, dan solidaritas siswa TKJ SKENSA"
                                accentColor={PALETTE.orange}
                            />
                        </div>
                    </div>
                </AbsoluteFill>
            )}

            {/* =========================================================================
                HUD BAB 3 (20s - 34s): FASILITAS LABORATORIUM
               ========================================================================= */}
            {ch3Opacity > 0.01 && (
                <AbsoluteFill
                    style={{
                        opacity: ch3Opacity,
                        paddingTop: 115,
                        paddingLeft: 76,
                        paddingRight: 76,
                        display: 'flex',
                        flexDirection: 'row',
                        alignItems: 'center',
                        justifyContent: 'space-between',
                    }}
                >
                    <div style={{ width: '50%', display: 'flex', flexDirection: 'column', gap: 20 }}>
                        <KineticChapterTitle
                            frame={frame}
                            startFrame={605}
                            chapterLabel="BAB 03 // INFRASTRUKTUR & LABORATORIUM PRAKTIK"
                            words={['FASILITAS', 'STANDAR', 'INDUSTRI']}
                            align="left"
                        />
                        <div style={{ display: 'flex', flexDirection: 'column', gap: 14, marginTop: 6 }}>
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={690}
                                index={0}
                                title="Laboratorium Serat Optik FTTH & Fusion Splicer"
                                subtitle="Praktik penyambungan inti serat optik, uji redaman OTDR, dan instalasi jaringan optik"
                                accentColor={PALETTE.orange}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={750}
                                index={1}
                                title="Laboratorium Routing & Switching (Cisco & MikroTik)"
                                subtitle="Konfigurasi langsung perangkat router, manageable switch, dan manajemen bandwidth"
                                accentColor={PALETTE.cyan}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={810}
                                index={2}
                                title="Tempat Uji Kompetensi (TUK) LSP-P1 BNSP"
                                subtitle="Fasilitas uji sertifikasi kompetensi resmi berstandar Badan Nasional Sertifikasi Profesi"
                                accentColor={PALETTE.orange}
                            />
                        </div>
                    </div>

                    {/* Panel Foto 3D di Sisi Kanan */}
                    <Perspective3DPhotoPanel
                        frame={frame}
                        appearFrame={654}
                        imageSrc="showcase/lab_fiber.jpg"
                        tag="LAB FIBER OPTIK & SERVER"
                        caption="Praktik Infrastruktur Jaringan & Serat Optik"
                    />
                </AbsoluteFill>
            )}

            {/* =========================================================================
                HUD BAB 4 (34s - 48s): KOMPETENSI SISWA & PRESTASI LOMBA
               ========================================================================= */}
            {ch4Opacity > 0.01 && (
                <AbsoluteFill
                    style={{
                        opacity: ch4Opacity,
                        paddingTop: 112,
                        paddingLeft: 76,
                        paddingRight: 76,
                        display: 'flex',
                        flexDirection: 'row',
                        alignItems: 'center',
                        justifyContent: 'space-between',
                    }}
                >
                    <div style={{ width: '52%', display: 'flex', flexDirection: 'column', gap: 16 }}>
                        <KineticChapterTitle
                            frame={frame}
                            startFrame={1025}
                            chapterLabel="BAB 04 // KEAHLIAN SISWA & REKAM JEJAK JUARA"
                            words={['KOMPETENSI', '& PRESTASI']}
                            align="left"
                        />

                        {/* 3 Core Skills Pills */}
                        <div style={{ display: 'flex', flexWrap: 'wrap', gap: 10, marginTop: 4 }}>
                            {[
                                'Routing & Switching',
                                'Linux & Cloud Server',
                                'Fiber Optic & Cyber Security',
                            ].map((skill, sIdx) => {
                                const sp = spring({
                                    frame: Math.max(0, frame - (1095 + sIdx * 15)),
                                    fps: FPS,
                                    config: { damping: 14, stiffness: 150 },
                                });
                                return (
                                    <div
                                        key={sIdx}
                                        style={{
                                            padding: '8px 16px',
                                            borderRadius: 999,
                                            backgroundColor: 'rgba(15, 41, 82, 0.92)',
                                            border: `1px solid ${sIdx === 2 ? PALETTE.orange : PALETTE.cyan}`,
                                            fontFamily: "'Plus Jakarta Sans', sans-serif",
                                            fontSize: 14,
                                            fontWeight: 700,
                                            color: PALETTE.white,
                                            transform: `scale(${sp})`,
                                            opacity: sp,
                                        }}
                                    >
                                        {skill}
                                    </div>
                                );
                            })}
                        </div>

                        {/* 3 Prestasi Lomba Faktual SMKN 1 Denpasar */}
                        <div style={{ display: 'flex', flexDirection: 'column', gap: 12, marginTop: 4 }}>
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={1170}
                                index={0}
                                title="Medali LKS Tingkat Nasional - Cloud Computing"
                                subtitle="Prestasi nasional siswa SMKN 1 Denpasar pada ajang Lomba Kompetensi Siswa (LKS)"
                                accentColor={PALETTE.orange}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={1230}
                                index={1}
                                title="Juara 1 Bertahan - Cyber Security Provinsi Bali"
                                subtitle="Peringkat 1 kompetisi Capture The Flag (CTF) Junior Sentinel Challenge Diskominfos Bali"
                                accentColor={PALETTE.cyan}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={1290}
                                index={2}
                                title="Juara Umum LKS Tingkat Kota & Provinsi Bali"
                                subtitle="Tradisi juara di bidang IT Network Systems Administration dan Cloud Computing"
                                accentColor={PALETTE.orange}
                            />
                        </div>
                    </div>

                    {/* Panel Foto 3D LKS di Sisi Kanan */}
                    <Perspective3DPhotoPanel
                        frame={frame}
                        appearFrame={1074}
                        imageSrc="showcase/lks_2026.jpg"
                        tag="TRADISI JUARA LKS & CTF"
                        caption="Delegasi Lomba Kompetensi Siswa SMKN 1 Denpasar"
                    />
                </AbsoluteFill>
            )}

            {/* =========================================================================
                HUD BAB 5 (48s - 56s): PROSPEK KARIR & MITRA INDUSTRI
               ========================================================================= */}
            {ch5Opacity > 0.01 && (
                <AbsoluteFill
                    style={{
                        opacity: ch5Opacity,
                        paddingTop: 115,
                        paddingLeft: 76,
                        paddingRight: 76,
                        display: 'flex',
                        flexDirection: 'row',
                        alignItems: 'center',
                        justifyContent: 'space-between',
                    }}
                >
                    <div style={{ width: '54%', display: 'flex', flexDirection: 'column', gap: 20 }}>
                        <KineticChapterTitle
                            frame={frame}
                            startFrame={1445}
                            chapterLabel="BAB 05 // PELUANG KERJA & SINERGI DUDIKA"
                            words={['PROSPEK', 'KARIR', 'LULUSAN']}
                            align="left"
                        />
                        <div style={{ display: 'flex', flexDirection: 'column', gap: 14, marginTop: 4 }}>
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={1515}
                                index={0}
                                title="Network Engineer & Infrastructure Architect"
                                subtitle="Perancang dan pengelola jaringan skala perusahaan, perbankan, serta data center"
                                accentColor={PALETTE.cyan}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={1560}
                                index={1}
                                title="System, Cloud & Cyber Security Administrator"
                                subtitle="Pengelola server Linux, infrastruktur cloud, serta pengamanan jaringan dari serangan siber"
                                accentColor={PALETTE.orange}
                            />
                            <MinimalFactCard
                                frame={frame}
                                appearFrame={1605}
                                index={2}
                                title="Teknisi Telekomunikasi & ISP (Mitra Telkom Group)"
                                subtitle="Spesialis jaringan serat optik FTTH dan penyedia layanan internet nasional"
                                accentColor={PALETTE.cyan}
                            />
                        </div>
                    </div>

                    {/* Kartu Mitra Industri PT Telkom Indonesia */}
                    <div
                        style={{
                            width: 440,
                            padding: 28,
                            borderRadius: 20,
                            background: 'linear-gradient(145deg, rgba(7, 28, 63, 0.94), rgba(15, 41, 82, 0.88))',
                            border: `2px solid ${PALETTE.orange}`,
                            display: 'flex',
                            flexDirection: 'column',
                            alignItems: 'center',
                            textAlign: 'center',
                            gap: 18,
                            boxShadow: '0 24px 48px rgba(3, 10, 24, 0.7)',
                            transform: `scale(${spring({
                                frame: Math.max(0, frame - 1494),
                                fps: FPS,
                                config: { damping: 14, stiffness: 130 },
                            })})`,
                        }}
                    >
                        <div
                            style={{
                                padding: '6px 14px',
                                borderRadius: 999,
                                backgroundColor: 'rgba(249, 115, 22, 0.18)',
                                border: `1px solid ${PALETTE.orange}`,
                                fontFamily: "'JetBrains Mono', monospace",
                                fontSize: 12,
                                fontWeight: 700,
                                color: PALETTE.orangeSoft,
                                letterSpacing: '0.12em',
                            }}
                        >
                            MITRA INDUSTRI UTAMA (DUDIKA)
                        </div>
                        <div
                            style={{
                                width: '100%',
                                height: 110,
                                borderRadius: 14,
                                backgroundColor: 'rgba(248, 250, 252, 0.96)',
                                display: 'flex',
                                alignItems: 'center',
                                justifyContent: 'center',
                                padding: 18,
                            }}
                        >
                            <Img
                                src={staticFile('partners/telkom.svg')}
                                style={{ maxHeight: 72, maxWidth: 260, objectFit: 'contain' }}
                            />
                        </div>
                        <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                            <span
                                style={{
                                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                                    fontSize: 20,
                                    fontWeight: 800,
                                    color: PALETTE.white,
                                }}
                            >
                                PT Telkom Indonesia / Telkomsel
                            </span>
                            <span
                                style={{
                                    fontFamily: "'Inter', sans-serif",
                                    fontSize: 14,
                                    color: PALETTE.slateMuted,
                                    lineHeight: 1.5,
                                }}
                            >
                                Penyelarasan kurikulum, praktik kerja lapangan (PKL), dan rekrutmen lulusan jaringan & telekomunikasi.
                            </span>
                        </div>
                    </div>
                </AbsoluteFill>
            )}

            {/* =========================================================================
                HUD FINALE LOCKUP (56s - 60s): PENUTUP SKENSA x TKJ
               ========================================================================= */}
            {finaleOpacity > 0.01 && (
                <AbsoluteFill
                    style={{
                        opacity: finaleOpacity,
                        justifyContent: 'flex-end',
                        alignItems: 'center',
                        paddingBottom: 92,
                    }}
                >
                    <KineticChapterTitle
                        frame={frame}
                        startFrame={1680}
                        chapterLabel="TEKNIK KOMPUTER & JARINGAN // SMKN 1 DENPASAR"
                        words={['SIAP', 'MEMIMPIN', 'ERA DIGITAL']}
                        align="center"
                    />
                    <div
                        style={{
                            marginTop: 18,
                            padding: '10px 26px',
                            borderRadius: 999,
                            backgroundColor: 'rgba(7, 28, 63, 0.92)',
                            border: `1px solid ${PALETTE.cyan}`,
                            fontFamily: "'JetBrains Mono', monospace",
                            fontSize: 15,
                            fontWeight: 700,
                            color: PALETTE.white,
                            letterSpacing: '0.14em',
                        }}
                    >
                        SKENSA JAYA // KOMPETEN - INOVATIF - SIAP KERJA
                    </div>
                </AbsoluteFill>
            )}

            {/* PROGRESS BAR 60 DETIK (120 BPM PULSE) DI BAGIAN BAWAH */}
            <div
                style={{
                    position: 'absolute',
                    bottom: 0,
                    left: 0,
                    right: 0,
                    height: 6,
                    backgroundColor: 'rgba(15, 41, 82, 0.7)',
                }}
            >
                <div
                    style={{
                        width: `${(frame / durationInFrames) * 100}%`,
                        height: '100%',
                        background: `linear-gradient(90deg, ${PALETTE.cyan} 0%, ${PALETTE.orange} 100%)`,
                        boxShadow: `0 0 ${8 + 8 * beatPulse}px ${PALETTE.orange}`,
                    }}
                />
            </div>
        </AbsoluteFill>
    );
};
