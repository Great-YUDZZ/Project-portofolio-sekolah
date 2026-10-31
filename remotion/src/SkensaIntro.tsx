import React, { useEffect, useMemo, useState } from 'react';
import { ThreeCanvas } from '@remotion/three';
import { useThree } from '@react-three/fiber';
import {
    AbsoluteFill,
    Audio,
    continueRender,
    delayRender,
    Easing,
    interpolate,
    staticFile,
    useCurrentFrame,
    useVideoConfig,
} from 'remotion';
import * as THREE from 'three';

interface LogoLayerTextures {
    outerGearFront: THREE.CanvasTexture;
    outerGearSide: THREE.CanvasTexture;
    outerGearBevel: THREE.CanvasTexture;
    innerRingFront: THREE.CanvasTexture;
    innerRingSide: THREE.CanvasTexture;
    innerRingBevel: THREE.CanvasTexture;
    cyanDiscFront: THREE.CanvasTexture;
    scholarFront: THREE.CanvasTexture;
    scholarSide: THREE.CanvasTexture;
    scholarBevel: THREE.CanvasTexture;
}

const EASE_OUT_EXPO = Easing.bezier(0.16, 1, 0.3, 1);
const EASE_MECHANICAL_LOCK = Easing.bezier(0.32, 0.04, 0.18, 1);
const EASE_CAMERA_DOLLY = Easing.bezier(0.42, 0.0, 0.2, 1);

function createAnnularTextureSet(
    img: HTMLImageElement,
    innerRatio: number,
    outerRatio: number,
    sideColorTop: string,
    sideColorBottom: string,
    bevelHighlightColor: string
): {
    front: THREE.CanvasTexture;
    side: THREE.CanvasTexture;
    bevel: THREE.CanvasTexture;
} {
    const size = 1024;
    const cx = size / 2;
    const cy = size / 2;
    const maxR = size / 2;

    const frontCanvas = document.createElement('canvas');
    frontCanvas.width = size;
    frontCanvas.height = size;
    const fCtx = frontCanvas.getContext('2d');

    if (fCtx) {
        fCtx.clearRect(0, 0, size, size);
        fCtx.save();
        fCtx.beginPath();
        fCtx.arc(cx, cy, outerRatio * maxR, 0, Math.PI * 2, false);
        if (innerRatio > 0) {
            fCtx.arc(cx, cy, innerRatio * maxR, 0, Math.PI * 2, true);
        }
        fCtx.closePath();
        fCtx.clip();
        fCtx.drawImage(img, 0, 0, size, size);
        fCtx.restore();
    }

    const sideCanvas = document.createElement('canvas');
    sideCanvas.width = size;
    sideCanvas.height = size;
    const sCtx = sideCanvas.getContext('2d');

    if (sCtx) {
        sCtx.drawImage(frontCanvas, 0, 0);
        sCtx.globalCompositeOperation = 'source-in';
        const grad = sCtx.createLinearGradient(0, 0, size, size);
        grad.addColorStop(0, sideColorTop);
        grad.addColorStop(1, sideColorBottom);
        sCtx.fillStyle = grad;
        sCtx.fillRect(0, 0, size, size);
        sCtx.globalCompositeOperation = 'source-over';
    }

    const bevelCanvas = document.createElement('canvas');
    bevelCanvas.width = size;
    bevelCanvas.height = size;
    const bCtx = bevelCanvas.getContext('2d');

    if (bCtx) {
        bCtx.drawImage(frontCanvas, 0, 0);
        bCtx.globalCompositeOperation = 'source-in';
        const grad = bCtx.createLinearGradient(0, 0, size, size);
        grad.addColorStop(0, '#E0F2FE');
        grad.addColorStop(0.45, bevelHighlightColor);
        grad.addColorStop(1, sideColorTop);
        bCtx.fillStyle = grad;
        bCtx.fillRect(0, 0, size, size);
        bCtx.globalCompositeOperation = 'source-over';
    }

    const front = new THREE.CanvasTexture(frontCanvas);
    front.colorSpace = THREE.SRGBColorSpace;
    front.anisotropy = 8;
    front.needsUpdate = true;

    const side = new THREE.CanvasTexture(sideCanvas);
    side.colorSpace = THREE.SRGBColorSpace;
    side.anisotropy = 8;
    side.needsUpdate = true;

    const bevel = new THREE.CanvasTexture(bevelCanvas);
    bevel.colorSpace = THREE.SRGBColorSpace;
    bevel.anisotropy = 8;
    bevel.needsUpdate = true;

    return { front, side, bevel };
}

