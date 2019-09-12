import Vue from 'vue'
import router from './router/router'
import webSocket from './js/websocket'

import App from './App.vue'

console.log(webSocket)


Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
