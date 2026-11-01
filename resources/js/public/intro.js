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
    const progressBar = overlay.querySelector('[data-intro-progress]');
    const replayBtn = document.querySelector('[data-intro-replay]');
    const introVersion = overlay.dataset.introVersion || '55';
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const urlParams = new URLSearchParams(window.location.search);
    const forceIntro = urlParams.has('intro');
    const alreadySeen =
        !forceIntro &&
        sessionStorage.getItem('skensa_intro_seen_ver') === introVersion;

    let fallbackTimer = null;
    let progressTween = null;

    const clearTimers = () => {
        if (fallbackTimer) {
            fallbackTimer.kill();
            fallbackTimer = null;
        }
        if (progressTween) {
            progressTween.kill();
            progressTween = null;
        }
    };


    const closeIntroImmediate = () => {
        clearTimers();
        if (video) {
            video.pause();
        }
        overlay.style.display = 'none';
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
        ScrollTrigger.refresh();
    };

    const runSplitReveal = () => {
        if (overlay.dataset.closing === '1') return;
        overlay.dataset.closing = '1';
        clearTimers();
        sessionStorage.setItem('skensa_intro_seen_ver', introVersion);

        const heroTargets = document.querySelectorAll(
            '[data-hero-animate], [data-hero-badge], [data-hero-title], [data-hero-cta]'
        );

        const tl = gsap.timeline({
            defaults: { ease: 'expo.inOut' },
            onComplete: () => {
                closeIntroImmediate();
            },
        });

        tl.to(videoWrap, {
            opacity: 0,
            scale: 1.02,
            duration: 0.36,
            ease: 'power2.in',
        })
            .to(
                topCurtain,
                {
                    yPercent: -100,
                    duration: 0.78,
                },
                '-=0.12'
            )
            .to(
                bottomCurtain,
                {
                    yPercent: 100,
                    duration: 0.78,
                },
                '<'
            );

        if (heroTargets.length) {
            tl.fromTo(
                heroTargets,
                { y: 22, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    stagger: 0.07,
                    ease: 'power3.out',
                },
                '-=0.42'
            );
        }
    };

    const armFallbackTimer = (seconds = 5.85) => {
        clearTimers();
        if (progressBar) {
            gsap.set(progressBar, { scaleX: 0 });
            progressTween = gsap.to(progressBar, {
                scaleX: 1,
                duration: 5.5,
                ease: 'none',
            });
        }
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

        gsap.set([topCurtain, bottomCurtain], { yPercent: 0 });
        gsap.set(videoWrap, { opacity: 1, scale: 1 });

        if (video) {
            // Attempt unmuted autoplay by default
            video.muted = false;
            video.volume = 0.95;
            video.onended = () => runSplitReveal();
            video.onerror = () => runSplitReveal();

            armFallbackTimer(5.85);

            // Listeners to instantly restore sound on ANY first user gesture
            const gestureEvents = ['pointerdown', 'touchstart', 'mousedown', 'keydown', 'wheel'];
            const onFirstGesture = () => {
                if (video && video.muted) {
                    video.muted = false;
                    video.volume = 0.95;
                }
                gestureEvents.forEach((ev) => window.removeEventListener(ev, onFirstGesture, true));
            };
            gestureEvents.forEach((ev) => window.addEventListener(ev, onFirstGesture, { capture: true, once: true }));

            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.catch(() => {
                    // Browser strictly blocked unmuted autoplay on cold session:
                    // Play muted so visual is seamless, and let the gesture listener unmute on the very first touch/click/scroll!
                    video.muted = true;
                    video.play().catch(() => {
                        gsap.delayedCall(1.5, runSplitReveal);
                    });
                });
            }
        } else {
            armFallbackTimer(2.0);
        }
    };

    overlay.addEventListener('click', () => {
        if (overlay.style.display !== 'none' && overlay.dataset.closing !== '1') {
            if (video && video.muted) {
                video.muted = false;
                video.volume = 0.95;
            } else {
                runSplitReveal();
            }
        }
    });

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.style.display !== 'none' && overlay.dataset.closing !== '1') {
            runSplitReveal();
        }
    });

    if (replayBtn) {
        replayBtn.addEventListener('click', () => {
            sessionStorage.removeItem('skensa_intro_seen_ver');
            startIntro();
        });
    }

    if (prefersReducedMotion || alreadySeen) {
        closeIntroImmediate();
    } else {
        startIntro();
    }
}
