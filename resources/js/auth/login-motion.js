import gsap from 'gsap';

export function initLoginMotion() {
    const stage = document.querySelector('[data-login-stage]');
    if (!stage) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Blueprint SVG Architecture Lines Draw
    const blueprintSvg = document.querySelector('[data-blueprint-svg]');
    if (blueprintSvg && !prefersReducedMotion) {
        const strokeElements = blueprintSvg.querySelectorAll('path, line, rect, circle, polyline');
        strokeElements.forEach((el) => {
            let length = 200;
            if (typeof el.getTotalLength === 'function') {
                try {
                    length = el.getTotalLength() || 200;
                } catch (e) {
                    length = 200;
                }
            }
            el.style.strokeDasharray = String(length);
            el.style.strokeDashoffset = String(length);
        });

        gsap.to(strokeElements, {
            strokeDashoffset: 0,
            duration: 2.2,
            stagger: 0.08,
            ease: 'power2.out',
            delay: 0.2,
        });

        // Soft ambient pulse on the blueprint grid lines
        gsap.to('[data-blueprint-pulse]', {
            opacity: 0.65,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
            delay: 2.4,
        });
    }

    // 2. Staggered Entry for Right Panel Form Elements
    if (!prefersReducedMotion) {
        const formItems = document.querySelectorAll('[data-form-stagger]');
        if (formItems.length) {
            gsap.fromTo(
                formItems,
                { opacity: 0, y: 16 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.06,
                    ease: 'power3.out',
                    delay: 0.15,
                }
            );
        }
    }

    // 3. Error Shake Response
    const errorAlert = document.querySelector('[data-login-error]');
    const formCard = document.querySelector('[data-form-card]');
    if (errorAlert && formCard && !prefersReducedMotion) {
        gsap.fromTo(
            formCard,
            { x: -8 },
            {
                x: 8,
                duration: 0.07,
                repeat: 5,
                yoyo: true,
                ease: 'power1.inOut',
                onComplete: () => {
                    gsap.set(formCard, { x: 0 });
                },
            }
        );
    }

    // 4. Password Visibility Toggle
    const togglePasswordBtn = document.querySelector('[data-toggle-password]');
    const passwordInput = document.getElementById('password');
    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', () => {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            const showIcon = togglePasswordBtn.querySelector('[data-icon-show]');
            const hideIcon = togglePasswordBtn.querySelector('[data-icon-hide]');
            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden', isPassword);
                hideIcon.classList.toggle('hidden', !isPassword);
            }
        });
    }

    // 5. Submit Button Morph / Loading State
    const loginForm = document.querySelector('[data-login-form]');
    const submitBtn = document.querySelector('[data-submit-btn]');
    const submitText = document.querySelector('[data-submit-text]');
    const submitSpinner = document.querySelector('[data-submit-spinner]');

    if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', () => {
            submitBtn.setAttribute('disabled', 'disabled');
            submitBtn.classList.add('opacity-90', 'cursor-wait');
            if (submitText) submitText.classList.add('opacity-0');
            if (submitSpinner) submitSpinner.classList.remove('hidden');
        });
    }
}
