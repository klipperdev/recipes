import {TextDrawerItem} from '@klipper/bow/drawer/TextDrawerItem';
import Vue from 'vue';
import App from '@app/components/App.vue';
import appLocaleEn from '@app/translations/en';
import appLocaleEs from '@app/translations/es';
import appLocaleFr from '@app/translations/fr';
import {RootState} from '@app/store/RootState';
import {createApp} from '@klipper/bow/bow';
import '@app/styles/fonts.scss';
import '@app/styles/app.scss';

const app = createApp<RootState>({
    i18n: {
        messages: {
            en: appLocaleEn,
            es: appLocaleEs,
            fr: appLocaleFr,
        },
    },
    rootRedirectRoute: {name: 'home', params: {org: '_'}},
    rootRoute: {name: 'home', params: {org: '_'}},
    userContextRedirectRoute: {name: 'home', params: {org: '_'}},
    drawer: {
        contextItems: {
            user: [
                (new TextDrawerItem('my-organizations'))
                    .setIcon('fa-fw fa-home')
                    .setRoute((vue: Vue) => ({name: 'home', params: {org: vue.$org}})),
            ],
            organization: [
                (new TextDrawerItem())
                    .setText('views.home.title')
                    .setIcon('fa-fw fa-home')
                    .setColor('primary')
                    .setRoute((vue: Vue) => ({name: 'home', params: {org: vue.$org}})),
            ],
        },
    },
    router: {
        routes: [
            {
                path: '/:org([\\w-]+)/home',
                name: 'home',
                meta: {requiresAuth: true},
                components: {
                    default: () => import(/* webpackChunkName: "views-home" */ '@app/views/Home.vue'),
                    toolbar: () => import(/* webpackChunkName: "views-home" */ '@app/views/home/HomeToolbar.vue'),
                    fab: () => import(/* webpackChunkName: "views-home" */ '@klipper/bow/views/organizations/OrganizationFabCreate/OrganizationFabCreate.vue'),
                },
            },
        ],
    },
});

new Vue(Object.assign(app, {
    render: (h: (v: Vue.VueConstructor<Vue>) => any) => h(App),
})).$mount('#app');
