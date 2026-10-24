import gsap from 'gsap';
import { initSmoothScroll } from './public/smooth-scroll';
import { initIntro } from './public/intro';
import { initHeroSection } from './public/sections/hero';
import { initInteractivePhysics } from './public/sections/interactive-physics';
import { initMajorsHorizontal } from './public/sections/majors-horizontal';
import { initCounters } from './public/sections/counters';
import { initReveal } from './public/sections/reveal';
import { initParallaxGallery } from './public/sections/parallax-gallery';
import { initMarkers } from './public/sections/marker';

function initNavbarAndDrawers() {
    const megaToggle = document.getElementById('mega-menu-toggle');
    const megaClose = document.getElementById('mega-menu-close');
    const megaDrawer = document.getElementById('mega-menu-drawer');

    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu-panel');

    const searchTrigger = document.getElementById('search-modal-trigger');
    const searchModal = document.getElementById('search-command-modal');
    const searchClose = document.getElementById('search-modal-close');
    const searchInput = document.getElementById('global-search-input');

    // Two-Column Academic Mega-Menu Field Switcher
    const megaFieldBtns = document.querySelectorAll('[data-mega-field-btn]');
    const megaFieldPanels = document.querySelectorAll('[data-mega-field-panel]');

    const activateMegaField = (fieldId) => {
        megaFieldBtns.forEach((btn) => {
            const isMatch = btn.getAttribute('data-mega-field-btn') === fieldId;
            const badge = btn.querySelector('[data-mega-badge]');
            if (isMatch) {
                btn.classList.add('bg-navy', 'text-paper', 'font-bold');
                btn.classList.remove('text-ink', 'hover:bg-paper-2', 'font-semibold');
                if (badge) {
                    badge.classList.add('bg-yellow-skensa', 'text-ink');
                    badge.classList.remove('bg-paper-2', 'text-ink-muted');
                }
            } else {
                btn.classList.remove('bg-navy', 'text-paper', 'font-bold');
                btn.classList.add('text-ink', 'hover:bg-paper-2', 'font-semibold');
                if (badge) {
                    badge.classList.remove('bg-yellow-skensa', 'text-ink');
                    badge.classList.add('bg-paper-2', 'text-ink-muted');
                }
            }
        });

        megaFieldPanels.forEach((panel) => {
            const isMatch = panel.getAttribute('data-mega-field-panel') === fieldId;
            if (isMatch) {
                panel.classList.remove('hidden');
                panel.classList.add('block');
                gsap.fromTo(
                    panel,
                    { opacity: 0, y: 6 },
                    { opacity: 1, y: 0, duration: 0.22, ease: 'power2.out', overwrite: true }
                );
            } else {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            }
        });
    };

    megaFieldBtns.forEach((btn) => {
        const fieldId = btn.getAttribute('data-mega-field-btn');
        btn.addEventListener('mouseenter', () => activateMegaField(fieldId));
        btn.addEventListener('focus', () => activateMegaField(fieldId));
        btn.addEventListener('click', () => activateMegaField(fieldId));
    });

    const closeMega = () => {
        if (!megaDrawer) return;
        megaDrawer.classList.remove('opacity-100', 'translate-y-0', 'visible');
        megaDrawer.classList.add('opacity-0', 'translate-y-2', 'invisible');
        megaToggle?.setAttribute('aria-expanded', 'false');
    };

    const openSearchModal = () => {
        if (!searchModal) return;
        closeMega();
        searchModal.classList.remove('hidden');
        searchModal.classList.add('flex');
        setTimeout(() => {
            searchInput?.focus();
        }, 50);
    };

    const closeSearchModal = () => {
        if (!searchModal) return;
        searchModal.classList.add('hidden');
        searchModal.classList.remove('flex');
    };

    megaClose?.addEventListener('click', (e) => {
        e.stopPropagation();
        closeMega();
    });

    searchTrigger?.addEventListener('click', openSearchModal);
    searchClose?.addEventListener('click', closeSearchModal);
    searchModal?.addEventListener('click', (e) => {
        if (e.target === searchModal) closeSearchModal();
    });

    mobileToggle?.addEventListener('click', () => {
        if (!mobileMenu) return;
        mobileMenu.classList.toggle('hidden');
    });

    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            const isSearchOpen = searchModal && !searchModal.classList.contains('hidden');
            if (isSearchOpen) closeSearchModal();
            else openSearchModal();
        }

        if (e.key === 'Escape') {
            closeMega();
            closeSearchModal();
            mobileMenu?.classList.add('hidden');
        }
    });

    // Global Toast Close
    document.querySelectorAll('[data-toast-close]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const toast = btn.closest('[data-toast]');
            toast?.remove();
        });
    });

    const activeToast = document.querySelector('[data-toast]');
    if (activeToast) {
        setTimeout(() => {
            activeToast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => activeToast.remove(), 300);
        }, 5000);
    }
}

