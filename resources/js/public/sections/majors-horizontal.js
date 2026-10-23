import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initMajorsHorizontal() {
    const pinWrap = document.querySelector('[data-majors-pin]');
    const track = document.querySelector('[data-majors-track]');
    const progressFill = document.querySelector('[data-majors-progress]');
    const counterCurrent = document.querySelector('[data-majors-current]');

    if (!pinWrap || !track || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const mm = gsap.matchMedia();

    mm.add('(min-width: 1024px)', () => {
        const cards = gsap.utils.toArray('[data-major-card]', track);
        const getScrollDistance = () => Math.max(0, track.scrollWidth - pinWrap.clientWidth + 64);

        const scrollTween = gsap.to(track, {
            x: () => -getScrollDistance(),
            ease: 'none',
            scrollTrigger: {
                trigger: pinWrap,
                pin: true,
                scrub: 0.8,
                start: 'top top',
                end: () => `+=${getScrollDistance()}`,
                invalidateOnRefresh: true,
                onUpdate: (self) => {
                    if (progressFill) {
                        gsap.set(progressFill, { scaleX: self.progress });
                    }
                    if (counterCurrent && cards.length > 0) {
                        const idx = Math.min(
                            cards.length,
                            Math.max(1, Math.round(self.progress * (cards.length - 1)) + 1)
                        );
                        counterCurrent.textContent = String(idx).padStart(2, '0');
                    }
                },
            },
        });

        return () => {
            scrollTween.kill();
        };
    });
}
