import 'core-js/stable';
import Vue from 'vue';
import vuetify from '@app/plugins/vuetify';
import App from '@app/components/App.vue';

Vue.config.productionTip = false;

new Vue({
    vuetify,
    render: (h) => h(App),
}).$mount('#app');
