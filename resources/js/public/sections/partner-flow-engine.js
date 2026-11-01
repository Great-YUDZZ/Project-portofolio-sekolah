import gsap from 'gsap';

export function initPartnerFlowColumns() {
    const container = document.getElementById('partner-cards-container');
    const stage = document.getElementById('partner-flow-stage');
    if (!container || !stage) return;

    const columns = Array.from(container.querySelectorAll('.partner-flow-column'));
    if (!columns.length) return;

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

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Helper: Open Modal with details
    const openDetail = (btn) => {
        const name = btn.getAttribute('data-partner-name');
        const logo = btn.getAttribute('data-partner-logo');
        const jurusan = btn.getAttribute('data-partner-jurusan');
        const bentuk = btn.getAttribute('data-partner-bentuk');
        const detail = btn.getAttribute('data-partner-detail');
        const slug = btn.getAttribute('data-partner-slug');

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

    // Setup Flow Columns State
    const flowCols = columns.map((col) => {
        const cards = Array.from(col.querySelectorAll('.partner-flow-card'));
        const state = {
            el: col,
            cards,
            speed: parseFloat(col.dataset.speed) || 30, // px per second
            depth: parseFloat(col.dataset.depth) || 20, // mouse parallax strength
            offset: parseFloat(col.dataset.offset) || 0, // initial phase 0..1
            progress: null,
            factor: 1, // smoothed speed multiplier (1 = flowing, 0 = paused)
            hovered: false,
            loopH: 0,
            spacing: 0,
            setX: gsap.quickSetter(col, 'x', 'px'),
            setCardY: cards.map((c) => gsap.quickSetter(c, 'y', 'px')),
            setCardOpacity: cards.map((c) => gsap.quickSetter(c, 'opacity')),
        };

        const pause = () => { state.hovered = true; };
        const resume = () => { state.hovered = false; };

        cards.forEach((card) => {
            card.addEventListener('pointerenter', pause);
            card.addEventListener('pointerleave', resume);
            card.addEventListener('focusin', pause);
            card.addEventListener('focusout', resume);

            const btn = card.querySelector('[data-partner-btn]');
            if (btn) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    openDetail(btn);
                });
            }
        });

        return state;
    });

    let stageH = stage.clientHeight || 780;
    const measure = () => {
        stageH = stage.clientHeight || 780;
        flowCols.forEach((c) => {
            if (!c.cards.length) return;
            const cardH = c.cards[0].offsetHeight || 72;
            c.loopH = Math.max(stageH + cardH, c.cards.length * (cardH + 48));
            c.spacing = c.loopH / c.cards.length;
            if (c.progress === null) {
                c.progress = c.offset * c.loopH;
            }
        });
    };

    measure();
    window.addEventListener('resize', measure);

    // Mouse parallax horizontal tilt
    let targetMX = 0;
    let currentMX = 0;

    stage.addEventListener('pointermove', (e) => {
        if (e.pointerType !== 'mouse' || reduceMotion) return;
        const rect = stage.getBoundingClientRect();
        targetMX = gsap.utils.clamp(-1, 1, (e.clientX - (rect.left + rect.width / 2)) / (rect.width / 2));
    }, { passive: true });

    stage.addEventListener('pointerleave', () => {
        targetMX = 0;
    });

    // Render loop via GSAP ticker
    let lastTime = gsap.ticker.time;
    const render = () => {
        const now = gsap.ticker.time;
        const dt = Math.min(now - lastTime, 0.1);
        lastTime = now;

        currentMX += (targetMX - currentMX) * Math.min(1, dt * 4.5);

        const fadeZone = Math.max(120, stageH * 0.22); // 22% top & bottom fade zone

        flowCols.forEach((c) => {
            if (!c.loopH) return;

            // Parallax X offset
            c.setX(currentMX * c.depth);

            // Factor lerp to pause smoothly on hover
            const targetFactor = (c.hovered || reduceMotion) ? 0 : 1;
            c.factor += (targetFactor - c.factor) * Math.min(1, dt * 6.5);

            // Progress upward
            c.progress += c.speed * c.factor * dt;

            // Update card Y positions & coordinate-based opacity (fade in on enter, fade out on exit)
            const numCards = c.cards.length;
            for (let i = 0; i < numCards; i++) {
                let y = (i * c.spacing - c.progress) % c.loopH;
                if (y < 0) y += c.loopH;
                c.setCardY[i](y);

                let opacity = 1;
                if (y < fadeZone) {
                    opacity = Math.max(0, Math.min(1, y / fadeZone));
                } else if (y > stageH - fadeZone) {
                    opacity = Math.max(0, Math.min(1, (stageH - y) / fadeZone));
                }
                c.setCardOpacity[i](opacity);
            }
        });
    };

    gsap.ticker.add(render);
}
