const carouselContainer = document.querySelector('.carousel-container');
const banners = document.querySelectorAll('.banner');
const prevButton = document.querySelector('.carousel-btn.prev');
const nextButton = document.querySelector('.carousel-btn.next');

let currentIndex = 0;

// Function to update carousel position
function updateCarousel() {
    const offset = -currentIndex * 100; // Tính toán vị trí chuyển đổi
    carouselContainer.style.transform = `translateX(${offset}%)`;
}

// Event listeners for buttons
nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % banners.length; // Quay vòng khi đạt đến cuối
    updateCarousel();
});

prevButton.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + banners.length) % banners.length; // Quay vòng từ đầu về cuối
    updateCarousel();
});
