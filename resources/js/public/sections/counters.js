import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    counters.forEach((el) => {
        const targetValue = parseInt(el.getAttribute('data-counter') || '0', 10);
        const suffix = el.getAttribute('data-suffix') || '';

        if (prefersReducedMotion) {
            el.textContent = targetValue.toLocaleString('id-ID') + suffix;
            return;
        }

        const state = { val: 0 };

        ScrollTrigger.create({
            trigger: el,
            start: 'top 88%',
            once: true,
            onEnter: () => {
                gsap.to(state, {
                    val: targetValue,
                    duration: 1.8,
                    ease: 'power3.out',
                    onUpdate: () => {
                        el.textContent = Math.round(state.val).toLocaleString('id-ID') + suffix;
                    },
                });
            },
        });
    });
}
