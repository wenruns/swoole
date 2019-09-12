import Vue from 'vue'
import router from './router/router'

import App from './App.vue'
import VueTouch from 'vue-touch'
console.log(VueTouch);
VueTouch.config.swipe = {
	threshold: 100 ,//手指左右滑动距离
}
Vue.use(VueTouch, {name: 'v-touch'})



Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
