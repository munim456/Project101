import './bootstrap';

import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

window.Alpine = Alpine;
Alpine.start();

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

AOS.init({
    duration: 600,
    once: true,
    offset: 60,
    disable: prefersReducedMotion,
});

// Sticky navbar: transparent-to-solid on scroll
const navbar = document.querySelector('[data-navbar]');
if (navbar) {
    const onScroll = () => navbar.classList.toggle('is-scrolled', window.scrollY > 12);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

// Count-up stats when scrolled into view
const counters = document.querySelectorAll('[data-counter]');
if (counters.length) {
    const animateCounter = (el) => {
        const target = parseInt(el.dataset.counter, 10) || 0;
        if (prefersReducedMotion) {
            el.textContent = target.toLocaleString();
            return;
        }
        const duration = 1200;
        const start = performance.now();
        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            el.textContent = Math.floor(progress * target).toLocaleString();
            if (progress < 1) requestAnimationFrame(step);
            else el.textContent = target.toLocaleString();
        };
        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    counters.forEach((el) => observer.observe(el));
}

// Dismissible announcement banner (persists per browser session)
document.querySelectorAll('[data-announcement-dismiss]').forEach((btn) => {
    const banner = btn.closest('[data-announcement]');
    if (!banner) return;
    const key = `announcement-dismissed-${banner.dataset.announcement}`;
    if (sessionStorage.getItem(key)) {
        banner.remove();
        return;
    }
    btn.addEventListener('click', () => {
        sessionStorage.setItem(key, '1');
        banner.remove();
    });
});
