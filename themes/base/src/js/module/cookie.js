const cookieWrapper = document.querySelector('.js-site-cookie')
const cookieAccept = cookieWrapper.querySelector('button')

cookieAccept.addEventListener('click', (e) => {
  setCookie('SiteCookie', 1, 30)
  cookieWrapper.classList.add('-accepted')
})

function setCookie(name, value, days) {
  var expires = ''
  if (days) {
    var date = new Date()
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000))
    expires = '; expires=' + date.toUTCString()
  }
  document.cookie = name + '=' + (value || '') + expires + '; path=/'
}
