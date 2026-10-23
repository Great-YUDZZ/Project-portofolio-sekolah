import React from 'react';
import {
    AbsoluteFill,
    Easing,
    Img,
    interpolate,
    spring,
    staticFile,
    useCurrentFrame,
    useVideoConfig,
} from 'remotion';

const SLOGAN = 'Abhyāsad Dhäryate Vidyä';
const SUBTITLE = 'PELIHARALAH ILMU SAMPAI MENJADI TRADISI';

export const SkensaIntro: React.FC = () => {
    const frame = useCurrentFrame();
    const { fps } = useVideoConfig();

    // =========================================================================
    // STAGE 1: Outer Technical Ring & Blueprint Tick Marks (0.0s - 1.2s)
    // =========================================================================
    const outerRingStroke = interpolate(frame, [0, 1.05 * fps], [1560, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.22, 1, 0.36, 1),
    });

    const outerGearSpring = spring({
        frame: frame - Math.round(0.08 * fps),
        fps,
        config: {
            damping: 16,
            stiffness: 95,
            mass: 1.1,
        },
    });

    const outerGearScale = interpolate(outerGearSpring, [0, 1], [1.45, 1]);
    const outerGearOpacity = interpolate(frame, [0.05 * fps, 0.45 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const outerGearRotate = interpolate(frame, [0, 1.35 * fps], [-68, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.16, 1, 0.3, 1),
    });

    // =========================================================================
    // STAGE 2: Inner Cyan Core Ring Expansion (0.55s - 1.5s)
    // =========================================================================
    const cyanCoreSpring = spring({
        frame: frame - Math.round(0.55 * fps),
        fps,
        config: {
            damping: 14,
            stiffness: 110,
            mass: 0.9,
        },
    });

    const cyanCoreRadius = interpolate(cyanCoreSpring, [0, 1], [0, 31.5]);
    const cyanStrokeDraw = interpolate(frame, [0.5 * fps, 1.25 * fps], [980, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.22, 1, 0.36, 1),
    });

    // =========================================================================
    // STAGE 3: Central Symbol (Book & Scholar Silhouette) Lock-In (0.95s - 1.85s)
    // =========================================================================
    const centerSymbolSpring = spring({
        frame: frame - Math.round(0.95 * fps),
        fps,
        config: {
            damping: 13,
            stiffness: 125,
            mass: 0.85,
        },
    });

    const centerSymbolScale = interpolate(centerSymbolSpring, [0, 1], [0.55, 1]);
    const centerSymbolOpacity = interpolate(frame, [0.95 * fps, 1.35 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });

    // =========================================================================
    // STAGE 4: Lock-In Pulse Ring & Diagonal Light Glint (1.55s - 2.35s)
    // =========================================================================
    const lockFlashProgress = interpolate(frame, [1.5 * fps, 2.2 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.out(Easing.cubic),
    });

    const lockPulseScale = interpolate(lockFlashProgress, [0, 1], [0.88, 1.34]);
    const lockPulseOpacity = interpolate(lockFlashProgress, [0, 0.25, 1], [0, 0.8, 0]);

    const glintX = interpolate(frame, [1.55 * fps, 2.25 * fps], [-190, 190], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.inOut(Easing.cubic),
    });

    // =========================================================================
    // STAGE 5: Cinematic Typography & Slogan Reveal (1.55s - 3.2s)
    // =========================================================================
    const headerOpacity = interpolate(frame, [1.5 * fps, 1.95 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const headerY = interpolate(frame, [1.5 * fps, 1.95 * fps], [24, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.out(Easing.cubic),
    });

    const yellowLineProgress = interpolate(frame, [2.1 * fps, 2.85 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.22, 1, 0.36, 1),
    });

    const subtitleOpacity = interpolate(frame, [2.45 * fps, 3.0 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const subtitleY = interpolate(frame, [2.45 * fps, 3.0 * fps], [16, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.out(Easing.cubic),
    });

    // Subtle slow cinematic push-in across entire 3.5s
    const masterCameraScale = interpolate(frame, [0, 3.5 * fps], [0.98, 1.03], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });

    const logoSrc = staticFile('logo_skensa.png');

    return (
        <AbsoluteFill
            style={{
                backgroundColor: '#071C3F',
                display: 'flex',
                flexDirection: 'column',
                alignItems: 'center',
                justifyContent: 'center',
                fontFamily: "'Plus Jakarta Sans', 'Inter', system-ui, sans-serif",
                color: '#F7F6F2',
                overflow: 'hidden',
            }}
        >
            {/* Deep Radial Navy Spotlight */}
            <div
                style={{
                    position: 'absolute',
                    inset: 0,
                    background:
                        'radial-gradient(circle at 50% 42%, rgba(22, 72, 148, 0.62) 0%, rgba(11, 42, 91, 0.88) 52%, rgba(6, 22, 51, 1) 100%)',
                }}
            />

            {/* Precision Architectural Grid Background */}
            <div
                style={{
                    position: 'absolute',
                    inset: 0,
                    backgroundImage:
                        'linear-gradient(to right, rgba(247,246,242,0.038) 1px, transparent 1px), linear-gradient(to bottom, rgba(247,246,242,0.038) 1px, transparent 1px)',
                    backgroundSize: '84px 84px',
                }}
            />

            {/* Main Full-Screen Cinematic Stage */}
            <div
                style={{
                    position: 'relative',
                    display: 'flex',
                    flexDirection: 'column',
                    alignItems: 'center',
                    justifyContent: 'center',
                    transform: `scale(${masterCameraScale})`,
                }}
            >
                {/* ========================================================= */}
                {/* CIRCULAR LOGO ASSEMBLY STAGE (520x520px, NO PENTAGON)     */}
                {/* ========================================================= */}
                <div
                    style={{
                        position: 'relative',
                        width: 520,
                        height: 520,
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        marginBottom: 42,
                    }}
                >
                    {/* Lock-In Expanding Golden Shockwave Ring */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 454,
                            height: 454,
                            borderRadius: '50%',
                            border: '3px solid #F5B700',
                            opacity: lockPulseOpacity,
                            transform: `scale(${lockPulseScale})`,
                            boxShadow: '0 0 55px rgba(245, 183, 0, 0.42)',
                        }}
                    />

                    {/* Outer Technical Compass / Blueprint Circles (Circular Only) */}
                    <svg
                        width="520"
                        height="520"
                        viewBox="0 0 520 520"
                        style={{
                            position: 'absolute',
                            inset: 0,
                        }}
                    >
                        {/* Outer Gold Drawing Ring */}
                        <circle
                            cx="260"
                            cy="260"
                            r="246"
                            fill="none"
                            stroke="rgba(245, 183, 0, 0.5)"
                            strokeWidth="2.5"
                            strokeDasharray="1560"
                            strokeDashoffset={outerRingStroke}
                            transform="rotate(-90 260 260)"
                        />

                        {/* Subtle Rotating Technical Degree Ticks */}
                        <circle
                            cx="260"
                            cy="260"
                            r="228"
                            fill="none"
                            stroke="rgba(247, 246, 242, 0.18)"
                            strokeWidth="2"
                            strokeDasharray="5 16"
                            style={{
                                transformOrigin: '260px 260px',
                                transform: `rotate(${frame * 0.25}deg)`,
                            }}
                        />

                        {/* Inner Cyan Blueprint Trace Ring */}
                        <circle
                            cx="260"
                            cy="260"
                            r="152"
                            fill="none"
                            stroke="#2CC5D8"
                            strokeWidth="3"
                            strokeDasharray="980"
                            strokeDashoffset={cyanStrokeDraw}
                            opacity={0.78}
                            transform="rotate(90 260 260)"
                        />
                    </svg>

                    {/* LAYER 1: Outer Gear & "SMK NEGERI 1 DENPASAR" Ring Assembly */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 456,
                            height: 456,
                            opacity: outerGearOpacity,
                            transform: `scale(${outerGearScale}) rotate(${outerGearRotate}deg)`,
                            clipPath: 'circle(49% at 50% 50%)',
                            filter: 'drop-shadow(0 24px 48px rgba(0, 0, 0, 0.5))',
                        }}
                    >
                        <Img
                            src={logoSrc}
                            style={{
                                width: '100%',
                                height: '100%',
                                objectFit: 'contain',
                            }}
                        />
                    </div>

                    {/* Dark Navy Mask to Hide Inner Core Until Stage 2 */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 286,
                            height: 286,
                            borderRadius: '50%',
                            backgroundColor: '#08214A',
                            opacity: interpolate(frame, [0.55 * fps, 0.9 * fps], [1, 0], {
                                extrapolateLeft: 'clamp',
                                extrapolateRight: 'clamp',
                            }),
                        }}
                    />

                    {/* LAYER 2: Inner Cyan Disc Expanding Reveal */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 456,
                            height: 456,
                            clipPath: `circle(${cyanCoreRadius}% at 50% 50%)`,
                        }}
                    >
                        <Img
                            src={logoSrc}
                            style={{
                                width: '100%',
                                height: '100%',
                                objectFit: 'contain',
                            }}
                        />
                    </div>

                    {/* Cyan Mask Over Central Book/Figure Until Stage 3 Pop-In */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 234,
                            height: 234,
                            borderRadius: '50%',
                            backgroundColor: '#29B6C8',
                            opacity: interpolate(
                                frame,
                                [0.55 * fps, 0.75 * fps, 1.0 * fps, 1.3 * fps],
                                [0, 1, 1, 0],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                }
                            ),
                        }}
                    />

                    {/* LAYER 3: Central Scholar & Book Emblem Snap-In */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 456,
                            height: 456,
                            opacity: centerSymbolOpacity,
                            transform: `scale(${centerSymbolScale})`,
                            clipPath: 'circle(27% at 50% 50%)',
                        }}
                    >
                        <Img
                            src={logoSrc}
                            style={{
                                width: '100%',
                                height: '100%',
                                objectFit: 'contain',
                            }}
                        />
                    </div>

                    {/* LAYER 4: Diagonal Light Sweep Across Circular Logo */}
                    <div
                        style={{
                            position: 'absolute',
                            width: 456,
                            height: 456,
                            borderRadius: '50%',
                            overflow: 'hidden',
                            pointerEvents: 'none',
                        }}
                    >
                        <div
                            style={{
                                position: 'absolute',
                                top: -80,
                                bottom: -80,
                                width: 120,
                                background:
                                    'linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.45) 50%, rgba(255,255,255,0) 100%)',
                                transform: `translateX(${glintX * 2.5}px) rotate(25deg)`,
                            }}
                        />
                    </div>
                </div>

                {/* ========================================================= */}
                {/* CINEMATIC TYPOGRAPHY & SLOGAN                             */}
                {/* ========================================================= */}
                <div
                    style={{
                        textAlign: 'center',
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                    }}
                >
                    {/* School Identity Pill Badge */}
                    <div
                        style={{
                            opacity: headerOpacity,
                            transform: `translateY(${headerY}px)`,
                            display: 'inline-flex',
                            alignItems: 'center',
                            gap: 16,
                            padding: '10px 30px',
                            borderRadius: 999,
                            backgroundColor: 'rgba(245, 183, 0, 0.14)',
                            border: '2px solid rgba(245, 183, 0, 0.5)',
                            marginBottom: 22,
                        }}
                    >
                        <span
                            style={{
                                width: 10,
                                height: 10,
                                borderRadius: '50%',
                                backgroundColor: '#F5B700',
                            }}
                        />
                        <span
                            style={{
                                fontSize: 22,
                                letterSpacing: 7.5,
                                textTransform: 'uppercase',
                                color: '#F5B700',
                                fontWeight: 800,
                            }}
                        >
                            SMK NEGERI 1 DENPASAR &bull; SKENSA
                        </span>
                        <span
                            style={{
                                width: 10,
                                height: 10,
                                borderRadius: '50%',
                                backgroundColor: '#F5B700',
                            }}
                        />
                    </div>

                    {/* Per-Character Animated Slogan: Abhyāsad Dhäryate Vidyä */}
                    <div
                        style={{
                            fontSize: 96,
                            fontWeight: 900,
                            letterSpacing: -2,
                            display: 'flex',
                            justifyContent: 'center',
                            lineHeight: 1.08,
                            paddingBottom: 22,
                            textShadow: '0 12px 36px rgba(0, 0, 0, 0.5)',
                        }}
                    >
                        {SLOGAN.split('').map((char, index) => {
                            const startFrame = 1.6 * fps + index * 1.15;
                            const charOpacity = interpolate(
                                frame,
                                [startFrame, startFrame + 8],
                                [0, 1],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                }
                            );
                            const charY = interpolate(
                                frame,
                                [startFrame, startFrame + 8],
                                [30, 0],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                    easing: Easing.bezier(0.16, 1, 0.3, 1),
                                }
                            );
                            const charScale = interpolate(
                                frame,
                                [startFrame, startFrame + 8],
                                [0.85, 1],
                                {
                                    extrapolateLeft: 'clamp',
                                    extrapolateRight: 'clamp',
                                    easing: Easing.out(Easing.back(1.6)),
                                }
                            );

                            return (
                                <span
                                    key={index}
                                    style={{
                                        opacity: charOpacity,
                                        transform: `translateY(${charY}px) scale(${charScale})`,
                                        display: 'inline-block',
                                        whiteSpace: char === ' ' ? 'pre' : 'normal',
                                    }}
                                >
                                    {char}
                                </span>
                            );
                        })}
                    </div>

                    {/* SKENSA Golden Brush Line */}
                    <div
                        style={{
                            width: 780,
                            height: 8,
                            backgroundColor: 'rgba(247, 246, 242, 0.14)',
                            borderRadius: 999,
                            margin: '0 auto 24px auto',
                            overflow: 'hidden',
                        }}
                    >
                        <div
                            style={{
                                width: `${yellowLineProgress * 100}%`,
                                height: '100%',
                                backgroundColor: '#F5B700',
                                borderRadius: 999,
                                boxShadow: '0 0 24px rgba(245, 183, 0, 0.65)',
                            }}
                        />
                    </div>

                    {/* Subtitle Meaning */}
                    <div
                        style={{
                            opacity: subtitleOpacity,
                            transform: `translateY(${subtitleY}px)`,
                            fontSize: 24,
                            letterSpacing: 5.5,
                            color: 'rgba(247, 246, 242, 0.9)',
                            fontWeight: 600,
                        }}
                    >
                        {SUBTITLE}
                    </div>
                </div>
            </div>
        </AbsoluteFill>
    );
};
