import gsap from 'gsap';
import { Draggable } from 'gsap/Draggable.js';

gsap.registerPlugin(Draggable);

export function initFloatingPartners() {
    const stage = document.getElementById('partner-floating-stage');
    if (!stage) return;

    const badges = stage.querySelectorAll('[data-partner-badge]');
    const resetBtn = document.getElementById('partner-stage-reset');
    const toggleMotionBtn = document.getElementById('partner-stage-toggle-motion');
    const motionStatusText = document.getElementById('partner-motion-status');
    const filterBtns = document.querySelectorAll('[data-partner-filter]');

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

    let stageWidth = stage.clientWidth;
    let stageHeight = stage.clientHeight;
    let isMotionActive = true;
    let activeFilter = 'all';

    // Check system prefers-reduced-motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        isMotionActive = false;
        if (motionStatusText) motionStatusText.textContent = 'Jeda';
    }

    const badgeStates = [];

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

    // Window resize handler to maintain stage bounds
    const handleResize = () => {
        stageWidth = stage.clientWidth;
        stageHeight = stage.clientHeight;
        badgeStates.forEach((state) => {
            state.width = state.badge.offsetWidth;
            state.height = state.badge.offsetHeight;
            state.maxX = Math.max(0, stageWidth - state.width);
            state.maxY = Math.max(0, stageHeight - state.height);
            state.x = Math.max(0, Math.min(state.maxX, state.x));
            state.y = Math.max(0, Math.min(state.maxY, state.y));
            gsap.set(state.badge, { x: state.x, y: state.y });
            state.draggable?.update();
        });
    };
    window.addEventListener('resize', handleResize);

    // Initialize badges positions & physics
    badges.forEach((badge, index) => {
        const width = badge.offsetWidth || 140;
        const height = badge.offsetHeight || 80;

        // Parse initial left and top styles
        const initialLeft = badge.style.left;
        const initialTop = badge.style.top;
        let startX = 0;
        let startY = 0;

        if (initialLeft.includes('%')) {
            startX = (parseFloat(initialLeft) / 100) * stageWidth;
        } else {
            startX = parseFloat(initialLeft) || 20 + (index % 4) * 220;
        }

        if (initialTop.includes('%')) {
            startY = (parseFloat(initialTop) / 100) * stageHeight;
        } else {
            startY = parseFloat(initialTop) || 20 + Math.floor(index / 4) * 110;
        }

        // Clamp inside bounds
        const maxX = Math.max(0, stageWidth - width);
        const maxY = Math.max(0, stageHeight - height);
        startX = Math.max(0, Math.min(maxX, startX));
        startY = Math.max(0, Math.min(maxY, startY));

        // Reset style left & top to 0 and apply transform
        badge.style.left = '0px';
        badge.style.top = '0px';
        gsap.set(badge, { x: startX, y: startY });

        // Random subtle drift velocity (-0.35 to 0.35 px per frame)
        let vx = (Math.random() - 0.5) * 0.7;
        let vy = (Math.random() - 0.5) * 0.7;
        if (Math.abs(vx) < 0.2) vx = vx < 0 ? -0.28 : 0.28;
        if (Math.abs(vy) < 0.2) vy = vy < 0 ? -0.28 : 0.28;

        const category = badge.getAttribute('data-partner-category') || 'all';

        const state = {
            badge,
            index,
            category,
            x: startX,
            y: startY,
            initialX: startX,
            initialY: startY,
            vx,
            vy,
            width,
            height,
            maxX,
            maxY,
            isDragging: false,
            isHovered: false,
            isFilteredOut: false,
            lastX: startX,
            lastY: startY,
            phaseX: Math.random() * Math.PI * 2,
            phaseY: Math.random() * Math.PI * 2,
            draggable: null,
        };

        // Create GSAP Draggable with throwing support
        let lastTap = 0;
        const d = Draggable.create(badge, {
            bounds: stage,
            edgeResistance: 0.85,
            type: 'x,y',
            cursor: 'grab',
            activeCursor: 'grabbing',
            onPress() {
                state.isDragging = true;
                badge.classList.add('is-dragging');
                state.lastX = this.x;
                state.lastY = this.y;
            },
            onDrag() {
                state.x = this.x;
                state.y = this.y;
            },
            onRelease() {
                state.isDragging = false;
                badge.classList.remove('is-dragging');
                state.x = this.x;
                state.y = this.y;

                // Transfer throw velocity to drift physics
                const dragVx = this.x - state.lastX;
                const dragVy = this.y - state.lastY;
                if (Math.hypot(dragVx, dragVy) > 1.5) {
                    state.vx = Math.max(-2.5, Math.min(2.5, dragVx * 0.45));
                    state.vy = Math.max(-2.5, Math.min(2.5, dragVy * 0.45));
                }
            },
        })[0];

        state.draggable = d;

        // Hover events for smooth hover deceleration
        badge.addEventListener('mouseenter', () => {
            state.isHovered = true;
        });
        badge.addEventListener('mouseleave', () => {
            state.isHovered = false;
        });

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

        badgeStates.push(state);
    });

    // Continuous Autonomous Physics Simulation Loop
    let tickCount = 0;
    const updatePhysics = () => {
        if (!isMotionActive) return;
        tickCount++;

        // Gentle badge-to-badge soft repulsion so they glide smoothly without bunching
        for (let i = 0; i < badgeStates.length; i++) {
            const a = badgeStates[i];
            if (a.isDragging || a.isFilteredOut) continue;
            for (let j = i + 1; j < badgeStates.length; j++) {
                const b = badgeStates[j];
                if (b.isDragging || b.isFilteredOut) continue;

                const centerAX = a.x + a.width / 2;
                const centerAY = a.y + a.height / 2;
                const centerBX = b.x + b.width / 2;
                const centerBY = b.y + b.height / 2;

                const dx = centerBX - centerAX;
                const dy = centerBY - centerAY;
                const dist = Math.hypot(dx, dy);
                const minDist = (a.width + b.width) * 0.48;

                if (dist < minDist && dist > 0.1) {
                    const overlap = (minDist - dist) / minDist;
                    const force = overlap * 0.09;
                    const pushX = (dx / dist) * force;
                    const pushY = (dy / dist) * force;

                    if (!a.isHovered) {
                        a.vx -= pushX;
                        a.vy -= pushY;
                    }
                    if (!b.isHovered) {
                        b.vx += pushX;
                        b.vy += pushY;
                    }
                }
            }
        }

        badgeStates.forEach((state) => {
            if (state.isDragging || state.isFilteredOut) return;

            if (state.isHovered) {
                // Smooth deceleration when hovered
                state.vx *= 0.85;
                state.vy *= 0.85;
            } else {
                // Decay excessive toss velocity back to normal cruise speed
                if (Math.abs(state.vx) > 0.6) state.vx *= 0.985;
                if (Math.abs(state.vy) > 0.6) state.vy *= 0.985;

                // Subtle sinusoidal wandering force for organic motion
                const wanderX = Math.sin(tickCount * 0.015 + state.phaseX) * 0.018;
                const wanderY = Math.cos(tickCount * 0.015 + state.phaseY) * 0.018;
                state.vx += wanderX;
                state.vy += wanderY;

                // Ensure minimum baseline speed so badges never freeze
                const currentSpeed = Math.hypot(state.vx, state.vy);
                if (currentSpeed < 0.22) {
                    state.vx *= 1.04;
                    state.vy *= 1.04;
                } else if (currentSpeed > 2.0) {
                    state.vx *= 0.95;
                    state.vy *= 0.95;
                }
            }

            // Update positions
            state.x += state.vx;
            state.y += state.vy;

            // Soft wall boundary deflection
            if (state.x <= 0) {
                state.x = 0;
                state.vx = Math.abs(state.vx) * 0.92;
            } else if (state.x >= state.maxX) {
                state.x = state.maxX;
                state.vx = -Math.abs(state.vx) * 0.92;
            }

            if (state.y <= 0) {
                state.y = 0;
                state.vy = Math.abs(state.vy) * 0.92;
            } else if (state.y >= state.maxY) {
                state.y = state.maxY;
                state.vy = -Math.abs(state.vy) * 0.92;
            }

            // Apply to DOM
            gsap.set(state.badge, { x: state.x, y: state.y });
            state.draggable?.update();
        });
    };

    gsap.ticker.add(updatePhysics);

    // Toggle Motion Pause/Play
    toggleMotionBtn?.addEventListener('click', () => {
        isMotionActive = !isMotionActive;
        if (motionStatusText) {
            motionStatusText.textContent = isMotionActive ? 'Gerak' : 'Jeda';
        }
        toggleMotionBtn.setAttribute('aria-pressed', isMotionActive ? 'true' : 'false');
    });

    // Reset button: springs all badges back to initial coordinates
    resetBtn?.addEventListener('click', () => {
        badgeStates.forEach((state) => {
            gsap.to(state.badge, {
                x: state.initialX,
                y: state.initialY,
                duration: 0.75,
                ease: 'elastic.out(1, 0.45)',
                onUpdate() {
                    state.x = gsap.getProperty(state.badge, 'x');
                    state.y = gsap.getProperty(state.badge, 'y');
                    state.draggable?.update();
                },
                onComplete() {
                    state.x = state.initialX;
                    state.y = state.initialY;
                    state.vx = (Math.random() - 0.5) * 0.6;
                    state.vy = (Math.random() - 0.5) * 0.6;
                    state.draggable?.update();
                },
            });
        });
    });

    // Category Filter Pills
    filterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-partner-filter');
            activeFilter = filter;

            filterBtns.forEach((b) => {
                const isActive = b.getAttribute('data-partner-filter') === filter;
                if (isActive) {
                    b.classList.add('bg-ink', 'text-white', 'border-ink');
                    b.classList.remove('bg-paper', 'text-ink', 'border-line');
                } else {
                    b.classList.remove('bg-ink', 'text-white', 'border-ink');
                    b.classList.add('bg-paper', 'text-ink', 'border-line');
                }
            });

            badgeStates.forEach((state) => {
                const isMatch = filter === 'all' || state.category === filter;
                state.isFilteredOut = !isMatch;

                if (isMatch) {
                    gsap.to(state.badge, {
                        opacity: 1,
                        scale: 1,
                        duration: 0.35,
                        ease: 'power2.out',
                        overwrite: 'auto',
                    });
                    state.badge.style.pointerEvents = 'auto';
                } else {
                    gsap.to(state.badge, {
                        opacity: 0.15,
                        scale: 0.82,
                        duration: 0.35,
                        ease: 'power2.out',
                        overwrite: 'auto',
                    });
                    state.badge.style.pointerEvents = 'none';
                }
            });
        });
    });
}