function createScholarAndCyanTextures(img: HTMLImageElement): {
    cyanDiscFront: THREE.CanvasTexture;
    scholarFront: THREE.CanvasTexture;
    scholarSide: THREE.CanvasTexture;
    scholarBevel: THREE.CanvasTexture;
} {
    const size = 1024;
    const cx = size / 2;
    const cy = size / 2;
    const maxR = (size / 2) * 0.496;

    const cyanCanvas = document.createElement('canvas');
    cyanCanvas.width = size;
    cyanCanvas.height = size;
    const cCtx = cyanCanvas.getContext('2d');
    if (cCtx) {
        const grad = cCtx.createRadialGradient(
            cx - 70,
            cy - 70,
            20,
            cx,
            cy,
            maxR
        );
        grad.addColorStop(0, '#44CBD8');
        grad.addColorStop(0.72, '#35B8C4');
        grad.addColorStop(1, '#279AA6');
        cCtx.beginPath();
        cCtx.arc(cx, cy, maxR, 0, Math.PI * 2);
        cCtx.fillStyle = grad;
        cCtx.fill();
    }

    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = size;
    tempCanvas.height = size;
    const tCtx = tempCanvas.getContext('2d');

    const scholarCanvas = document.createElement('canvas');
    scholarCanvas.width = size;
    scholarCanvas.height = size;
    const scCtx = scholarCanvas.getContext('2d');

    const scholarSideCanvas = document.createElement('canvas');
    scholarSideCanvas.width = size;
    scholarSideCanvas.height = size;
    const ssCtx = scholarSideCanvas.getContext('2d');

    const scholarBevelCanvas = document.createElement('canvas');
    scholarBevelCanvas.width = size;
    scholarBevelCanvas.height = size;
    const sbCtx = scholarBevelCanvas.getContext('2d');

    if (tCtx && scCtx && ssCtx && sbCtx) {
        tCtx.beginPath();
        tCtx.arc(cx, cy, maxR * 0.96, 0, Math.PI * 2);
        tCtx.clip();
        tCtx.drawImage(img, 0, 0, size, size);

        const imgData = tCtx.getImageData(0, 0, size, size);
        const data = imgData.data;
        const frontData = scCtx.createImageData(size, size);
        const sideData = ssCtx.createImageData(size, size);
        const bevelData = sbCtx.createImageData(size, size);

        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];
            const a = data[i + 3];

            if (a > 20) {
                const cyanNess = g - r * 0.35;
                if (cyanNess < 118) {
                    const strength = Math.min(
                        1,
                        Math.max(0, (118 - cyanNess) / 45)
                    );
                    const alpha = Math.round(a * strength);

                    frontData.data[i] = r;
                    frontData.data[i + 1] = g;
                    frontData.data[i + 2] = b;
                    frontData.data[i + 3] = alpha;

                    sideData.data[i] = 26;
                    sideData.data[i + 1] = 64;
                    sideData.data[i + 2] = 108;
                    sideData.data[i + 3] = alpha;

                    bevelData.data[i] = 92;
                    bevelData.data[i + 1] = 158;
                    bevelData.data[i + 2] = 204;
                    bevelData.data[i + 3] = alpha;
                }
            }
        }

        scCtx.putImageData(frontData, 0, 0);
        ssCtx.putImageData(sideData, 0, 0);
        sbCtx.putImageData(bevelData, 0, 0);
    }

    const cyanDiscFront = new THREE.CanvasTexture(cyanCanvas);
    cyanDiscFront.colorSpace = THREE.SRGBColorSpace;
    cyanDiscFront.anisotropy = 8;
    cyanDiscFront.needsUpdate = true;

    const scholarFront = new THREE.CanvasTexture(scholarCanvas);
    scholarFront.colorSpace = THREE.SRGBColorSpace;
    scholarFront.anisotropy = 8;
    scholarFront.needsUpdate = true;

    const scholarSide = new THREE.CanvasTexture(scholarSideCanvas);
    scholarSide.colorSpace = THREE.SRGBColorSpace;
    scholarSide.anisotropy = 8;
    scholarSide.needsUpdate = true;

    const scholarBevel = new THREE.CanvasTexture(scholarBevelCanvas);
    scholarBevel.colorSpace = THREE.SRGBColorSpace;
    scholarBevel.anisotropy = 8;
    scholarBevel.needsUpdate = true;

    return { cyanDiscFront, scholarFront, scholarSide, scholarBevel };
}

/**
 * Builds a physical THREE.ExtrudeGeometry annular ring with bevels
 * (bevelThickness: 0.02, bevelSize: 0.01) for physical specular bevel normals.
 */
function createBeveledAnnulusGeometry(
    innerRadius: number,
    outerRadius: number,
    depth: number
): THREE.ExtrudeGeometry {
    const shape = new THREE.Shape();
    shape.absarc(0, 0, outerRadius, 0, Math.PI * 2, false);

    if (innerRadius > 0) {
        const hole = new THREE.Path();
        hole.absarc(0, 0, innerRadius, 0, Math.PI * 2, true);
        shape.holes.push(hole);
    }

    const geometry = new THREE.ExtrudeGeometry(shape, {
        depth,
        bevelEnabled: true,
        bevelThickness: 0.02,
        bevelSize: 0.01,
        bevelSegments: 4,
        curveSegments: 72,
    });
    geometry.center();
    return geometry;
}

