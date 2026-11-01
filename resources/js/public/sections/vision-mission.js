import gsap from 'gsap';

export function initVisionMission() {
    const container = document.querySelector('[data-char-component]');
    if (!container) return;

    const tabs = container.querySelectorAll('[data-char-tab]');
    const panels = container.querySelectorAll('[data-char-panel]');

    if (!tabs.length || !panels.length) return;

    const activateTab = (code) => {
        tabs.forEach((tab) => {
            const isMatch = tab.getAttribute('data-char-tab') === code;
            tab.setAttribute('aria-selected', isMatch ? 'true' : 'false');

            const badge = tab.querySelector('span:first-child');
            const sub = tab.querySelector('.text-xs');

            if (isMatch) {
                tab.className =
                    'px-4 py-3 rounded-2xl text-left transition-all cursor-pointer flex items-center gap-3 border bg-[#071C3F] text-white border-[#071C3F] shadow-sm font-bold';
                if (badge) {
                    badge.className =
                        'w-8 h-8 rounded-xl font-mono text-xs font-extrabold flex items-center justify-center shrink-0 bg-cyan-400 text-ink';
                }
                if (sub) {
                    sub.className = 'text-xs font-mono uppercase tracking-wider text-cyan-300';
                }
            } else {
                tab.className =
                    'px-4 py-3 rounded-2xl text-left transition-all cursor-pointer flex items-center gap-3 border bg-white text-ink border-transparent hover:border-line font-medium text-slate-700';
                if (badge) {
                    badge.className =
                        'w-8 h-8 rounded-xl font-mono text-xs font-extrabold flex items-center justify-center shrink-0 bg-paper-2 text-slate-600';
                }
                if (sub) {
                    sub.className = 'text-xs font-mono uppercase tracking-wider text-slate-500';
                }
            }
        });

        panels.forEach((panel) => {
            const isMatch = panel.getAttribute('data-char-panel') === code;
            if (isMatch) {
                panel.classList.remove('hidden');
                panel.classList.add('block');
                gsap.fromTo(
                    panel,
                    { opacity: 0, y: 12 },
                    { opacity: 1, y: 0, duration: 0.28, ease: 'power2.out', overwrite: true }
                );
            } else {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            }
        });
    };

    tabs.forEach((tab, index) => {
        const code = tab.getAttribute('data-char-tab');

        tab.addEventListener('click', () => {
            activateTab(code);
        });

        tab.addEventListener('keydown', (e) => {
            let targetIndex = null;
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                targetIndex = (index + 1) % tabs.length;
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                targetIndex = (index - 1 + tabs.length) % tabs.length;
            }

            if (targetIndex !== null) {
                const targetTab = tabs[targetIndex];
                targetTab.focus();
                const targetCode = targetTab.getAttribute('data-char-tab');
                activateTab(targetCode);
            }
        });
    });
}
