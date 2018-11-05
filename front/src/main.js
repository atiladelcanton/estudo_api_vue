import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import VueTheMask from 'vue-the-mask'
import VueRouter from 'vue-router'
import Routes from './router/index'
import VModal from 'vue-js-modal'
import VueSweetalert2 from 'vue-sweetalert2';
import VeeValidate from 'vee-validate';
import Select2 from 'v-select2-component';

Vue.config.productionTip = false
Vue.use(VueTheMask)
Vue.use(VueRouter)
Vue.use(VModal, { dialog: true })
Vue.use(VueSweetalert2)
Vue.use(VeeValidate)
Vue.component('Select2', Select2)
const router = new VueRouter({
    routes: Routes
});
Vue.directive("material-select", {
    bind: function(el, binding, vnode) {
        $(function() {
            $(el).material_select();
        });
        var arg = binding.arg;
        if (!arg) arg = "change";
        arg = "on" + arg;
        el[arg] = function() {
            vnode.context.$data.selected = [];
            for (let i = 0; i < 12; i++) {
                if (el[i].selected === true) {
                    vnode.context.$data.selected.push(el[i].value);
                }
            }
        };
    },
    unbind: function(el) {
        $(el).material_select("destroy");
    }
});
new Vue({
  render: h => h(App),
    router: router,
    ready: function() {
        $("select").formSelect();
    }
}).$mount('#app')