/**
 * Volumetric 3D Extruded & Beveled Layer with Opacity Control for Staggered Blueprint Awakening.
 */
const VolumetricExtrudedLayer: React.FC<{
    frontTex: THREE.CanvasTexture;
    sideTex: THREE.CanvasTexture;
    bevelTex: THREE.CanvasTexture;
    radius: number;
    depth: number;
    slices: number;
    opacity?: number;
    bevelCoreGeo?: THREE.ExtrudeGeometry;
    bevelCoreColor?: string;
}> = ({
    frontTex,
    sideTex,
    bevelTex,
    radius,
    depth,
    slices,
    opacity = 1,
    bevelCoreGeo,
    bevelCoreColor = '#255082',
}) => {
    const sliceDescriptors = useMemo(() => {
        const bevelThickness = 0.022;
        const bevelSizeRatio = 0.0045;
        return Array.from({ length: slices }, (_, i) => {
            const t = slices > 1 ? i / (slices - 1) : 0.5;
            const z = -depth / 2 + t * depth;
            const distFromEdge = Math.min(
                Math.abs(z - depth / 2),
                Math.abs(z + depth / 2)
            );
            const isBevelZone = distFromEdge <= bevelThickness;
            const bevelFactor = isBevelZone
                ? distFromEdge / bevelThickness
                : 1.0;
            const scale =
                1.0 - bevelSizeRatio + bevelFactor * (bevelSizeRatio * 2.0);
            return { z, scale, isBevelZone };
        });
    }, [depth, slices]);

    if (opacity <= 0.005) {
        return null;
    }

    return (
        <group>
            {/* Physical THREE.ExtrudeGeometry Beveled Core Ring */}
            {bevelCoreGeo && (
                <mesh geometry={bevelCoreGeo}>
                    <meshStandardMaterial
                        color={bevelCoreColor}
                        metalness={0.38}
                        roughness={0.32}
                        transparent={opacity < 0.999}
                        opacity={opacity}
                    />
                </mesh>
            )}

            {/* Volumetric 3D Extrusion Wall & Chamfer Bevel Slices */}
            {sliceDescriptors.map((slice, idx) => (
                <mesh
                    key={idx}
                    position={[0, 0, slice.z]}
                    scale={[slice.scale, slice.scale, 1]}
                >
                    <circleGeometry args={[radius, 96]} />
                    <meshStandardMaterial
                        map={slice.isBevelZone ? bevelTex : sideTex}
                        transparent
                        opacity={opacity}
                        alphaTest={0.04}
                        roughness={slice.isBevelZone ? 0.26 : 0.34}
                        metalness={slice.isBevelZone ? 0.45 : 0.36}
                        side={THREE.DoubleSide}
                    />
                </mesh>
            ))}

            {/* Crisp PBR Front Face */}
            <mesh position={[0, 0, depth / 2 + 0.005]}>
                <circleGeometry args={[radius, 96]} />
                <meshStandardMaterial
                    map={frontTex}
                    transparent
                    opacity={opacity}
                    alphaTest={0.02}
                    roughness={0.3}
                    metalness={0.28}
                />
            </mesh>

            {/* Crisp PBR Back Face */}
            <mesh
                position={[0, 0, -depth / 2 - 0.005]}
                rotation={[0, Math.PI, 0]}
            >
                <circleGeometry args={[radius, 96]} />
                <meshStandardMaterial
                    map={frontTex}
                    transparent
                    opacity={opacity}
                    alphaTest={0.02}
                    roughness={0.36}
                    metalness={0.3}
                />
            </mesh>
        </group>
    );
};

/**
 * 3D Mechanical Blueprint Calibration Rings & Ticks:
 * Awakens first (0.0s -> 0.8s) in 3D space to guide the exploded mechanical assembly,
 * then settles into a clean subtle framing ring around the locked emblem.
 */
