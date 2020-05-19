import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    // mode: 'history',
    routes:[
        {
            path: '/accountIndex',
            name: 'accountIndex',
            component: require('./components/account/AccountIndex').default
        },
        {
            path: '/accountEdit/:id',
            name: 'accountEdit',
            component: require('./components/account/AccountEdit').default,
            props: true
        },
        {
            path: '/webAccountIndex/:accountId',
            name: 'webAccountIndex',
            component: require('./components/web-account/WebAccountIndex').default,
            props: true
        },
        {
            path: '/webAccountIndexAll',
            name: 'webAccountIndexAll',
            component: require('./components/web-account/WebAccountIndexAll').default,
        },
        // {
        //     path: '*',
        //     redirect: '/error404',
        //     component: require('./components/E404').default,
        // }
    ],
})
