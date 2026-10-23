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
    const skipBtn = overlay.querySelector('[data-intro-skip]');
    const replayBtn = document.querySelector('[data-intro-replay]');

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const alreadySeen = sessionStorage.getItem('skensa_intro_seen') === '1';

    const closeIntroImmediate = () => {
        overlay.style.display = 'none';
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
        ScrollTrigger.refresh();
    };

    const runSplitReveal = () => {
        if (overlay.dataset.closing === '1') return;
        overlay.dataset.closing = '1';
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
            duration: 0.4,
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

    const startIntro = () => {
        overlay.dataset.closing = '0';
        overlay.style.display = 'flex';
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');

        gsap.set([topCurtain, bottomCurtain], { yPercent: 0 });
        gsap.set(videoWrap, { opacity: 1, scale: 1 });

        if (video) {
            video.currentTime = 0;
            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.catch(() => {
                    gsap.delayedCall(1.8, runSplitReveal);
                });
            }
            video.onended = () => runSplitReveal();
        } else {
            gsap.delayedCall(2.2, runSplitReveal);
        }

        // Fallback otomatis jika video gagal memicu ended
        gsap.delayedCall(4.5, () => {
            if (overlay.dataset.closing !== '1') {
                runSplitReveal();
            }
        });
    };

    if (skipBtn) {
        skipBtn.addEventListener('click', () => {
            if (video) video.pause();
            runSplitReveal();
        });
    }

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
