const menuBtn = document.querySelector('.js-navigation-menu')

menuBtn.addEventListener('click', (e) => {
  e.preventDefault()
  menuBtn.classList.toggle('clickMenuFive')
  document.querySelector('body').classList.toggle('-menu-open')
})
