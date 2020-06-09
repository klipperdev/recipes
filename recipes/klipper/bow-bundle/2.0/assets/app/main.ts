import 'core-js/stable';
import Vue from 'vue';
import VueI18n from 'vue-i18n';
import Vuex from 'vuex';
import Vuetify from 'vuetify/lib';
import VueSnackbar from '@klipper/bow/snackbars/VueSnackbar';
import VueFormatter from '@klipper/bow/formatter/VueFormatter';
import VueI18nExtra from '@klipper/bow/i18n/VueI18nExtra';
import App from '@app/components/App.vue';
import {I18nModule} from '@klipper/bow/stores/i18n/I18nModule';
import {CurrencyFormatter} from '@klipper/bow/i18n/CurrencyFormatter';
import {RootState} from '@app/store/RootState';
import bowLocaleEn from '@klipper/bow/translations/en';
import bowLocaleFr from '@klipper/bow/translations/fr';
import appLocaleEn from '@app/translations/en';
import appLocaleFr from '@app/translations/fr';
import vuetifyLocaleFr from 'vuetify/src/locale/fr';
import vuetifyBowPreset from '@klipper/bow/vuetify/bowPreset';
import '@klipper/bow/registerServiceWorker';
import '@app/styles/app.scss';

Vue.config.productionTip = false;
Vue.use(VueI18n);
Vue.use(Vuetify);
Vue.use(Vuex);

const vuetify = new Vuetify(Object.assign({}, vuetifyBowPreset, {
    lang: {
        locales: {
            fr: vuetifyLocaleFr,
        },
    },
}));

const i18n = new VueI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages: {
        en: Object.assign({}, bowLocaleEn, appLocaleEn),
        fr: Object.assign({}, bowLocaleFr, appLocaleFr),
    },
});

const store = new Vuex.Store<RootState>({
    state: {} as RootState,
    modules: {
        i18n: new I18nModule(i18n, vuetify),
    },
});

Vue.use(new VueI18nExtra({currencyFormatter: new CurrencyFormatter(store)}));
Vue.use(new VueSnackbar());
Vue.use(new VueFormatter());

new Vue({
    i18n,
    store,
    vuetify,
    render: (h) => h(App),
}).$mount('#app');
