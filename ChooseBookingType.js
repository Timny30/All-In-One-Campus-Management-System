// Programmer Name: Mr.Sylvester Ng Jun Hong (TP076143)
// Program Name: Choose Booking Time Type
// Description: A interface for Lecturer and Student to choose the facility they wish to reserve
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025

const swiper = new Swiper('.wrapper', {
    loop: true,
    spaceBetween: 30,

    autoplay: {
        delay:4000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },
  
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,

    },
  
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    breakpoints:{
        0:{
            slidesPerView: 1,
        },
        768:{
            slidesPerView: 2,
        },
        1024:{
            slidesPerView: 3,
        }
    }
  });