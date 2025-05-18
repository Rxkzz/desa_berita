const swiper = new Swiper('.mySwiper', {
  slidesPerView: 1,
  spaceBetween: 0,
  centeredSlides: true,
  loop: true,
  loopedSlides: 3,
  initialSlide: 1,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  autoplay: {
    delay: 5000, // 5000 milliseconds = 5 seconds
    disableOnInteraction: false, // Continue autoplay after user interactions
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
  },
  on: {
    beforeInit: function () {
      const swiperContainer = document.querySelector('.mySwiper .swiper-wrapper');
      const slides = swiperContainer.querySelectorAll('.swiper-slide');

      // Duplikat slide secara manual
      if (slides.length === 3) {
        slides.forEach((slide) => {
          const clone = slide.cloneNode(true);
          swiperContainer.appendChild(clone);
        });
      }
    },
  },
});
