document.addEventListener('DOMContentLoaded', () => {
    const thumbnailss = document.querySelectorAll('.thumb');
    console.log('Thumbnails:', thumbnailss);

    if (thumbnailss.length === 0) {
        console.error('No thumbnail images found');
        return;
    }

    const images = Array.from(thumbnails).map(thumb => thumb.src);
    console.log('Thumbnail URLs:', images);

    if (images.length === 0) {
        console.error('No thumbnail image URLs found');
        return;
    }

    let currentIndex = 0;
    let animationType = 'slide'; // Default to slide animation

    function showImage(index) {
        if (index < 0 || index >= images.length) return; // Index bounds check

        const mainImage = document.getElementById('mainImage');
        if (!mainImage) {
            console.error('Main image element not found');
            return;
        }

        const thumbnails = document.querySelectorAll('.thumb');
        thumbnails.forEach(thumb => thumb.classList.remove('active'));

        if (thumbnails[index]) {
            thumbnails[index].classList.add('active');
        }

        const animationClass = animationType === 'fade' ? 'fade' : 'slide';
        mainImage.classList.remove('active', 'fade', 'slide');
        mainImage.classList.add(animationClass);

        setTimeout(() => {
            mainImage.src = images[index];
            mainImage.classList.add('active');
        }, 700);

        updateDots(index);
    }

    function updateDots(index) {
        const dots = document.querySelectorAll('.dots-container .dot');
        dots.forEach(dot => dot.classList.remove('active'));
        const activeDotIndex = Math.floor(index / 3);
        if (dots[activeDotIndex]) {
            dots[activeDotIndex].classList.add('active');
        }
    }

    function scrollToGroup(groupIndex) {
        const thumbnailsContainer = document.querySelector('.thumbnails');
        if (!thumbnailsContainer) return;

        const scrollPosition = (thumbnailsContainer.scrollWidth / (Math.ceil(images.length / 3))) * groupIndex;
        thumbnailsContainer.scrollTo({
            left: scrollPosition,
            behavior: 'smooth'
        });
        updateDots(groupIndex * 3);
    }

    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        mainImage.src = images[0];
        mainImage.classList.add('active', animationType);
    } else {
        console.error('Main image element not found');
    }

    updateDots(0);

    const thumbnails = document.querySelectorAll('.thumbnails img');
    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener('click', () => showImage(index));
    });

    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const thumbnailsContainer = document.querySelector('.thumbnails');

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            if (thumbnailsContainer) {
                thumbnailsContainer.scrollBy({
                    left: -thumbnailsContainer.clientWidth / 0.35,
                    behavior: 'smooth'
                });
                updateDots(Math.floor(thumbnailsContainer.scrollLeft / (thumbnailsContainer.clientWidth / 3)));
            }
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            if (thumbnailsContainer) {
                thumbnailsContainer.scrollBy({
                    left: thumbnailsContainer.clientWidth / 0.35,
                    behavior: 'smooth'
                });
                updateDots(Math.floor(thumbnailsContainer.scrollLeft / (thumbnailsContainer.clientWidth / 3)));
            }
        });
    }

    let isDragging = false;
    let startPosition = 0;
    let scrollLeft = 0;

    if (thumbnailsContainer) {
        thumbnailsContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            startPosition = e.pageX - thumbnailsContainer.offsetLeft;
            scrollLeft = thumbnailsContainer.scrollLeft;
            thumbnailsContainer.style.cursor = 'grabbing';
        });

        thumbnailsContainer.addEventListener('mouseleave', () => {
            isDragging = false;
            thumbnailsContainer.style.cursor = 'grab';
        });

        thumbnailsContainer.addEventListener('mouseup', () => {
            isDragging = false;
            thumbnailsContainer.style.cursor = 'grab';
        });

        thumbnailsContainer.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - thumbnailsContainer.offsetLeft;
            const walk = (x - startPosition) * 2;
            thumbnailsContainer.scrollLeft = scrollLeft - walk;
        });
    }
});
