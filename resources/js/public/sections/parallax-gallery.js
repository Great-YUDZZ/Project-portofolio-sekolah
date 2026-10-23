import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initParallaxGallery() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const parallaxItems = document.querySelectorAll('[data-parallax]');
    parallaxItems.forEach((el) => {
        const speed = parseFloat(el.getAttribute('data-parallax') || '0.15');
        gsap.to(el, {
            yPercent: speed * 100,
            ease: 'none',
            scrollTrigger: {
                trigger: el.closest('[data-parallax-wrap]') || el,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            },
        });
    });
}
