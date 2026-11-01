import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initReveal() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // 1. Single Elements Reveal
    const revealElements = document.querySelectorAll('[data-reveal]');
    revealElements.forEach((el) => {
        const delay = parseFloat(el.getAttribute('data-reveal-delay') || '0');
        const once = el.getAttribute('data-reveal-once') === 'true';
        const direction = el.getAttribute('data-reveal-direction') || 'up';
        const distance = parseFloat(el.getAttribute('data-reveal-distance') || '24');

        let initialVars = { autoAlpha: 0 };
        if (direction === 'up') initialVars.y = distance;
        else if (direction === 'down') initialVars.y = -distance;
        else if (direction === 'left') initialVars.x = distance;
        else if (direction === 'right') initialVars.x = -distance;

        gsap.fromTo(
            el,
            initialVars,
            {
                x: 0,
                y: 0,
                autoAlpha: 1,
                duration: 0.75,
                delay,
                ease: 'power3.out',
                force3D: true,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    end: 'bottom top',
                    toggleActions: once ? 'play none none none' : 'play reverse play reverse',
                },
            }
        );
    });

    // 2. Staggered Group Reveal
    const staggerGroups = document.querySelectorAll('[data-reveal-stagger]');
    staggerGroups.forEach((group) => {
        const once = group.getAttribute('data-reveal-once') === 'true';
        const delay = parseFloat(group.getAttribute('data-reveal-delay') || '0');
        const stagger = parseFloat(group.getAttribute('data-reveal-stagger-delay') || '0.08');
        const distance = parseFloat(group.getAttribute('data-reveal-distance') || '24');

        let children = group.querySelectorAll(':scope > [data-reveal-item]');
        if (!children.length) {
            children = group.querySelectorAll('[data-reveal-item]');
        }
        if (!children.length) {
            children = Array.from(group.children);
        }
        if (!children.length) return;

        gsap.fromTo(
            children,
            { y: distance, autoAlpha: 0 },
            {
                y: 0,
                autoAlpha: 1,
                duration: 0.65,
                delay,
                stagger,
                ease: 'power3.out',
                force3D: true,
                scrollTrigger: {
                    trigger: group,
                    start: 'top 86%',
                    end: 'bottom top',
                    toggleActions: once ? 'play none none none' : 'play reverse play reverse',
                },
            }
        );
    });

    window.__skensaRefreshReveal = () => {
        ScrollTrigger.refresh();
    };
}

