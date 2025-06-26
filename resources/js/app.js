import './bootstrap';

document.addEventListener('livewire:navigated', function () {
    const containers = document.querySelectorAll('.swipe-container');

    containers.forEach(container => {
        let isDown = false;
        let startX;
        let scrollLeft;

        // Mouse events
        container.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('mouseleave', () => {
            isDown = false;
        });

        container.addEventListener('mouseup', () => {
            isDown = false;
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2;
            container.scrollLeft = scrollLeft - walk;
        });

        // Touch events
        container.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('touchmove', (e) => {
            const x = e.touches[0].clientX;
            const walk = (startX - x) * 1.5;
            container.scrollLeft = scrollLeft + walk;
        });
    });
});
