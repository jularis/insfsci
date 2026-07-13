document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    const flashInfosCarousel = document.getElementById('flashInfosCarousel');
    const flashInfosContainer = document.getElementById('flashInfosContainer');

    if (flashInfosContainer && flashInfosCarousel) {
        flashInfosContainer.addEventListener('mouseenter', () => {
            flashInfosCarousel.classList.add('paused');
        });

        flashInfosContainer.addEventListener('mouseleave', () => {
            flashInfosCarousel.classList.remove('paused');
        });
    }

    const heroSlider = document.getElementById('hero-slider');
    const heroSliderTrack = document.getElementById('hero-slider-track');
    const heroSliderPrev = document.getElementById('hero-slider-prev');
    const heroSliderNext = document.getElementById('hero-slider-next');
    const heroSliderDots = document.querySelectorAll('.hero-slider-dot');
    const heroSlideCount = heroSliderDots.length;
    let heroSlideIndex = 0;
    let heroSlideTimer;

    const updateHeroSlider = () => {
        if (!heroSliderTrack) return;

        heroSliderTrack.style.transform = `translateX(-${heroSlideIndex * 100}%)`;
        heroSliderDots.forEach((dot, index) => {
            dot.classList.toggle('bg-white', index === heroSlideIndex);
            dot.classList.toggle('bg-white/50', index !== heroSlideIndex);
        });
    };

    const goToHeroSlide = (index) => {
        heroSlideIndex = (index + heroSlideCount) % heroSlideCount;
        updateHeroSlider();
    };

    const stopHeroSlider = () => {
        clearInterval(heroSlideTimer);
    };

    const startHeroSlider = () => {
        if (!heroSlideCount) return;
        stopHeroSlider();
        heroSlideTimer = setInterval(() => {
            goToHeroSlide(heroSlideIndex + 1);
        }, 5500);
    };

    if (heroSlider && heroSliderTrack && heroSlideCount) {
        heroSliderPrev?.addEventListener('click', () => {
            stopHeroSlider();
            goToHeroSlide(heroSlideIndex - 1);
            startHeroSlider();
        });

        heroSliderNext?.addEventListener('click', () => {
            stopHeroSlider();
            goToHeroSlide(heroSlideIndex + 1);
            startHeroSlider();
        });

        heroSliderDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopHeroSlider();
                goToHeroSlide(index);
                startHeroSlider();
            });
        });

        heroSlider.addEventListener('mouseenter', stopHeroSlider);
        heroSlider.addEventListener('mouseleave', startHeroSlider);
        startHeroSlider();
    }

    const galleryLightbox = document.getElementById('gallery-lightbox');
    const galleryLightboxImage = document.getElementById('gallery-lightbox-image');
    const galleryLightboxClose = document.getElementById('gallery-lightbox-close');
    const galleryLightboxPrev = document.getElementById('gallery-lightbox-prev');
    const galleryLightboxNext = document.getElementById('gallery-lightbox-next');
    const galleryTriggers = document.querySelectorAll('.gallery-lightbox-trigger');
    let galleryImages = [];
    let galleryIndex = 0;

    const showGalleryImage = () => {
        if (!galleryLightboxImage || !galleryImages.length) return;
        galleryLightboxImage.src = galleryImages[galleryIndex];
    };

    const openGallery = (images, index) => {
        if (!galleryLightbox || !images.length) return;

        galleryImages = images;
        galleryIndex = index;
        showGalleryImage();
        galleryLightbox.classList.remove('hidden');
        galleryLightbox.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    const closeGallery = () => {
        if (!galleryLightbox) return;

        galleryLightbox.classList.add('hidden');
        galleryLightbox.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        if (galleryLightboxImage) {
            galleryLightboxImage.src = '';
        }
    };

    const moveGallery = (direction) => {
        if (!galleryImages.length) return;
        galleryIndex = (galleryIndex + direction + galleryImages.length) % galleryImages.length;
        showGalleryImage();
    };

    galleryTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const images = JSON.parse(trigger.dataset.images || '[]');
            const index = Number(trigger.dataset.index || 0);
            openGallery(images, index);
        });
    });

    galleryLightboxClose?.addEventListener('click', closeGallery);
    galleryLightboxPrev?.addEventListener('click', () => moveGallery(-1));
    galleryLightboxNext?.addEventListener('click', () => moveGallery(1));

    galleryLightbox?.addEventListener('click', (event) => {
        if (event.target === galleryLightbox) {
            closeGallery();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (!galleryLightbox || galleryLightbox.classList.contains('hidden')) return;

        if (event.key === 'Escape') {
            closeGallery();
        } else if (event.key === 'ArrowLeft') {
            moveGallery(-1);
        } else if (event.key === 'ArrowRight') {
            moveGallery(1);
        }
    });
});
