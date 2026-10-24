import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initIntro() {
    const overlay = document.getElementById('skensa-intro-overlay');
    if (!overlay) return;

    const topCurtain = overlay.querySelector('[data-intro-top]');
    const bottomCurtain = overlay.querySelector('[data-intro-bottom]');
    const videoWrap = overlay.querySelector('[data-intro-stage]');
    const video = overlay.querySelector('video');
    const soundGate = overlay.querySelector('[data-intro-sound-gate]');
    const replayBtn = document.querySelector('[data-intro-replay]');

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const urlParams = new URLSearchParams(window.location.search);
    const forceIntro = urlParams.has('intro');
    const alreadySeen = !forceIntro && sessionStorage.getItem('skensa_intro_seen') === '1';

    let fallbackTimer = null;

    const clearFallbackTimer = () => {
        if (fallbackTimer) {
            fallbackTimer.kill();
            fallbackTimer = null;
        }
    };

    const closeIntroImmediate = () => {
        clearFallbackTimer();
        overlay.style.display = 'none';
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
        ScrollTrigger.refresh();
    };

    const runSplitReveal = () => {
        if (overlay.dataset.closing === '1') return;
        overlay.dataset.closing = '1';
        clearFallbackTimer();
        sessionStorage.setItem('skensa_intro_seen', '1');

        const tl = gsap.timeline({
            defaults: { ease: 'power3.inOut' },
            onComplete: () => {
                closeIntroImmediate();
            },
        });

        tl.to(videoWrap, {
            opacity: 0,
            scale: 0.96,
            duration: 0.45,
            ease: 'power2.in',
        })
            .to(
                topCurtain,
                {
                    yPercent: -100,
                    duration: 0.85,
                },
                '-=0.15'
            )
            .to(
                bottomCurtain,
                {
                    yPercent: 100,
                    duration: 0.85,
                },
                '<'
            )
            .fromTo(
                '[data-hero-animate]',
                { y: 28, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.7, stagger: 0.08, ease: 'power3.out' },
                '-=0.45'
            );
    };

    const armFallbackTimer = (seconds = 5.6) => {
        clearFallbackTimer();
        fallbackTimer = gsap.delayedCall(seconds, () => {
            if (overlay.dataset.closing !== '1') {
                runSplitReveal();
            }
        });
    };

    const startIntro = () => {
        overlay.dataset.closing = '0';
        overlay.style.display = 'flex';
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');

        if (soundGate) {
            soundGate.classList.add('hidden');
        }

        gsap.set([topCurtain, bottomCurtain], { yPercent: 0 });
        gsap.set(videoWrap, { opacity: 1, scale: 1 });

        if (video) {
            video.currentTime = 0;
            video.muted = false;
            video.volume = 1.0;
            video.onended = () => runSplitReveal();

            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise
                    .then(() => {
                        armFallbackTimer(5.6);
                    })
                    .catch(() => {
                        // Browser blocked unmuted autoplay on initial visit:
                        // Pause at frame 0 and show sleek click-anywhere sound gate so user hears full motto voiceover
                        video.pause();
                        video.currentTime = 0;
                        if (soundGate) {
                            soundGate.classList.remove('hidden');
                        }

                        const unlockAndPlay = () => {
                            if (soundGate) {
                                soundGate.classList.add('hidden');
                            }
                            window.removeEventListener('keydown', unlockAndPlay);
                            overlay.removeEventListener('click', unlockAndPlay);

                            video.currentTime = 0;
                            video.muted = false;
                            video.volume = 1.0;
                            armFallbackTimer(5.6);
                            video.play().catch(() => {
                                video.muted = true;
                                video.play().catch(() => {
                                    gsap.delayedCall(1.8, runSplitReveal);
                                });
                            });
                        };

                        overlay.addEventListener('click', unlockAndPlay, { once: true });
                        window.addEventListener('keydown', unlockAndPlay, { once: true });
                    });
            } else {
                armFallbackTimer(5.6);
            }
        } else {
            armFallbackTimer(2.5);
        }
    };

    if (replayBtn) {
        replayBtn.addEventListener('click', () => {
            sessionStorage.removeItem('skensa_intro_seen');
            startIntro();
        });
    }

    if (prefersReducedMotion || alreadySeen) {
        closeIntroImmediate();
    } else {
        startIntro();
    }
}
