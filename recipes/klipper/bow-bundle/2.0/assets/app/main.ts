import 'core-js/stable';
import Vue from 'vue';
import vuetify from '@app/plugins/vuetify';
import App from '@app/components/App.vue';
import '@klipper/bow/registerServiceWorker';
import '@app/styles/app.scss';

Vue.config.productionTip = false;

new Vue({
    vuetify,
    render: (h) => h(App),
}).$mount('#app');
