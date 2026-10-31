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
    const audioToggleBtn = overlay.querySelector('[data-intro-audio-toggle]');
    const audioDot = overlay.querySelector('[data-intro-audio-dot]');
    const audioLabel = overlay.querySelector('[data-intro-audio-label]');
    const skipBtn = overlay.querySelector('[data-intro-skip]');
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

    const updateAudioButtonState = (isMuted) => {
        if (!audioDot || !audioLabel) return;
        if (isMuted) {
            audioDot.classList.remove('bg-[#35B8C4]');
            audioDot.classList.add('bg-paper/40');
            audioLabel.textContent = 'Suara Mati';
        } else {
            audioDot.classList.remove('bg-paper/40');
            audioDot.classList.add('bg-[#35B8C4]');
            audioLabel.textContent = 'Suara Aktif';
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
            video.currentTime = 0;
            video.muted = false;
            video.volume = 0.85;
            video.onended = () => runSplitReveal();

            armFallbackTimer(5.85);

            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise
                    .then(() => {
                        updateAudioButtonState(false);
                    })
                    .catch(() => {
                        // Browser blocked unmuted autoplay: immediately play muted so 3D intro never stalls
                        video.muted = true;
                        updateAudioButtonState(true);
                        video.play().catch(() => {
                            gsap.delayedCall(1.5, runSplitReveal);
                        });
                    });
            }
        } else {
            armFallbackTimer(2.0);
        }
    };

    audioToggleBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        if (!video) return;
        video.muted = !video.muted;
        if (!video.muted) {
            video.volume = 0.85;
            video.play().catch(() => {});
        }
        updateAudioButtonState(video.muted);
    });

    skipBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        runSplitReveal();
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
