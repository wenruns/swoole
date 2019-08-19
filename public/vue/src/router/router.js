import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

export default new VueRouter({
    routes:[
        {
            path: "/",
            name: "home",
            meta: {
                index: 0,
            },
            component: () => import('@/components/HelloWorld')
        }
    ]
})