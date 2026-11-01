/* ============================================================================
   scrollcraft-history.js
   Scroll-Craft Interactive Runtime + Bespoke Signature Moves for /sejarah
   ========================================================================== */

const clamp = (x, a, b) => (x < a ? a : x > b ? b : x);
const clamp01 = (x) => clamp(x, 0, 1);
const smooth = (x) => {
    const t = clamp01(x);
    return t * t * (3 - 2 * t);
};
const lerp = (a, b, t) => a + (b - a) * t;

export function initScrollCraftHistory() {
    const root = document.getElementById('skensa-history-scrollcraft');
    if (!root) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const isSmallScreen = () => window.matchMedia('(max-width: 860px)').matches;

    root.classList.add('sc-ready');

    // 1. Setup Flow Reveal (data-sc-in & data-sc-stagger)
    const inElements = root.querySelectorAll('[data-sc-in], [data-sc-stagger]');
    if (reduceMotion) {
        inElements.forEach((el) => {
            el.classList.add('sc-in');
            Array.from(el.children).forEach((child) => child.classList.add('sc-in'));
        });
    } else if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const el = entry.target;
                    el.classList.add('sc-in');
                    const staggerMs = parseFloat(el.getAttribute('data-sc-stagger')) || 0;
                    if (staggerMs > 0) {
                        Array.from(el.children).forEach((child, idx) => {
                            setTimeout(() => {
                                child.classList.add('sc-in');
                            }, idx * staggerMs);
                        });
                    }
                    io.unobserve(el);
                });
            },
            { rootMargin: '0px 0px -10% 0px', threshold: 0.1 }
        );
        inElements.forEach((el) => io.observe(el));
    }

    // 2. Setup Number Counters (data-sc-count)
    const countElements = root.querySelectorAll('[data-sc-count]');
    const formatCount = (val, decimals, useSep) => {
        const fixed = val.toFixed(decimals);
        if (!useSep) return fixed;
        const parts = fixed.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return parts.join(',');
    };

    if ('IntersectionObserver' in window) {
        const countObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const el = entry.target;
                    countObserver.unobserve(el);

                    const raw = (el.getAttribute('data-sc-count') || '0 0').trim().split(/\s+/);
                    const startStr = raw[0] || '0';
                    const endStr = raw[1] || raw[0] || '0';
                    const useSep = endStr.includes(',') || endStr.includes('.');
                    const startVal = parseFloat(startStr.replace(/[,.]/g, '')) || 0;
                    const endVal = parseFloat(endStr.replace(/[,.]/g, '')) || 0;
                    const durMs = parseFloat(el.getAttribute('data-sc-count-ms')) || 1400;

                    if (reduceMotion) {
                        el.textContent = formatCount(endVal, 0, useSep);
                        return;
                    }

                    const t0 = performance.now();
                    const tick = (now) => {
                        const u = clamp01((now - t0) / durMs);
                        const eased = 1 - Math.pow(1 - u, 3);
                        const current = lerp(startVal, endVal, eased);
                        el.textContent = formatCount(current, 0, useSep);
                        if (u < 1) {
                            requestAnimationFrame(tick);
                        } else {
                            el.textContent = formatCount(endVal, 0, useSep);
                        }
                    };
                    requestAnimationFrame(tick);
                });
            },
            { threshold: 0.45 }
        );
        countElements.forEach((el) => countObserver.observe(el));
    }

    // 3. Parse Acts (pin, pan, flow) & Prepare Cues / Parallax / Reveal / Pan Rails
    const actNodes = Array.from(root.querySelectorAll('[data-sc-act]'));
    const acts = actNodes.map((el) => {
        const type = el.getAttribute('data-sc-act') || 'flow';
        const span = parseFloat(el.getAttribute('data-sc-span')) || 1.6;
        const stage = el.querySelector('[data-sc-stage], .sc-stage');
        const panRail = el.querySelector('[data-sc-pan]');
        const panOvershoot = panRail ? parseFloat(panRail.getAttribute('data-sc-pan')) || 0.04 : 0;

        const cues = Array.from(el.querySelectorAll('[data-sc-cue]')).map((cueEl) => {
            const parts = (cueEl.getAttribute('data-sc-cue') || '0 1')
                .trim()
                .split(/\s+/)
                .map(parseFloat);
            const from = isNaN(parts[0]) ? 0 : parts[0];
            const to = isNaN(parts[1]) ? 1 : parts[1];
            const hasExplicitTo = parts.length >= 2;
            const spanWindow = Math.max(0.001, to - from);
            const rampIn = parts.length >= 3 && !isNaN(parts[2]) ? parts[2] : spanWindow * 0.28;
            const rampOut =
                parts.length >= 4 && !isNaN(parts[3])
                    ? parts[3]
                    : hasExplicitTo
                      ? spanWindow * 0.28
                      : 0;
            const risePx = parseFloat(cueEl.getAttribute('data-sc-rise') ?? '16');
            return { el: cueEl, from, to, hasExplicitTo, rampIn, rampOut, risePx };
        });

        const parallaxes = Array.from(el.querySelectorAll('[data-sc-parallax]')).map((pEl) => ({
            el: pEl,
            rate: parseFloat(pEl.getAttribute('data-sc-parallax')) || 0,
        }));

        const reveals = Array.from(el.querySelectorAll('[data-sc-reveal]')).map((rEl) => {
            const dir = rEl.getAttribute('data-sc-reveal') || 'up';
            const atParts = (rEl.getAttribute('data-sc-reveal-at') || '0.08 0.55')
                .trim()
                .split(/\s+/)
                .map(parseFloat);
            return {
                el: rEl,
                dir,
                from: isNaN(atParts[0]) ? 0.08 : atParts[0],
                to: isNaN(atParts[1]) ? 0.55 : atParts[1],
            };
        });

        return {
            el,
            type,
            span,
            stage,
            panRail,
            panOvershoot,
            cues,
            parallaxes,
            reveals,
            top: 0,
            height: 0,
            panDistance: 0,
        };
    });

    // Genealogy SVG Paths (Signature Move 2)
    const genealogySection = document.getElementById('act-genealogy');
    const genealogyPaths = Array.from(root.querySelectorAll('[data-sc-genealogy-path]'));
    genealogyPaths.forEach((path) => {
        try {
            const len = path.getTotalLength ? path.getTotalLength() : 600;
            path.style.strokeDasharray = `${len}`;
            path.style.strokeDashoffset = reduceMotion ? '0' : `${len}`;
            path.__scLen = len;
        } catch (e) {
            path.__scLen = 600;
        }
    });

    // Chronology Trace Rail Elements (Signature Move 1)
    const traceYearEl = document.getElementById('sc-trace-active-year');
    const tracePhaseEl = document.getElementById('sc-trace-active-phase');
    const traceFillEl = document.getElementById('sc-trace-fill');
    const traceNodeBtns = Array.from(root.querySelectorAll('[data-sc-trace-node]'));
    const traceMenuBtn = document.getElementById('sc-trace-menu-btn');
    const traceMenu = document.getElementById('sc-trace-menu');

    // Act 2 Sticky Aside Elements
    const originStickyYearEl = document.getElementById('origin-sticky-year');
    const originStickyStepEl = document.getElementById('origin-sticky-step');
    const originProgressDots = Array.from(root.querySelectorAll('[data-origin-progress-dot]'));
    const originSteps = Array.from(root.querySelectorAll('[data-origin-step]'));
    const originStepTargets = [
        { year: 1962, label: '01 / 03 • Menumpang Kelas Sore' },
        { year: 1965, label: '02 / 03 • Dua Jurusan Pertama' },
        { year: 1976, label: '03 / 03 • Bengkel Kerja Lapangan' }
    ];
    let currentOriginStepIdx = -1;
    let displayedOriginYear = 1962;
    let yearAnimFrameId = null;

    const animateYearTo = (fromYear, toYear, durationMs = 420) => {
        if (yearAnimFrameId) {
            cancelAnimationFrame(yearAnimFrameId);
            yearAnimFrameId = null;
        }

        if (fromYear === toYear || reduceMotion) {
            displayedOriginYear = toYear;
            if (originStickyYearEl) {
                originStickyYearEl.textContent = String(toYear);
            }
            return;
        }

        const startTime = performance.now();
        const tick = (now) => {
            const elapsed = now - startTime;
            const progress = Math.min(1, elapsed / durationMs);
            const ease = 1 - Math.pow(1 - progress, 3);
            const currentVal = Math.round(fromYear + (toYear - fromYear) * ease);
            displayedOriginYear = currentVal;
            if (originStickyYearEl) {
                originStickyYearEl.textContent = String(currentVal);
            }

            if (progress < 1) {
                yearAnimFrameId = requestAnimationFrame(tick);
            } else {
                displayedOriginYear = toYear;
                if (originStickyYearEl) {
                    originStickyYearEl.textContent = String(toYear);
                }
                yearAnimFrameId = null;
            }
        };

        yearAnimFrameId = requestAnimationFrame(tick);
    };

    // Act 3 Pan Progress & Active Milestone Badges
    const panProgressFill = document.getElementById('sc-pan-progress-fill');
    const panStepButtons = Array.from(root.querySelectorAll('[data-pan-step-btn]'));
    const panCards = Array.from(root.querySelectorAll('[data-pan-card-index]'));

    // Measure geometries on load and resize
    const measureLayout = () => {
        const vh = window.innerHeight || 900;
        const scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
        const mobile = isSmallScreen();

        acts.forEach((act) => {
            if ((act.type === 'pin' || act.type === 'pan') && !reduceMotion && !mobile) {
                act.el.classList.add('sc-act--pinned');
                act.el.style.minHeight = `${act.span * 100}vh`;
            } else {
                act.el.classList.remove('sc-act--pinned');
                act.el.style.minHeight = '';
                if (act.panRail) {
                    act.panRail.style.transform = '';
                }
            }

            const rect = act.el.getBoundingClientRect();
            act.top = rect.top + scrollY;
            act.height = rect.height;

            if (act.panRail && act.stage) {
                const railWidth = act.panRail.scrollWidth;
                const stageWidth = act.stage.clientWidth;
                act.panDistance = Math.max(0, (railWidth - stageWidth) * (1 + act.panOvershoot));
            }
        });
    };

    // Evaluate cue opacity & transform
    const evaluateCue = (cue, p) => {
        if (reduceMotion || isSmallScreen()) {
            cue.el.style.opacity = '1';
            cue.el.style.transform = 'none';
            cue.el.style.pointerEvents = 'auto';
            return 1;
        }

        let alpha = 0;
        let yOffset = 0;

        if (p < cue.from) {
            alpha = 0;
            yOffset = cue.risePx;
        } else if (cue.rampIn > 0 && p < cue.from + cue.rampIn) {
            const u = smooth((p - cue.from) / cue.rampIn);
            alpha = u;
            yOffset = lerp(cue.risePx, 0, u);
        } else if (!cue.hasExplicitTo || p <= cue.to - cue.rampOut) {
            alpha = 1;
            yOffset = 0;
        } else if (cue.rampOut > 0 && p < cue.to) {
            const u = smooth((p - (cue.to - cue.rampOut)) / cue.rampOut);
            alpha = 1 - u;
            yOffset = lerp(0, -cue.risePx * 0.65, u);
        } else {
            alpha = 0;
            yOffset = -cue.risePx * 0.65;
        }

        cue.el.style.opacity = alpha.toFixed(3);
        cue.el.style.transform = `translate3d(0, ${yOffset.toFixed(1)}px, 0)`;
        cue.el.style.pointerEvents = alpha > 0.35 ? 'auto' : 'none';
        return alpha;
    };

    // Evaluate reveal clip-path
    const evaluateReveal = (rev, p) => {
        if (reduceMotion) {
            rev.el.style.clipPath = 'none';
            return;
        }
        const u = smooth((p - rev.from) / Math.max(0.001, rev.to - rev.from));
        const clipPct = ((1 - u) * 100).toFixed(2);
        if (rev.dir === 'up') {
            rev.el.style.clipPath = `inset(${clipPct}% 0% 0% 0%)`;
        } else if (rev.dir === 'down') {
            rev.el.style.clipPath = `inset(0% 0% ${clipPct}% 0%)`;
        } else if (rev.dir === 'left') {
            rev.el.style.clipPath = `inset(0% ${clipPct}% 0% 0%)`;
        } else if (rev.dir === 'right') {
            rev.el.style.clipPath = `inset(0% 0% 0% ${clipPct}%)`;
        }
    };

    // Chronology Stops for Signature Move 1
    const chronologyStops = [
        {
            p: 0.0,
            year: 1962,
            phase: 'Era Perintisan STM Negeri Denpasar',
            decree: 'SK No. 17/Djapt/B1/62 (24 Sep 1962)',
            nodeIndex: 0,
        },
        {
            p: 0.22,
            year: 1970,
            phase: 'Ekspansi Proyek PELITA & Bantuan Belanda',
            decree: 'Proyek PELITA • N.11 • Proyek N.95',
            nodeIndex: 1,
        },
        {
            p: 0.38,
            year: 1977,
            phase: 'Peresmian Gedung Ubung (STM Negeri Ubung)',
            decree: '15 April 1977 • Mendikbud Sjarif Thajeb',
            nodeIndex: 2,
        },
        {
            p: 0.54,
            year: 1997,
            phase: 'Perubahan Nomenklatur SMK Negeri 1 Denpasar',
            decree: 'SK Nomor 0537/C4.1/LL/97',
            nodeIndex: 3,
        },
        {
            p: 0.72,
            year: 2006,
            phase: 'Standarisasi Mutu Dunia & 9 Core Business',
            decree: 'ISO 9001:2000 (Lic No: QEC 23382)',
            nodeIndex: 4,
        },
        {
            p: 0.90,
            year: 2026,
            phase: 'Pusat Keunggulan Daikin & Purnabakti Kepemimpinan',
            decree: 'Kurikulum Merdeka • Purnabakti 1 Nov 2026',
            nodeIndex: 5,
        },
    ];

    // Main rAF Scroll Update
    let ticking = false;
    const updateOnScroll = () => {
        ticking = false;
        const scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
        const vh = window.innerHeight || 900;
        const mobile = isSmallScreen();

        acts.forEach((act) => {
            let p = 0;
            if ((act.type === 'pin' || act.type === 'pan') && !reduceMotion && !mobile) {
                const denom = Math.max(1, act.height - vh);
                p = clamp01((scrollY - act.top) / denom);
            } else {
                const denom = Math.max(1, act.height + vh);
                p = clamp01((scrollY + vh - act.top) / denom);
            }

            act.el.style.setProperty('--sc-p', p.toFixed(4));

            // Parallax planes
            if (!reduceMotion && !mobile) {
                act.parallaxes.forEach((item) => {
                    const y = item.rate * (p - 0.5) * 100;
                    item.el.style.transform = `translate3d(0, ${y.toFixed(1)}px, 0)`;
                });
            }

            // Cues
            act.cues.forEach((cue) => evaluateCue(cue, p));

            // Reveals
            act.reveals.forEach((rev) => evaluateReveal(rev, p));

            // Act 3 Horizontal Pan Rail
            if (act.type === 'pan' && act.panRail) {
                if (!reduceMotion && !mobile && act.panDistance > 0) {
                    const tx = -p * act.panDistance;
                    act.panRail.style.transform = `translate3d(${tx.toFixed(1)}px, 0, 0)`;
                } else {
                    act.panRail.style.transform = '';
                }

                if (panProgressFill) {
                    panProgressFill.style.transform = `scaleX(${p.toFixed(3)})`;
                }

                const activeMilestone = Math.min(5, Math.floor(p * 6));
                panStepButtons.forEach((btn, idx) => {
                    const active = idx === activeMilestone;
                    btn.classList.toggle('bg-[#0E1133]', active);
                    btn.classList.toggle('text-white', active);
                    btn.classList.toggle('border-[#0E1133]', active);
                    btn.classList.toggle('bg-white', !active);
                    btn.classList.toggle('text-[#0E1133]', !active);
                    btn.classList.toggle('border-slate-200', !active);
                });

                panCards.forEach((card, idx) => {
                    const isFocused = idx === activeMilestone;
                    card.classList.toggle('ring-2', isFocused);
                    card.classList.toggle('ring-[#2563EB]', isFocused);
                });
            }
        });

        // Act 2 Predetermined Step Year Animation (1962 -> 1965 -> 1976)
        if (originStickyYearEl && originSteps.length >= 3) {
            const eyeLine = vh * 0.40;
            const r0 = originSteps[0].getBoundingClientRect();
            const r1 = originSteps[1].getBoundingClientRect();
            const r2 = originSteps[2].getBoundingClientRect();

            let targetStep = 0;
            if (r2.top <= eyeLine) {
                targetStep = 2;
            } else if (r1.top <= eyeLine) {
                targetStep = 1;
            } else {
                targetStep = 0;
            }

            if (targetStep !== currentOriginStepIdx) {
                const prevIdx = currentOriginStepIdx;
                currentOriginStepIdx = targetStep;

                const targetMeta = originStepTargets[targetStep];
                const fromYear = prevIdx === -1 ? targetMeta.year : displayedOriginYear;
                const toYear = targetMeta.year;

                animateYearTo(fromYear, toYear);

                if (originStickyStepEl) {
                    originStickyStepEl.textContent = targetMeta.label;
                }

                originProgressDots.forEach((dot, dIdx) => {
                    const isActive = dIdx === targetStep;
                    dot.classList.toggle('bg-[#2563EB]', isActive);
                    dot.classList.toggle('w-8', isActive);
                    dot.classList.toggle('bg-slate-300', !isActive);
                    dot.classList.toggle('w-3', !isActive);
                });
            }
        }

        // Signature Move 2: Self-Drawing Curriculum Genealogy SVG Paths
        if (genealogySection && genealogyPaths.length && !reduceMotion) {
            const gRect = genealogySection.getBoundingClientRect();
            const drawProgress = clamp01((vh * 0.82 - gRect.top) / Math.max(280, gRect.height * 0.55));
            genealogyPaths.forEach((path) => {
                const len = path.__scLen || 600;
                const offset = len * (1 - smooth(drawProgress));
                path.style.strokeDashoffset = `${offset.toFixed(1)}`;
            });
        }

        // Signature Move 1: Persistent Chronology Trace Rail (1962 - 2026)
        const rootRect = root.getBoundingClientRect();
        const totalTrack = Math.max(1, rootRect.height - vh);
        const globalP = clamp01(-rootRect.top / totalTrack);

        if (traceFillEl) {
            traceFillEl.style.transform = `scaleX(${globalP.toFixed(4)})`;
        }

        // Interpolate year 1962..2026 along chronologyStops
        let currentYear = Math.round(lerp(1962, 2026, globalP));
        let activeStop = chronologyStops[0];
        for (let i = 0; i < chronologyStops.length; i++) {
            if (globalP >= chronologyStops[i].p) {
                activeStop = chronologyStops[i];
            }
        }

        if (traceYearEl) traceYearEl.textContent = String(currentYear);
        if (tracePhaseEl) tracePhaseEl.textContent = activeStop.phase;

        traceNodeBtns.forEach((btn, idx) => {
            const current = idx === activeStop.nodeIndex;
            btn.classList.toggle('bg-blue-50', current);
            btn.classList.toggle('text-[#2563EB]', current);
            btn.classList.toggle('font-bold', current);
        });
    };

    const requestTick = () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(updateOnScroll);
        }
    };

    window.addEventListener('scroll', requestTick, { passive: true });
    window.addEventListener('resize', () => {
        measureLayout();
        requestTick();
    });

    if (window.__skensaLenis) {
        window.__skensaLenis.on('scroll', requestTick);
    }

    // 4. Interactive Jump Buttons on Persistent Chronology Trace Rail
    const scrollToTargetY = (targetY) => {
        if (window.__skensaLenis) {
            window.__skensaLenis.scrollTo(targetY, { duration: 1.05 });
        } else {
            window.scrollTo({ top: targetY, behavior: 'smooth' });
        }
    };

    traceNodeBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const targetSelector = btn.getAttribute('data-sc-trace-target');
            if (traceMenu && !traceMenu.classList.contains('hidden')) {
                traceMenu.classList.add('hidden');
                traceMenuBtn?.setAttribute('aria-expanded', 'false');
            }
            if (targetSelector) {
                const targetEl = document.querySelector(targetSelector);
                if (targetEl) {
                    const top = targetEl.getBoundingClientRect().top + (window.pageYOffset || 0) - 80;
                    scrollToTargetY(top);
                }
            }
        });
    });

    // Popover Toggle for "Lompat ke era"
    if (traceMenuBtn && traceMenu) {
        traceMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isClosed = traceMenu.classList.contains('hidden');
            if (isClosed) {
                traceMenu.classList.remove('hidden');
                traceMenuBtn.setAttribute('aria-expanded', 'true');
            } else {
                traceMenu.classList.add('hidden');
                traceMenuBtn.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('click', (e) => {
            if (!traceMenu.contains(e.target) && !traceMenuBtn.contains(e.target)) {
                traceMenu.classList.add('hidden');
                traceMenuBtn.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !traceMenu.classList.contains('hidden')) {
                traceMenu.classList.add('hidden');
                traceMenuBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // 5. Interactive Pioneer Genealogy Filter (Act 4)
    const pioneerFilterBtns = Array.from(root.querySelectorAll('[data-genealogy-filter]'));
    const genealogyBlocks = Array.from(root.querySelectorAll('[data-genealogy-block]'));
    const clusterCards = Array.from(root.querySelectorAll('[data-genealogy-cluster]'));

    pioneerFilterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-genealogy-filter') || 'all';
            pioneerFilterBtns.forEach((b) => {
                const isSelected = b === btn;
                b.classList.toggle('bg-[#0E1133]', isSelected);
                b.classList.toggle('text-white', isSelected);
                b.classList.toggle('border-[#0E1133]', isSelected);
                b.classList.toggle('bg-white', !isSelected);
                b.classList.toggle('text-[#0E1133]', !isSelected);
                b.classList.toggle('border-slate-300', !isSelected);
            });

            genealogyBlocks.forEach((block) => {
                const blockKey = block.getAttribute('data-genealogy-block') || '';
                const match = filter === 'all' || blockKey === filter;
                block.style.opacity = match ? '1' : '0.35';
                block.style.transform = match ? 'scale(1)' : 'scale(0.99)';
                block.classList.toggle('ring-2', match && filter !== 'all');
                block.classList.toggle('ring-[#2563EB]', match && filter !== 'all');
            });

            clusterCards.forEach((card) => {
                const rootOrigin = card.getAttribute('data-pioneer-origin') || '';
                const match = filter === 'all' || rootOrigin === filter;
                card.style.opacity = match ? '1' : '0.45';
            });
        });
    });

    // 6. Interactive LKS Cluster Filter (Act 4)
    const lksFilterBtns = Array.from(root.querySelectorAll('[data-lks-filter]'));
    const lksRows = Array.from(root.querySelectorAll('[data-lks-row]'));

    lksFilterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const target = btn.getAttribute('data-lks-filter') || 'all';
            lksFilterBtns.forEach((b) => {
                const active = b === btn;
                b.classList.toggle('bg-[#0E1133]', active);
                b.classList.toggle('text-white', active);
                b.classList.toggle('bg-slate-100', !active);
                b.classList.toggle('text-slate-700', !active);
            });

            lksRows.forEach((row) => {
                const id = row.getAttribute('data-lks-row');
                const match = target === 'all' || id === target;
                row.style.opacity = match ? '1' : '0.3';
                row.classList.toggle('ring-2', match && target !== 'all');
                row.classList.toggle('ring-[#2563EB]', match && target !== 'all');
            });
        });
    });

    // 7. Interactive Era Matrix Highlighter (Act 3)
    const eraFilterBtns = Array.from(root.querySelectorAll('[data-era-highlight]'));
    const eraCells = Array.from(root.querySelectorAll('[data-era-col]'));

    eraFilterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const col = btn.getAttribute('data-era-highlight') || 'all';
            eraFilterBtns.forEach((b) => {
                const active = b === btn;
                b.classList.toggle('bg-[#2563EB]', active);
                b.classList.toggle('text-white', active);
                b.classList.toggle('border-[#2563EB]', active);
                b.classList.toggle('bg-white/10', !active);
                b.classList.toggle('text-slate-200', !active);
                b.classList.toggle('border-white/15', !active);
            });

            eraCells.forEach((cell) => {
                const c = cell.getAttribute('data-era-col');
                const isMatch = col === 'all' || c === col;
                cell.style.opacity = isMatch ? '1' : '0.35';
                cell.classList.toggle('bg-blue-950/60', col !== 'all' && isMatch);
            });
        });
    });

    // 8. Collapsible & Searchable 29 Archival References Drawer (Act 6)
    const citationsToggle = document.getElementById('sc-citations-toggle');
    const citationsPanel = document.getElementById('sc-citations-panel');
    const citationsLabel = document.getElementById('sc-citations-toggle-label');
    const citationsSearch = document.getElementById('sc-citations-search');
    const citationItems = Array.from(root.querySelectorAll('[data-citation-item]'));
    const citationCountLabel = document.getElementById('sc-citations-count');

    if (citationsToggle && citationsPanel) {
        citationsToggle.addEventListener('click', () => {
            const expanded = citationsToggle.getAttribute('aria-expanded') === 'true';
            citationsToggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
            citationsPanel.classList.toggle('hidden', expanded);
            if (citationsLabel) {
                citationsLabel.textContent = expanded
                    ? 'Buka Laci 29 Sumber Kutipan Arsip Resmi'
                    : 'Tutup Laci Sumber Kutipan Arsip';
            }
        });
    }

    if (citationsSearch && citationItems.length) {
        citationsSearch.addEventListener('input', () => {
            const q = citationsSearch.value.trim().toLowerCase();
            let visible = 0;
            citationItems.forEach((item) => {
                const text = (item.getAttribute('data-citation-text') || '').toLowerCase();
                const show = !q || text.includes(q);
                item.classList.toggle('hidden', !show);
                if (show) visible++;
            });
            if (citationCountLabel) {
                citationCountLabel.textContent = `${visible} dari 29 sumber ditampilkan`;
            }
        });
    }

    // 9. Pointer Tilt Device (data-sc-tilt)
    if (finePointer && !reduceMotion) {
        const tiltNodes = root.querySelectorAll('[data-sc-tilt]');
        tiltNodes.forEach((el) => {
            const maxDeg = clamp(parseFloat(el.getAttribute('data-sc-tilt')) || 5, 2, 9);
            el.addEventListener('mousemove', (e) => {
                const r = el.getBoundingClientRect();
                const nx = (e.clientX - r.left) / Math.max(1, r.width) - 0.5;
                const ny = (e.clientY - r.top) / Math.max(1, r.height) - 0.5;
                const rx = (-ny * maxDeg).toFixed(2);
                const ry = (nx * maxDeg).toFixed(2);
                el.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg)`;
            });
            el.addEventListener('mouseleave', () => {
                el.style.transform = '';
            });
        });
    }

    // Initial measurement & render
    measureLayout();
    updateOnScroll();
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => {
            measureLayout();
            updateOnScroll();
        });
    }
}
