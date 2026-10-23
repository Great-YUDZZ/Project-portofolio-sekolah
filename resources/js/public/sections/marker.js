import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initMarkers() {
    const markers = document.querySelectorAll('.marker-highlight');
    if (!markers.length) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        markers.forEach((m) => m.classList.add('is-marked'));
        return;
    }

    markers.forEach((marker) => {
        ScrollTrigger.create({
            trigger: marker,
            start: 'top 86%',
            once: true,
            onEnter: () => {
                marker.classList.add('is-marked');
            },
        });
    });
}
