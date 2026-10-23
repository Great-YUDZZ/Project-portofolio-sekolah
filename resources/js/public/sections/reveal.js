import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initReveal() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const revealElements = document.querySelectorAll('[data-reveal]');
    revealElements.forEach((el) => {
        const delay = parseFloat(el.getAttribute('data-reveal-delay') || '0');
        gsap.fromTo(
            el,
            { y: 28, autoAlpha: 0 },
            {
                y: 0,
                autoAlpha: 1,
                duration: 0.75,
                delay,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    once: true,
                },
            }
        );
    });

    const staggerGroups = document.querySelectorAll('[data-reveal-stagger]');
    staggerGroups.forEach((group) => {
        const children = group.querySelectorAll('[data-reveal-item]');
        if (!children.length) return;

        gsap.fromTo(
            children,
            { y: 26, autoAlpha: 0 },
            {
                y: 0,
                autoAlpha: 1,
                duration: 0.65,
                stagger: 0.08,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: group,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    });
}
