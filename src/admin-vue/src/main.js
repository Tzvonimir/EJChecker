// === DEFAULT / CUSTOM STYLE ===
// WARNING! always comment out ONE of the two require() calls below.
// 1. use next line to activate CUSTOM STYLE (./src/themes)
// require(`./themes/app.${__THEME}.styl`)
// 2. or, use next line to activate DEFAULT QUASAR STYLE
require(`quasar/dist/quasar.${__THEME}.css`)
// ==============================

import Vue from 'vue'
import Quasar from 'quasar'
import router from './router'
import VueI18n from 'vue-i18n'
import lang from './i18n'
import store from './store'

Vue.use(Quasar)
Vue.use(VueI18n)

const i18n = new VueI18n({
  locale: 'hr', // set default locale
  messages: lang // set locale messages
})

Vue.prototype.setLocale = function (locale) {
  i18n.locale = locale
}

Quasar.start(() => {
  /* eslint-disable no-new */
  new Vue({
    el: '#q-app',
    router,
    i18n,
    store,
    render: h => h(require('./App'))
  })
})