function initFacultyExplorer() {
    const filterBtns = document.querySelectorAll('[data-faculty-filter]');
    const cards = document.querySelectorAll('[data-faculty-card]');
    const activeCountEl = document.getElementById('faculty-active-count');

    if (!filterBtns.length || !cards.length) return;

    filterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const targetField = btn.getAttribute('data-faculty-filter');

            // Update button active styles
            filterBtns.forEach((b) => {
                const isSelected = b === btn;
                const badge = b.querySelector('[data-filter-badge]');
                const num = b.querySelector('[data-filter-num]');
                if (isSelected) {
                    b.classList.add('bg-navy', 'text-paper', 'font-bold');
                    b.classList.remove('text-ink', 'hover:bg-paper-2', 'font-semibold');
                    if (badge) {
                        badge.classList.add('bg-yellow-skensa', 'text-ink', 'border-yellow-skensa');
                        badge.classList.remove('bg-paper-2', 'text-ink-muted', 'border-line');
                    }
                    if (num) {
                        num.classList.add('text-yellow-skensa');
                        num.classList.remove('text-ink-muted');
                    }
                } else {
                    b.classList.remove('bg-navy', 'text-paper', 'font-bold');
                    b.classList.add('text-ink', 'hover:bg-paper-2', 'font-semibold');
                    if (badge) {
                        badge.classList.remove('bg-yellow-skensa', 'text-ink', 'border-yellow-skensa');
                        badge.classList.add('bg-paper-2', 'text-ink-muted', 'border-line');
                    }
                    if (num) {
                        num.classList.remove('text-yellow-skensa');
                        num.classList.add('text-ink-muted');
                    }
                }
            });

            // Filter cards and animate visible ones with GSAP
            const visibleCards = [];
            cards.forEach((card) => {
                const cardField = card.getAttribute('data-field-id');
                const shouldShow = targetField === 'all' || cardField === targetField;
                if (shouldShow) {
                    card.classList.remove('hidden');
                    visibleCards.push(card);
                } else {
                    card.classList.add('hidden');
                }
            });

            if (activeCountEl) {
                activeCountEl.textContent = String(visibleCards.length);
            }

            if (visibleCards.length) {
                gsap.fromTo(
                    visibleCards,
                    { opacity: 0, y: 18, scale: 0.98 },
                    {
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        duration: 0.35,
                        stagger: 0.05,
                        ease: 'power2.out',
                        overwrite: true,
                    }
                );
            }
        });
    });
}

function initAutoHideNavbar() {
    const navbar = document.getElementById('site-navbar');
    if (!navbar) return;

    let lastScrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    let isHidden = false;
    let isHoveringNavbar = false;
    let isMouseNearTop = false;
    const scrollThreshold = 10;
    const topZone = 80;

    const showNavbar = () => {
        if (!isHidden) return;
        navbar.classList.remove('-translate-y-full');
        navbar.classList.add('translate-y-0');
        isHidden = false;
    };

    const hideNavbar = () => {
        const currentY = window.pageYOffset || document.documentElement.scrollTop || 0;
        if (currentY <= 70) return;
        if (isHoveringNavbar || isMouseNearTop) return;

        const mobileMenu = document.getElementById('mobile-menu-panel');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) return;

        const searchModal = document.getElementById('search-command-modal');
        if (searchModal && !searchModal.classList.contains('hidden')) return;

        if (isHidden) return;
        navbar.classList.remove('translate-y-0');
        navbar.classList.add('-translate-y-full');
        isHidden = true;
    };

    const handleScrollUpdate = (currentY) => {
        const delta = currentY - lastScrollY;

        if (currentY <= 70) {
            showNavbar();
        } else if (delta > scrollThreshold) {
            hideNavbar();
        } else if (delta < -scrollThreshold) {
            showNavbar();
        }

        lastScrollY = Math.max(0, currentY);
    };

    window.addEventListener('scroll', () => {
        const currentY = window.pageYOffset || document.documentElement.scrollTop || 0;
        handleScrollUpdate(currentY);
    }, { passive: true });

    if (window.__skensaLenis) {
        window.__skensaLenis.on('scroll', (e) => {
            handleScrollUpdate(e.scroll);
        });
    }

    window.addEventListener('mousemove', (e) => {
        if (e.clientY <= topZone) {
            isMouseNearTop = true;
            showNavbar();
        } else {
            isMouseNearTop = false;
        }
    }, { passive: true });

    navbar.addEventListener('mouseenter', () => {
        isHoveringNavbar = true;
        showNavbar();
    });

    navbar.addEventListener('mouseleave', () => {
        isHoveringNavbar = false;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initSmoothScroll();
    initNavbarAndDrawers();
    initAutoHideNavbar();
    initFacultyExplorer();
    initMarkers();
    initCounters();
    initReveal();
    initParallaxGallery();
    initMajorsHorizontal();

    initIntro();
    initHeroSection();
    initInteractivePhysics();
});
