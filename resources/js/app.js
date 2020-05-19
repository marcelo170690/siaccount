require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('navbar-component', require('./components/NavbarComponent').default);
//account
Vue.component('account-component', require('./components/account/AccountComponent').default);
Vue.component('account-create', require('./components/account/AccountCreate').default);

//web account
Vue.component('web-account-create', require('./components/web-account/WebAccountCreate').default);
Vue.component('web-account', require('./components/web-account/WebAccount').default);

//app
Vue.component('app', require('./components/App').default);

import router from './routes'

const app = new Vue({
    el: '#app',
    router,
});