const BlueprintCalibrationRig: React.FC<{
    lockProgress: number;
}> = ({ lockProgress }) => {
    const frame = useCurrentFrame();
    const { fps } = useVideoConfig();

    // Outer framing ring stays visible at 0.45 opacity after lock
    const outerRingOpacity = interpolate(
        frame,
        [0.05 * fps, 0.55 * fps, 2.2 * fps, 2.6 * fps],
        [0, 0.78, 0.65, 0.44],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const outerRingScale = interpolate(lockProgress, [0, 1], [1.14, 1.0]);

    // Inner blueprint guide ring & 24 calibration ticks shine during exploded assembly (0.05s -> 2.4s), then fade into the emblem
    const blueprintGuideOpacity = interpolate(
        frame,
        [0.04 * fps, 0.48 * fps, 1.95 * fps, 2.55 * fps],
        [0, 0.65, 0.45, 0],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const blueprintRotZ = interpolate(lockProgress, [0, 1], [-0.95, 0]);
    const blueprintZ = interpolate(lockProgress, [0, 1], [0.55, 0]);

    const tickAngles = useMemo(
        () => Array.from({ length: 24 }, (_, i) => (i * Math.PI * 2) / 24),
        []
    );

    return (
        <group>
            {/* Permanent Minimalist Outer 3D Cyan Framing Ring */}
            <mesh scale={outerRingScale} position={[0, 0, -0.02]}>
                <torusGeometry args={[2.35, 0.01, 24, 128]} />
                <meshStandardMaterial
                    color="#35B8C4"
                    emissive="#155E75"
                    emissiveIntensity={0.45}
                    metalness={0.65}
                    roughness={0.25}
                    transparent
                    opacity={outerRingOpacity}
                />
            </mesh>

            {/* Temporary 3D Mechanical Blueprint Guide Ring & Radial Calibration Ticks */}
            {blueprintGuideOpacity > 0.005 && (
                <group
                    position={[0, 0, blueprintZ]}
                    rotation={[0, 0, blueprintRotZ]}
                >
                    <mesh>
                        <torusGeometry args={[1.76, 0.007, 16, 128]} />
                        <meshStandardMaterial
                            color="#7DD3FC"
                            emissive="#38BDF8"
                            emissiveIntensity={0.8}
                            transparent
                            opacity={blueprintGuideOpacity * 0.75}
                        />
                    </mesh>

                    <mesh position={[0, 0, 0.42]}>
                        <torusGeometry args={[1.12, 0.006, 16, 96]} />
                        <meshStandardMaterial
                            color="#35B8C4"
                            emissive="#0284C7"
                            emissiveIntensity={0.7}
                            transparent
                            opacity={blueprintGuideOpacity * 0.65}
                        />
                    </mesh>

                    {tickAngles.map((angle, i) => {
                        const r = 2.46;
                        const x = Math.cos(angle) * r;
                        const y = Math.sin(angle) * r;
                        return (
                            <mesh
                                key={i}
                                position={[x, y, 0.12]}
                                rotation={[0, 0, angle]}
                            >
                                <boxGeometry
                                    args={[
                                        i % 3 === 0 ? 0.11 : 0.055,
                                        0.012,
                                        0.012,
                                    ]}
                                />
                                <meshStandardMaterial
                                    color="#7DD3FC"
                                    emissive="#38BDF8"
                                    emissiveIntensity={0.9}
                                    transparent
                                    opacity={blueprintGuideOpacity}
                                />
                            </mesh>
                        );
                    })}
                </group>
            )}
        </group>
    );
};

/**
 * Subtle floating light dust particles (THREE.Points, opacity 12%-18%)
 * drifting slowly upward to add atmospheric depth of field.
 */
const FloatingDustParticles: React.FC = () => {
    const frame = useCurrentFrame();
    const { fps } = useVideoConfig();
    const timeSec = frame / fps;

    const particleData = useMemo(() => {
        const count = 60;
        const basePositions = new Float32Array(count * 3);
        const speeds = new Float32Array(count);

        for (let i = 0; i < count; i++) {
            const seed1 = Math.sin(i * 12.9898 + 78.233) * 43758.5453;
            const rx = seed1 - Math.floor(seed1);
            const seed2 = Math.sin(i * 45.164 + 19.135) * 23421.6312;
            const ry = seed2 - Math.floor(seed2);
            const seed3 = Math.sin(i * 93.719 + 51.482) * 65432.1234;
            const rz = seed3 - Math.floor(seed3);

            basePositions[i * 3] = (rx - 0.5) * 11.5;
            basePositions[i * 3 + 1] = (ry - 0.5) * 6.8;
            basePositions[i * 3 + 2] = -2.6 + rz * 3.2;
            speeds[i] = 0.14 + (rx * 0.5 + ry * 0.5) * 0.22;
        }
        return { count, basePositions, speeds };
    }, []);

    const currentPositions = useMemo(() => {
        const arr = new Float32Array(particleData.count * 3);
        for (let i = 0; i < particleData.count; i++) {
            const bx = particleData.basePositions[i * 3];
            const by = particleData.basePositions[i * 3 + 1];
            const bz = particleData.basePositions[i * 3 + 2];
            const speed = particleData.speeds[i];

            let y = by + timeSec * speed;
            if (y > 3.4) {
                y = -3.4 + ((y + 3.4) % 6.8);
            }

            arr[i * 3] = bx;
            arr[i * 3 + 1] = y;
            arr[i * 3 + 2] = bz;
        }
        return arr;
    }, [particleData, timeSec]);

    const dustOpacity = interpolate(
        frame,
        [0, 0.55 * fps, 5.1 * fps, 5.5 * fps],
        [0, 0.17, 0.17, 0],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );

    return (
        <points>
            <bufferGeometry>
                <bufferAttribute
                    attach="attributes-position"
                    count={particleData.count}
                    array={currentPositions}
                    itemSize={3}
                />
            </bufferGeometry>
            <pointsMaterial
                color="#7DD3FC"
                size={0.036}
                transparent
                opacity={dustOpacity}
                depthWrite={false}
                sizeAttenuation
            />
        </points>
    );
};

/**
 * Camera Dolly-Out Controller:
 * Starts closer at Z = 6.35 to showcase the dramatic 3D exploded mechanical layers,
 * smoothly dollies out to Z = 8.20 at 2.60s (frame 156), and holds 100% still thereafter.
 */
const CameraDollyRig: React.FC = () => {
    const frame = useCurrentFrame();
    const { fps } = useVideoConfig();
    const { camera } = useThree();

    const dollyProgress = interpolate(frame, [0, 2.6 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: EASE_CAMERA_DOLLY,
    });

    const camZ = interpolate(dollyProgress, [0, 1], [6.35, 8.2]);
    camera.position.set(0, 0, camZ);
    camera.lookAt(0, 0, 0);
    camera.updateProjectionMatrix();

    return null;
};

const SkensaEmblem3DScene: React.FC<{
    textures: LogoLayerTextures;
}> = ({ textures }) => {
    const frame = useCurrentFrame();
    const { fps } = useVideoConfig();

    const outerBevelCoreGeo = useMemo(
        () => createBeveledAnnulusGeometry(1.365, 1.74, 0.26),
        []
    );
    const innerBevelCoreGeo = useMemo(
        () => createBeveledAnnulusGeometry(1.095, 1.28, 0.22),
        []
    );
    const cyanBevelCoreGeo = useMemo(
        () => createBeveledAnnulusGeometry(0, 1.095, 0.2),
        []
    );

    // =========================================================================
    // 1. Dramatic Oblique Angle (-41 deg Y, +19 deg X) -> 0 deg Lock at 2.60s
    //    CRITICAL: 100% still (zero left/right movement) from 2.60s -> 5.50s!
    // =========================================================================
    const cameraLockProgress = interpolate(frame, [0, 2.6 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: EASE_CAMERA_DOLLY,
    });

    const masterRotY = interpolate(cameraLockProgress, [0, 1], [-0.72, 0]);
    const masterRotX = interpolate(cameraLockProgress, [0, 1], [0.34, 0]);
    const masterRotZ = interpolate(cameraLockProgress, [0, 1], [-0.15, 0]);
    const masterPosY = interpolate(cameraLockProgress, [0, 1], [0.18, 0.44]);

    // =========================================================================
    // 2. Deep Z-Exploded 4-Tier Mechanical Assembly (0.10s -> 2.60s)
    // =========================================================================
    // TIER 1: Outer 24-tooth gear wakes in deep Z (-1.15) and locks at 1.40s (Click 1)
    const outerOpacity = interpolate(frame, [0.08 * fps, 0.48 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const outerProgress = interpolate(
        frame,
        [0.08 * fps, 1.4 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_MECHANICAL_LOCK,
        }
    );
    const outerZ = interpolate(outerProgress, [0, 1], [-1.15, 0]);
    const outerScale = interpolate(outerProgress, [0, 1], [0.66, 1.0]);
    const outerRotZ = interpolate(outerProgress, [0, 1], [1.75, 0]);

    // TIER 2: Inner 8-tooth navy gear glides from foreground Z (+1.45) & locks at 2.00s (Click 2)
    const innerOpacity = interpolate(frame, [0.68 * fps, 0.98 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const innerProgress = interpolate(
        frame,
        [0.68 * fps, 2.0 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_MECHANICAL_LOCK,
        }
    );
    const innerZ = interpolate(innerProgress, [0, 1], [1.45, 0.08]);
    const innerScale = interpolate(innerProgress, [0, 1], [0.76, 1.0]);
    const innerRotZ = interpolate(innerProgress, [0, 1], [-1.52, 0]);

    // TIER 3: Beveled Cyan Core Pedestal opens like a precision iris inside the navy ring (1.25s -> 2.15s)
    const cyanVisible = frame >= Math.round(1.22 * fps);
    const cyanProgress = interpolate(
        frame,
        [1.22 * fps, 2.15 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_MECHANICAL_LOCK,
        }
    );
    const cyanZ = interpolate(cyanProgress, [0, 1], [0.46, 0.15]);
    const cyanScale = interpolate(cyanProgress, [0, 1], [0.02, 1.0]);

    // TIER 4: Central Scholar & 3-Tier Open Book descends from foreground Z (+2.15 -> +0.27) & locks at 2.60s (Master Click 3)
    const scholarOpacity = interpolate(
        frame,
        [1.48 * fps, 1.78 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const scholarProgress = interpolate(
        frame,
        [1.48 * fps, 2.6 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_MECHANICAL_LOCK,
        }
    );
    const scholarZ = interpolate(scholarProgress, [0, 1], [2.15, 0.27]);
    const scholarScale = interpolate(scholarProgress, [0, 1], [0.68, 1.0]);
    const scholarRotZ = interpolate(scholarProgress, [0, 1], [0.48, 0]);

    // =========================================================================
    // 3. Rim-Light Awakening (0.0s -> 1.5s) & PBR Light Sweep (2.65s -> 3.45s)
    // =========================================================================
    const studioAmbientIntensity = interpolate(
        frame,
        [0, 0.55 * fps, 1.6 * fps],
        [0.24, 0.58, 0.94],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const studioKeyIntensity = interpolate(
        frame,
        [0, 0.65 * fps, 1.8 * fps],
        [0.45, 1.05, 1.55],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const rimLightIntensity = interpolate(
        frame,
        [0, 0.5 * fps, 2.2 * fps, 2.8 * fps],
        [0.3, 1.65, 1.35, 0.95],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );

    const sweepProgress = interpolate(
        frame,
        [2.65 * fps, 3.45 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: Easing.inOut(Easing.cubic),
        }
    );
    const sweepLightX = interpolate(sweepProgress, [0, 1], [-4.8, 4.8]);
    const sweepLightY = interpolate(sweepProgress, [0, 1], [3.6, -2.8]);
    const sweepLightIntensity = interpolate(
        frame,
        [2.6 * fps, 3.02 * fps, 3.5 * fps],
        [0, 3.8, 0.35],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );

    return (
        <>
            <CameraDollyRig />
            <FloatingDustParticles />

            {/* Studio PBR Lighting Rig (Awakens from Rim-Lit Blueprint to Crisp Studio Light) */}
            <ambientLight intensity={studioAmbientIntensity} color="#eef6ff" />
            <hemisphereLight
                color="#f8fafc"
                groundColor="#071c3f"
                intensity={0.55}
            />
            <directionalLight
                position={[4.2, 5.0, 6.4]}
                intensity={studioKeyIntensity}
                color="#ffffff"
            />
            <directionalLight
                position={[-4.8, -2.2, 4.6]}
                intensity={rimLightIntensity}
                color="#38bdf8"
            />
            <pointLight
                position={[sweepLightX, sweepLightY, 3.6]}
                intensity={sweepLightIntensity}
                distance={14}
                color="#e0f2fe"
            />

            <group
                position={[0, masterPosY, 0]}
                rotation={[masterRotX, masterRotY, masterRotZ]}
                scale={0.78}
            >
                {/* 3D Mechanical Blueprint Calibration Rings & Ticks */}
                <BlueprintCalibrationRig lockProgress={cameraLockProgress} />

                {/* ========================================================= */}
                {/* TIER 1: 3D Extruded & Beveled 24-Tooth Outer Gear         */}
                {/* ========================================================= */}
                <group
                    position={[0, 0, outerZ]}
                    rotation={[0, 0, outerRotZ]}
                    scale={outerScale}
                >
                    <VolumetricExtrudedLayer
                        frontTex={textures.outerGearFront}
                        sideTex={textures.outerGearSide}
                        bevelTex={textures.outerGearBevel}
                        radius={2.22}
                        depth={0.32}
                        slices={32}
                        opacity={outerOpacity}
                        bevelCoreGeo={outerBevelCoreGeo}
                        bevelCoreColor="#2B5B91"
                    />
                </group>

                {/* ========================================================= */}
                {/* TIER 2: 3D Extruded & Beveled 8-Tooth Inner Navy Ring     */}
                {/* ========================================================= */}
                <group
                    position={[0, 0, innerZ]}
                    rotation={[0, 0, innerRotZ]}
                    scale={innerScale}
                >
                    <VolumetricExtrudedLayer
                        frontTex={textures.innerRingFront}
                        sideTex={textures.innerRingSide}
                        bevelTex={textures.innerRingBevel}
                        radius={2.22}
                        depth={0.26}
                        slices={24}
                        opacity={innerOpacity}
                        bevelCoreGeo={innerBevelCoreGeo}
                        bevelCoreColor="#163B65"
                    />
                </group>

                {/* ========================================================= */}
                {/* TIER 3: 3D Beveled Cyan Core Pedestal                     */}
                {/* ========================================================= */}
                {cyanVisible && (
                    <group position={[0, 0, cyanZ]} scale={cyanScale}>
                        <mesh geometry={cyanBevelCoreGeo}>
                            <meshStandardMaterial
                                color="#279AA6"
                                metalness={0.35}
                                roughness={0.32}
                            />
                        </mesh>

                        <mesh position={[0, 0, 0.122]}>
                            <circleGeometry args={[2.22, 96]} />
                            <meshStandardMaterial
                                map={textures.cyanDiscFront}
                                transparent
                                alphaTest={0.02}
                                roughness={0.3}
                                metalness={0.22}
                            />
                        </mesh>
                    </group>
                )}

                {/* ========================================================= */}
                {/* TIER 4: 3D Extruded Scholar & 3-Tier Open Book Silhouette */}
                {/* ========================================================= */}
                <group
                    position={[0, 0, scholarZ]}
                    rotation={[0, 0, scholarRotZ]}
                    scale={scholarScale}
                >
                    <VolumetricExtrudedLayer
                        frontTex={textures.scholarFront}
                        sideTex={textures.scholarSide}
                        bevelTex={textures.scholarBevel}
                        radius={2.22}
                        depth={0.18}
                        slices={22}
                        opacity={scholarOpacity}
                    />
                </group>
            </group>
        </>
    );
};

const MOTTO_CHARS = Array.from('ABHYĀSAD DHÄRYATE VIDYÄ');

export const SkensaIntro: React.FC = () => {
    const frame = useCurrentFrame();
    const { fps, width, height } = useVideoConfig();

    const [textures, setTextures] = useState<LogoLayerTextures | null>(null);
    const [renderHandle] = useState(() =>
        delayRender('Loading 3D SKENSA Volumetric Logo Textures')
    );

    useEffect(() => {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = () => {
            const outer = createAnnularTextureSet(
                img,
                0.612,
                1.0,
                '#29558A',
                '#173254',
                '#5B9BD5'
            );
            const inner = createAnnularTextureSet(
                img,
                0.492,
                0.625,
                '#1A4373',
                '#0C213D',
                '#3876B8'
            );
            const {
                cyanDiscFront,
                scholarFront,
                scholarSide,
                scholarBevel,
            } = createScholarAndCyanTextures(img);

            setTextures({
                outerGearFront: outer.front,
                outerGearSide: outer.side,
                outerGearBevel: outer.bevel,
                innerRingFront: inner.front,
                innerRingSide: inner.side,
                innerRingBevel: inner.bevel,
                cyanDiscFront,
                scholarFront,
                scholarSide,
                scholarBevel,
            });
            continueRender(renderHandle);
        };
        img.onerror = (err) => {
            console.error('Failed to load logo_skensa.png', err);
            continueRender(renderHandle);
        };
        img.src = staticFile('logo_skensa.png');
    }, [renderHandle]);

    // =========================================================================
    // Typography & Motto Choreography (2.45s -> 3.55s, right as Master Lock hits at 2.60s)
    // =========================================================================
    const titleProgress = interpolate(
        frame,
        [2.45 * fps, 3.05 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_OUT_EXPO,
        }
    );
    const titleOpacity = interpolate(
        frame,
        [2.45 * fps, 2.9 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const titleY = interpolate(titleProgress, [0, 1], [16, 0]);
    const titleTracking = interpolate(titleProgress, [0, 1], [0.16, 0.32]);

    const lineScaleX = interpolate(
        frame,
        [2.58 * fps, 3.15 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_OUT_EXPO,
        }
    );

    const subtitleProgress = interpolate(
        frame,
        [2.95 * fps, 3.55 * fps],
        [0, 1],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: EASE_OUT_EXPO,
        }
    );
    const subtitleOpacity = interpolate(
        frame,
        [2.95 * fps, 3.45 * fps],
        [0, 0.72],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );
    const subtitleY = interpolate(subtitleProgress, [0, 1], [8, 0]);
    const subtitleTracking = interpolate(subtitleProgress, [0, 1], [0.08, 0.2]);

    // Optical Light Sweep Overlay (2.65s -> 3.45s, Top-Left to Bottom-Right)
    const sheenTranslate = interpolate(
        frame,
        [2.65 * fps, 3.45 * fps],
        [-130, 130],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
            easing: Easing.inOut(Easing.cubic),
        }
    );
    const sheenOpacity = interpolate(
        frame,
        [2.65 * fps, 3.05 * fps, 3.45 * fps],
        [0, 0.36, 0],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );

    // Smooth final settle before GSAP curtain split (5.15s -> 5.50s)
    const outroContentOpacity = interpolate(
        frame,
        [5.15 * fps, 5.5 * fps],
        [1, 0.92],
        {
            extrapolateLeft: 'clamp',
            extrapolateRight: 'clamp',
        }
    );

    return (
        <AbsoluteFill
            style={{
                backgroundColor: '#071C3F',
                fontFamily:
                    "'Plus Jakarta Sans', 'Inter', system-ui, sans-serif",
                color: '#F8FAFC',
                overflow: 'hidden',
            }}
        >
            {/* Minimalist 5.5s 3D Sound Effects (No Voiceover) */}
            <Audio src={staticFile('intro_audio.mp3')} volume={0.9} />

            {/* Radial Studio Backdrop with Soft Vignette */}
            <div
                style={{
                    position: 'absolute',
                    inset: 0,
                    background:
                        'radial-gradient(circle at 50% 42%, #123366 0%, #091F44 52%, #05132B 100%)',
                }}
            />

            <AbsoluteFill style={{ opacity: outroContentOpacity }}>
                {/* Remotion + Three.js WebGL 3D Canvas */}
                {textures && (
                    <ThreeCanvas
                        orthographic={false}
                        width={width}
                        height={height}
                        style={{
                            position: 'absolute',
                            inset: 0,
                        }}
                        camera={{ fov: 38, position: [0, 0, 8.2] }}
                    >
                        <SkensaEmblem3DScene textures={textures} />
                    </ThreeCanvas>
                )}

                {/* Top-Left to Bottom-Right Optical Gleam across Logo Area (2.65s -> 3.45s) */}
                <div
                    style={{
                        position: 'absolute',
                        left: '50%',
                        top: '41%',
                        width: 460,
                        height: 460,
                        marginLeft: -230,
                        marginTop: -230,
                        borderRadius: '50%',
                        overflow: 'hidden',
                        pointerEvents: 'none',
                        opacity: sheenOpacity,
                        mixBlendMode: 'screen',
                    }}
                >
                    <div
                        style={{
                            position: 'absolute',
                            inset: -120,
                            background:
                                'linear-gradient(135deg, rgba(255,255,255,0) 38%, rgba(224,242,254,0.65) 50%, rgba(255,255,255,0) 62%)',
                            transform: `translate(${sheenTranslate}%, ${sheenTranslate}%)`,
                        }}
                    />
                </div>

                {/* Minimalist Typography & Animated Motto Footer */}
                <div
                    style={{
                        position: 'absolute',
                        left: 0,
                        right: 0,
                        bottom: 68,
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                        justifyContent: 'center',
                        pointerEvents: 'none',
                    }}
                >
                    {/* Main School Title */}
                    <div
                        style={{
                            fontSize: 26,
                            fontWeight: 700,
                            letterSpacing: `${titleTracking}em`,
                            textTransform: 'uppercase',
                            color: '#F8FAFC',
                            opacity: titleOpacity,
                            transform: `translateY(${titleY}px)`,
                            marginBottom: 12,
                        }}
                    >
                        SMK NEGERI 1 DENPASAR
                    </div>

                    {/* Cyan-Ice Divider Line (Strictly Zero Yellow) */}
                    <div
                        style={{
                            width: 68,
                            height: 2,
                            background:
                                'linear-gradient(90deg, rgba(53,184,196,0.2) 0%, #35B8C4 50%, rgba(53,184,196,0.2) 100%)',
                            borderRadius: 999,
                            transform: `scaleX(${lineScaleX})`,
                            marginBottom: 14,
                        }}
                    />

                    {/* Animated Sanskrit Motto (Staggered Per-Character Reveal + Cyan Gleam) */}
                    <div
                        style={{
                            display: 'flex',
                            flexDirection: 'row',
                            alignItems: 'center',
                            justifyContent: 'center',
                            fontSize: 15,
                            fontWeight: 600,
                            letterSpacing: '0.26em',
                            textTransform: 'uppercase',
                            marginBottom: 7,
                        }}
                    >
                        {MOTTO_CHARS.map((char, idx) => {
                            const charStart = (2.64 + idx * 0.018) * fps;
                            const charEnd = charStart + 0.36 * fps;

                            const charProgress = interpolate(
                                frame,
                                [charStart, charEnd],
                                [0, 1],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                    easing: EASE_OUT_EXPO,
                                }
                            );
                            const charOpacity = interpolate(
                                frame,
                                [charStart, charStart + 0.22 * fps],
                                [0, 1],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                }
                            );
                            const charY = interpolate(
                                charProgress,
                                [0, 1],
                                [10, 0]
                            );
                            const charScale = interpolate(
                                charProgress,
                                [0, 1],
                                [0.92, 1]
                            );

                            // Subtle cyan highlight as each character settles into crisp ice-white
                            const highlightMix = interpolate(
                                frame,
                                [
                                    charStart + 0.1 * fps,
                                    charEnd,
                                    charEnd + 0.25 * fps,
                                ],
                                [1, 0.4, 0],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                }
                            );

                            return (
                                <span
                                    key={idx}
                                    style={{
                                        display: 'inline-block',
                                        whiteSpace: 'pre',
                                        opacity: charOpacity,
                                        transform: `translateY(${charY}px) scale(${charScale})`,
                                        color:
                                            highlightMix > 0.35
                                                ? '#7DD3FC'
                                                : '#E2E8F0',
                                        textShadow:
                                            highlightMix > 0.2
                                                ? `0 0 12px rgba(53, 184, 196, ${
                                                      highlightMix * 0.55
                                                  })`
                                                : 'none',
                                    }}
                                >
                                    {char}
                                </span>
                            );
                        })}
                    </div>

                    {/* Animated Motto Meaning Subtitle */}
                    <div
                        style={{
                            fontSize: 12,
                            fontWeight: 400,
                            letterSpacing: `${subtitleTracking}em`,
                            color: 'rgba(226, 232, 240, 0.72)',
                            opacity: subtitleOpacity,
                            transform: `translateY(${subtitleY}px)`,
                        }}
                    >
                        Peliharalah ilmu sampai menjadi tradisi
                    </div>
                </div>
            </AbsoluteFill>
        </AbsoluteFill>
    );
};
