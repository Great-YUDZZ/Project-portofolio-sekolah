import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initHeroSection() {
    const heroSection = document.querySelector('[data-hero-section]');
    if (!heroSection || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const heroImage = heroSection.querySelector('[data-hero-zoom-img]');
    const heroCog = heroSection.querySelector('[data-hero-cog]');

    if (heroImage) {
        gsap.fromTo(
            heroImage,
            { scale: 1.22 },
            {
                scale: 1,
                ease: 'none',
                scrollTrigger: {
                    trigger: heroSection,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 0.8,
                },
            }
        );
    }

    if (heroCog) {
        gsap.to(heroCog, {
            rotation: 180,
            ease: 'none',
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: 1,
            },
        });
    }
}
