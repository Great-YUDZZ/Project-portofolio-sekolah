import { initSmoothScroll } from './public/smooth-scroll';
import { initIntro } from './public/intro';
import { initHeroSection } from './public/sections/hero';
import { initMajorsHorizontal } from './public/sections/majors-horizontal';
import { initCounters } from './public/sections/counters';
import { initReveal } from './public/sections/reveal';
import { initParallaxGallery } from './public/sections/parallax-gallery';
import { initMarkers } from './public/sections/marker';

function initNavbarAndDrawers() {
    const megaToggle = document.getElementById('mega-menu-toggle');
    const megaClose = document.getElementById('mega-menu-close');
    const megaBackdrop = document.getElementById('mega-menu-backdrop');
    const megaDrawer = document.getElementById('mega-menu-drawer');

    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu-panel');

    const openMega = () => {
        if (!megaDrawer) return;
        megaDrawer.classList.remove('hidden');
        requestAnimationFrame(() => {
            megaDrawer.classList.remove('opacity-0', 'translate-y-2');
            megaDrawer.classList.add('opacity-100', 'translate-y-0');
        });
        megaToggle?.setAttribute('aria-expanded', 'true');
    };

    const closeMega = () => {
        if (!megaDrawer) return;
        megaDrawer.classList.remove('opacity-100', 'translate-y-0');
        megaDrawer.classList.add('opacity-0', 'translate-y-2');
        megaToggle?.setAttribute('aria-expanded', 'false');
        setTimeout(() => {
            megaDrawer.classList.add('hidden');
        }, 200);
    };

    megaToggle?.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = megaDrawer?.classList.contains('hidden');
        if (isHidden) openMega();
        else closeMega();
    });

    megaClose?.addEventListener('click', closeMega);
    megaBackdrop?.addEventListener('click', closeMega);

    mobileToggle?.addEventListener('click', () => {
        if (!mobileMenu) return;
        mobileMenu.classList.toggle('hidden');
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMega();
            mobileMenu?.classList.add('hidden');
            closeLightbox();
        }
    });

    // Global Toast Close
    document.querySelectorAll('[data-toast-close]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const toast = btn.closest('[data-toast]');
            toast?.remove();
        });
    });

    // Auto-dismiss toast after 5 seconds
    const activeToast = document.querySelector('[data-toast]');
    if (activeToast) {
        setTimeout(() => {
            activeToast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => activeToast.remove(), 300);
        }, 5000);
    }

    // Lightbox for Gallery & Student Works
    const lightbox = document.getElementById('skensa-lightbox');
    const lightboxImg = document.getElementById('skensa-lightbox-img');
    const lightboxTitle = document.getElementById('skensa-lightbox-title');
    const lightboxDesc = document.getElementById('skensa-lightbox-desc');
    const lightboxClose = document.getElementById('skensa-lightbox-close');

    function closeLightbox() {
        if (!lightbox) return;
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
    }

    document.querySelectorAll('[data-lightbox-src]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            if (!lightbox || !lightboxImg) return;
            const src = trigger.getAttribute('data-lightbox-src') || '';
            const title = trigger.getAttribute('data-lightbox-title') || '';
            const desc = trigger.getAttribute('data-lightbox-desc') || '';

            lightboxImg.src = src;
            lightboxImg.alt = title;
            if (lightboxTitle) lightboxTitle.textContent = title;
            if (lightboxDesc) lightboxDesc.textContent = desc;

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
        });
    });

    lightboxClose?.addEventListener('click', closeLightbox);
    lightbox?.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initSmoothScroll();
    initNavbarAndDrawers();
    initMarkers();
    initCounters();
    initReveal();
    initParallaxGallery();
    initMajorsHorizontal();

    initIntro();
    initHeroSection();
});
