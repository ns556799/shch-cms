import Swiper from 'swiper'

const bannerContainers = Array.from(document.querySelectorAll('.js-banner'))

bannerContainers.forEach((bannerContainer) => {
  const swiperContainer = bannerContainer.querySelector('.swiper-container')

  const swiper = new Swiper(swiperContainer, {
    autoplay: {
      delay: 2000,
    },
    loop: true,
    effect: 'coverflow'
  })
})
