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
            component: () => import('@/components/home')
        },
        {
            path: "/order",
            name: "order",
            meta: {
                index: 1,
            },
            component: () => import('@/components/order')
        },
        {
            path: "/prod",
            name: "prod",
            meta: {
                index: 3,
            },
            component: () => import('@/components/prod')
        },
        {
            path: "/center",
            name: "center",
            meta: {
                index: 3,
            },
            component: () => import('@/components/center')
        }
    ]
})