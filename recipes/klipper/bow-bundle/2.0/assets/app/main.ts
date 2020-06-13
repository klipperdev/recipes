import 'core-js/stable';
import '@klipper/bow/propertyDecorator/registerHooks';
import Vue from 'vue';
import Meta from 'vue-meta';
import VueI18n from 'vue-i18n';
import Vuex from 'vuex';
import Vuetify from 'vuetify/lib';
import VueLongClick from '@klipper/bow/longClick/VueLongClick';
import VueRouterBack from '@klipper/bow/routerBack/VueRouterBack';
import VueSnackbar from '@klipper/bow/snackbar/VueSnackbar';
import VueFormatter from '@klipper/bow/formatter/VueFormatter';
import VueI18nExtra from '@klipper/bow/i18n/VueI18nExtra';
import VueValidator from '@klipper/bow/validator/VueValidator';
import VueThemer from '@klipper/bow/themer/VueThemer';
import VueApi from '@klipper/bow/api/VueApi';
import Router from 'vue-router';
import App from '@app/components/App.vue';
import KSimpleSpacer from '@klipper/bow/components/KSimpleSpacer/KSimpleSpacer.vue';
import {RouterBackOptions} from '@klipper/bow/routerBack/RouterBackOptions';
import {RequiredRule} from '@klipper/bow/validator/rules/RequiredRule';
import {I18nValidator} from '@klipper/bow/validator/I18nValidator';
import {I18nModule} from '@klipper/bow/stores/i18n/I18nModule';
import {DarkModeModule} from '@klipper/bow/stores/darkMode/DarkModeModule';
import {DrawerModule} from '@klipper/bow/stores/drawer/DrawerModule';
import {AuthModule} from '@klipper/bow/stores/auth/AuthModule';
import {NullAuthManager} from '@klipper/bow/auth/NullAuthManager';
import {CurrencyFormatter} from '@klipper/bow/i18n/CurrencyFormatter';
import {RootState} from '@app/store/RootState';
import {deepMerge} from '@klipper/bow/utils/object';
import {addAuthGuard} from '@klipper/bow/routers/authGuard';
import {addDefaultToolbarComponentGuard} from '@klipper/bow/routers/defaultToolbarComponentGuard';
import {createRoutes} from '@klipper/bow/routers/router';
import bowLocaleEn from '@klipper/bow/translations/en';
import bowLocaleFr from '@klipper/bow/translations/fr';
import appLocaleEn from '@app/translations/en';
import appLocaleFr from '@app/translations/fr';
import vuetifyLocaleFr from 'vuetify/src/locale/fr';
import vuetifyBowPreset from '@klipper/bow/vuetify/bowPreset';
import '@klipper/bow/registerServiceWorker';
import '@app/styles/fonts.scss';
import '@app/styles/app.scss';

Vue.config.productionTip = false;
Vue.use(Meta);
Vue.use(VueI18n);
Vue.use(Vuetify);
Vue.use(Vuex);
Vue.use(Router);

const vuetify = new Vuetify(deepMerge(vuetifyBowPreset, {
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

const router = new Router({
    mode: 'history',
    routes: createRoutes([
        {
            path: '/home',
            name: 'home',
            meta: {requiresAuth: true},
            component: () => import(/* webpackChunkName: "views-home" */ '@app/views/Home.vue'),
        },
    ], 'home'),
});

const store = new Vuex.Store<RootState>({
    state: {} as RootState,
    modules: {
        i18n: new I18nModule(i18n, vuetify),
        darkMode: new DarkModeModule(),
        drawer: new DrawerModule(),
        auth: new AuthModule(router, new NullAuthManager()),
    },
});

Vue.use(VueLongClick);
Vue.use(new VueRouterBack(router), {forceHistory: true} as RouterBackOptions);
Vue.use(new VueI18nExtra({currencyFormatter: new CurrencyFormatter(store)}));
Vue.use(new VueValidator(new I18nValidator([RequiredRule], i18n)));
Vue.use(new VueThemer(store));
Vue.use(new VueSnackbar());
Vue.use(new VueFormatter());
Vue.use(new VueApi());

addAuthGuard(router, store);
addDefaultToolbarComponentGuard(router, 'toolbar', KSimpleSpacer);

new Vue({
    i18n,
    store,
    router,
    vuetify,
    render: (h) => h(App),
}).$mount('#app');
