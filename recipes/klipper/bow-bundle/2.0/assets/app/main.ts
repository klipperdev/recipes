import 'core-js/stable';
import Vue from 'vue';
import App from '@app/components/App.vue';

Vue.config.productionTip = false;

new Vue({
    render: (h) => h(App),
}).$mount('#app');
