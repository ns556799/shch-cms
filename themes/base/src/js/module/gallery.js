import Swiper from 'swiper'

const bannerContainers = Array.from(document.querySelectorAll('.js-about-gallery'))

bannerContainers.forEach((bannerContainer) => {
  const swiper = new Swiper(bannerContainer, {
    autoplay: {
      delay: 3000,
    },
    loop: true,
    effect: 'fade'
  })
})
