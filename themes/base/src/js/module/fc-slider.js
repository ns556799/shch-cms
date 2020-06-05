import Swiper from 'swiper'

const fcContainer = document.querySelector('.js-facilities-slider')
const fcSwiper = fcContainer.querySelector('.swiper-container')
const fcnext = fcContainer.querySelector('.swiper-button-next')
const fcprev = fcContainer.querySelector('.swiper-button-prev')
const scrollbar = fcContainer.querySelector('.swiper-scrollbar')

const mySwiper = new Swiper(fcSwiper, {
  speed: 400,
  spaceBetween: 10,
  slidesPerView: 2,
  centeredSlides: true,
  loop: true,
  scrollbar: {
    el: scrollbar,
    draggable: true,
  },
  navigation: {
    nextEl: fcnext,
    prevEl: fcprev,
  },
  breakpoints: {
    // when window width is <= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 10
    },
    // when window width is <= 480px
    480: {
      slidesPerView: 2,
      spaceBetween: 20
    }
  }
})
