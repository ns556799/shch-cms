const tabContainer = document.querySelector('.js-tabs')

const titleTabs = Array.from(tabContainer.querySelectorAll('.tabItem__title'))
const contentTabs = Array.from(tabContainer.querySelectorAll('.tabItem__content'))

titleTabs.forEach((titleTab) => {
  titleTab.addEventListener('click', (e) => {
    const tabId = titleTab.dataset.id
    titleTabs.forEach((e) => {
      e.classList.remove('-first')
    })
    titleTab.classList.add('-first')
    contentTabs.forEach((t) => {
      t.classList.remove('-first')
      if (t.dataset.id === tabId) {
        t.classList.add('-first')
      }
    })
  })
})
