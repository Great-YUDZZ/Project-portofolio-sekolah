import React from 'react';
import {
    AbsoluteFill,
    Easing,
    Img,
    interpolate,
    staticFile,
    useCurrentFrame,
    useVideoConfig,
} from 'remotion';

const SLOGAN = 'Abhyāsad Dhäryate Vidyä';
const SUBTITLE = 'PELIHARALAH ILMU SAMPAI MENJADI TRADISI';

export const SkensaIntro: React.FC = () => {
    const frame = useCurrentFrame();
    const { fps } = useVideoConfig();

    // 1. Lingkaran & Poligon Perisai SKENSA tergambar (0s - 1.1s)
    const strokeProgress = interpolate(frame, [0, 1.1 * fps], [540, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.16, 1, 0.3, 1),
    });

    // Roda gigi teknik berputar halus
    const gearRotation = interpolate(frame, [0, 3 * fps], [0, 90], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });

    // Logo Emblem resmi muncul di tengah perisai (0.4s - 1.2s)
    const emblemOpacity = interpolate(frame, [0.35 * fps, 1.0 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const emblemScale = interpolate(frame, [0.35 * fps, 1.1 * fps], [0.78, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.16, 1, 0.3, 1),
    });

    // 2. Judul SMK Negeri 1 Denpasar (0.7s - 1.4s)
    const titleOpacity = interpolate(frame, [0.65 * fps, 1.25 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });
    const titleY = interpolate(frame, [0.65 * fps, 1.25 * fps], [24, 0], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.16, 1, 0.3, 1),
    });

    // 3. Sapuan kuas kuning khas SKENSA (1.2s - 2.0s)
    const yellowLineProgress = interpolate(frame, [1.15 * fps, 2.0 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
        easing: Easing.bezier(0.16, 1, 0.3, 1),
    });

    // 4. Arti semboyan muncul di bawah (1.6s - 2.3s)
    const subOpacity = interpolate(frame, [1.55 * fps, 2.2 * fps], [0, 1], {
        extrapolateLeft: 'clamp',
        extrapolateRight: 'clamp',
    });

    return (
        <AbsoluteFill
            style={{
                backgroundColor: '#0B2A5B',
                display: 'flex',
                flexDirection: 'column',
                alignItems: 'center',
                justifyContent: 'center',
                fontFamily: 'sans-serif',
                color: '#F7F6F2',
                overflow: 'hidden',
            }}
        >
            {/* Grid arsitektur halus di latar belakang */}
            <div
                style={{
                    position: 'absolute',
                    inset: 0,
                    backgroundImage:
                        'linear-gradient(to right, rgba(247,246,242,0.04) 1px, transparent 1px), linear-gradient(to bottom, rgba(247,246,242,0.04) 1px, transparent 1px)',
                    backgroundSize: '80px 80px',
                }}
            />

            {/* Lingkaran Geometris & Roda Gigi Vokasi */}
            <div
                style={{
                    position: 'relative',
                    width: 240,
                    height: 240,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    marginBottom: 32,
                }}
            >
                <svg
                    width="240"
                    height="240"
                    viewBox="0 0 240 240"
                    style={{
                        position: 'absolute',
                        inset: 0,
                        transform: `rotate(${gearRotation}deg)`,
                    }}
                >
                    <circle
                        cx="120"
                        cy="120"
                        r="108"
                        fill="none"
                        stroke="rgba(245, 183, 0, 0.25)"
                        strokeWidth="1.5"
                        strokeDasharray="8 8"
                    />
                </svg>

                <svg
                    width="220"
                    height="220"
                    viewBox="0 0 200 200"
                    style={{ position: 'absolute' }}
                >
                    {/* Segi Lima Perisai Terlukis Garis demi Garis */}
                    <polygon
                        points="100,12 184,70 154,174 46,174 16,70"
                        fill="rgba(18, 58, 120, 0.55)"
                        stroke="#F5B700"
                        strokeWidth="3"
                        strokeDasharray="540"
                        strokeDashoffset={strokeProgress}
                        strokeLinejoin="round"
                    />
                </svg>

                <div
                    style={{
                        opacity: emblemOpacity,
                        transform: `scale(${emblemScale})`,
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                    }}
                >
                    <Img
                        src={staticFile('logo_emblem.png')}
                        style={{
                            width: 112,
                            height: 112,
                            objectFit: 'contain',
                        }}
                    />
                </div>
            </div>

            {/* Badge Tahun Berdiri & Identitas */}
            <div
                style={{
                    opacity: titleOpacity,
                    transform: `translateY(${titleY}px)`,
                    textAlign: 'center',
                }}
            >
                <div
                    style={{
                        fontSize: 16,
                        letterSpacing: 6,
                        textTransform: 'uppercase',
                        color: '#F5B700',
                        fontWeight: 700,
                        marginBottom: 12,
                    }}
                >
                    SMK NEGERI 1 DENPASAR &bull; SKENSA
                </div>

                {/* Semboyan Muncul per Huruf */}
                <div
                    style={{
                        fontSize: 64,
                        fontWeight: 800,
                        letterSpacing: -1,
                        display: 'flex',
                        justifyContent: 'center',
                        position: 'relative',
                        paddingBottom: 14,
                    }}
                >
                    {SLOGAN.split('').map((char, index) => {
                        const startFrame = 0.75 * fps + index * 1.1;
                        const charOpacity = interpolate(
                            frame,
                            [startFrame, startFrame + 6],
                            [0, 1],
                            {
                                extrapolateLeft: 'clamp',
                                extrapolateRight: 'clamp',
                            }
                        );
                        const charY = interpolate(
                            frame,
                            [startFrame, startFrame + 6],
                            [18, 0],
                            {
                                extrapolateLeft: 'clamp',
                                extrapolateRight: 'clamp',
                                easing: Easing.bezier(0.16, 1, 0.3, 1),
                            }
                        );
                        return (
                            <span
                                key={index}
                                style={{
                                    opacity: charOpacity,
                                    transform: `translateY(${charY}px)`,
                                    display: 'inline-block',
                                    whiteSpace: char === ' ' ? 'pre' : 'normal',
                                }}
                            >
                                {char}
                            </span>
                        );
                    })}
                </div>

                {/* Garis Sapuan Kuning Khas SKENSA */}
                <div
                    style={{
                        width: 480,
                        height: 6,
                        backgroundColor: 'rgba(255,255,255,0.1)',
                        borderRadius: 999,
                        margin: '0 auto 20px auto',
                        overflow: 'hidden',
                    }}
                >
                    <div
                        style={{
                            width: `${yellowLineProgress * 100}%`,
                            height: '100%',
                            backgroundColor: '#F5B700',
                            borderRadius: 999,
                        }}
                    />
                </div>

                <div
                    style={{
                        opacity: subOpacity,
                        fontSize: 18,
                        letterSpacing: 3.5,
                        color: 'rgba(247, 246, 242, 0.82)',
                        fontWeight: 500,
                    }}
                >
                    {SUBTITLE}
                </div>
            </div>
        </AbsoluteFill>
    );
};
