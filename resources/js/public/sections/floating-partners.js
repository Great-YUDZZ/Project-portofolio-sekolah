import gsap from 'gsap';
import { Draggable } from 'gsap/Draggable.js';

gsap.registerPlugin(Draggable);

export function initFloatingPartners() {
    const stage = document.getElementById('partner-floating-stage');
    if (!stage) return;

    const badges = stage.querySelectorAll('[data-partner-badge]');
    const resetBtn = document.getElementById('partner-stage-reset');
    const modal = document.getElementById('partner-detail-modal');
    const modalClose = document.getElementById('partner-modal-close');
    const modalBackdrop = document.getElementById('partner-modal-backdrop');

    // Modal data fields
    const modalLogo = document.getElementById('partner-modal-logo');
    const modalName = document.getElementById('partner-modal-name');
    const modalJurusan = document.getElementById('partner-modal-jurusan');
    const modalBentuk = document.getElementById('partner-modal-bentuk');
    const modalDetail = document.getElementById('partner-modal-detail');
    const modalLink = document.getElementById('partner-modal-link');

    const draggables = [];

    // Helper: Open Modal with details
    const openDetail = (badge) => {
        const name = badge.getAttribute('data-partner-name');
        const logo = badge.getAttribute('data-partner-logo');
        const jurusan = badge.getAttribute('data-partner-jurusan');
        const bentuk = badge.getAttribute('data-partner-bentuk');
        const detail = badge.getAttribute('data-partner-detail');
        const slug = badge.getAttribute('data-partner-slug');

        if (modalLogo) modalLogo.src = logo;
        if (modalName) modalName.textContent = name;
        if (modalJurusan) modalJurusan.textContent = jurusan;
        if (modalBentuk) modalBentuk.textContent = bentuk;
        if (modalDetail) modalDetail.textContent = detail;
        if (modalLink) {
            modalLink.href = `/jurusan/${slug}`;
            modalLink.textContent = `Lihat Konsentrasi Keahlian: ${jurusan} \u2192`;
        }

        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            const card = modal.querySelector('[data-modal-card]');
            if (card) {
                gsap.fromTo(
                    card,
                    { scale: 0.9, opacity: 0, y: 15 },
                    { scale: 1, opacity: 1, y: 0, duration: 0.28, ease: 'back.out(1.5)', overwrite: true }
                );
            }
        }
    };

    // Helper: Close Modal
    const closeModal = () => {
        if (!modal || modal.classList.contains('hidden')) return;
        const card = modal.querySelector('[data-modal-card]');
        if (card) {
            gsap.to(card, {
                scale: 0.95,
                opacity: 0,
                y: 10,
                duration: 0.18,
                ease: 'power2.in',
                onComplete() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                },
            });
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    };

    modalClose?.addEventListener('click', closeModal);
    modalBackdrop?.addEventListener('click', closeModal);
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });

    // Initialize Draggable on each floating badge
    badges.forEach((badge) => {
        let lastTap = 0;

        const d = Draggable.create(badge, {
            bounds: stage,
            edgeResistance: 0.8,
            type: 'x,y',
            cursor: 'grab',
            activeCursor: 'grabbing',
            onPress() {
                badge.classList.add('is-dragging');
            },
            onRelease() {
                badge.classList.remove('is-dragging');
            },
        })[0];

        draggables.push(d);

        // Desktop Double Click
        badge.addEventListener('dblclick', (e) => {
            e.stopPropagation();
            openDetail(badge);
        });

        // Mobile Touch Double Tap
        badge.addEventListener('touchend', (e) => {
            const currentTime = new Date().getTime();
            const tapLength = currentTime - lastTap;
            if (tapLength < 350 && tapLength > 0) {
                e.preventDefault();
                openDetail(badge);
            }
            lastTap = currentTime;
        });
    });

    // Reset button animation
    resetBtn?.addEventListener('click', () => {
        badges.forEach((badge) => {
            gsap.to(badge, {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: 'elastic.out(1, 0.45)',
                onComplete() {
                    draggables.forEach((d) => d?.update());
                },
            });
        });
    });
}
