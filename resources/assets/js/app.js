
require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'Vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        task:{}
    },
    mutations:{
        setTask(state,obj){
            state.task = obj;
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('top', require('./components/Top.vue'));
Vue.component('panel', require('./components/Panel.vue'));
Vue.component('box', require('./components/Box.vue'));
Vue.component('page', require('./components/Page.vue'));
Vue.component('table-list', require('./components/TableList.vue'));
Vue.component('breadcrumbs', require('./components/Breadcrumbs.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('modal-link', require('./components/modal/ModalLink.vue'));
Vue.component('formulary', require('./components/Formulary.vue'));


const app = new Vue({
    el: '#app',
    store,
    mounted:function () {
        document.getElementById('app').style.display="block";
    }
});
