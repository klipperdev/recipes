import Vue from 'vue';
import App from '@app/components/App.vue';
import appLocaleEn from '@app/translations/en';
import appLocaleFr from '@app/translations/fr';
import {RootState} from '@app/store/RootState';
import {createApp} from '@klipper/bow/bow';
import {createRoutes} from '@klipper/bow/routers/router';
import '@app/styles/fonts.scss';
import '@app/styles/app.scss';

const app = createApp<RootState>({
    i18n: {
        messages: {
            en: appLocaleEn,
            fr: appLocaleFr,
        },
    },
    router: {
        routes: createRoutes([
            {
                path: '/home',
                name: 'home',
                meta: {requiresAuth: true},
                component: () => import(/* webpackChunkName: "views-home" */ '@app/views/Home.vue'),
            },
        ], 'home'),
    },
});

new Vue(Object.assign(app, {
    render: (h: (v: Vue.VueConstructor<Vue>) => any) => h(App),
})).$mount('#app');
