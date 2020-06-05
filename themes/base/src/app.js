import 'babel-polyfill'
import 'polyfill/customEvent'

// =utils
import 'util/breakpoints'
import 'util/detectTouch'

// =layout
// if (document.querySelector('.header')) {
//   import(/* webpackChunkName: "header" */ 'layout/header')
// }

// debug mode
if (document.querySelector('body').classList.contains('-debug')) {
  import(/* webpackChunkName: "debugger" */ 'util/debugger')
}

// =modules

if (document.querySelector('.js-banner')) {
  import(/* webpackChunkName: "banner" */ 'module/banner')
}

setTimeout(() => {
  if (document.querySelector('.js-site-cookie')) {
    import(/* webpackChunkName: "cookie" */ 'module/cookie')
  }
  if (document.querySelector('.js-map-container')) {
    import(/* webpackChunkName: "cookie" */ 'module/map')
  }
}, 1000)

if (document.querySelector('.js-tabs')) {
  import(/* webpackChunkName: "tabs" */ 'module/tabs')
}
if (document.querySelector('.js-navigation-menu')) {
  import(/* webpackChunkName: "nav" */ 'module/menu')
}
if (document.querySelector('.js-team-member')) {
  import(/* webpackChunkName: "team" */ 'module/team')
}
if (document.querySelector('.js-about-gallery')) {
  import(/* webpackChunkName: "team" */ 'module/gallery')
}
if (document.querySelector('.js-facilities-slider')) {
  import(/* webpackChunkName: "team" */ 'module/fc-slider')
}

// =blocks
// if (document.querySelector('.m-blockname')) {
//   import(/* webpackChunkName: "blockName" */ 'block/blockName')
// }

// =pages
// if (document.querySelector('.page-specific')) {
//   import(/* webpackChunkName: "pageSpecific" */ 'page/pageSpecific')
// }
