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
}, 1000)

if (document.querySelector('.js-tabs')) {
  import(/* webpackChunkName: "tabs" */ 'module/tabs')
}

// =blocks
// if (document.querySelector('.m-blockname')) {
//   import(/* webpackChunkName: "blockName" */ 'block/blockName')
// }

// =pages
// if (document.querySelector('.page-specific')) {
//   import(/* webpackChunkName: "pageSpecific" */ 'page/pageSpecific')
// }
