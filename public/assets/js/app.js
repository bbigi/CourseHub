document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('.public-navbar');
    const parallaxItems = Array.from(document.querySelectorAll('[data-parallax], [data-scroll-parallax]'));
    let ticking = false;

    function clamp(value, min, max) {
        return Math.max(min, Math.min(max, value));
    }

    function updateParallax() {
        const viewportHeight = window.innerHeight || document.documentElement.clientHeight;
        const scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;

        if (navbar) {
            navbar.classList.toggle('scrolled', scrollY > 10);
        }

        parallaxItems.forEach(function (item) {
            const rect = item.getBoundingClientRect();
            const isVisible = rect.bottom > -240 && rect.top < viewportHeight + 240;
            if (!isVisible) return;

            const speed = parseFloat(item.dataset.speed || item.dataset.parallaxSpeed || '0');
            const xSpeed = parseFloat(item.dataset.x || item.dataset.parallaxX || '0');
            const rotateSpeed = parseFloat(item.dataset.rotate || item.dataset.parallaxRotate || '0');
            const scaleSpeed = parseFloat(item.dataset.scale || item.dataset.parallaxScale || '0');
            const distanceFromCenter = rect.top + (rect.height / 2) - (viewportHeight / 2);
            const progress = clamp((viewportHeight - rect.top) / (viewportHeight + Math.max(rect.height, 1)), 0, 1);

            const y = distanceFromCenter * speed;
            const x = distanceFromCenter * xSpeed;
            const rotate = distanceFromCenter * rotateSpeed;
            const scale = 1 + ((progress - 0.5) * scaleSpeed);

            item.style.setProperty(
                'transform',
                `translate3d(${x.toFixed(2)}px, ${y.toFixed(2)}px, 0) rotate(${rotate.toFixed(2)}deg) scale(${scale.toFixed(4)})`,
                'important'
            );
        });

        ticking = false;
    }

    function requestParallaxUpdate() {
        if (!ticking) {
            window.requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    updateParallax();
    window.addEventListener('scroll', requestParallaxUpdate, { passive: true });
    window.addEventListener('resize', requestParallaxUpdate);
    window.addEventListener('load', requestParallaxUpdate);
});
