import Vue from 'vue';
import App from '@app/components/App.vue';
import VueCompositionAPI from '@vue/composition-api';
import {TextDrawerItem} from '@klipper/bow/drawer/TextDrawerItem';
import {RootState} from '@app/store/RootState';
import {createApp} from '@klipper/bow/bow';
import {deepMerge} from '@klipper/bow/utils/object';
import appLocaleEn from '@app/translations/en';
import appLocaleEs from '@app/translations/es';
import appLocaleFr from '@app/translations/fr';
import bowLocaleEs from '@klipper/bow/translations/es';
import bowLocaleFr from '@klipper/bow/translations/fr';
import vuetifyLocaleEs from 'vuetify/src/locale/es';
import vuetifyLocaleFr from 'vuetify/src/locale/fr';
import countryEs from 'i18n-iso-countries/langs/es.json';
import countryFr from 'i18n-iso-countries/langs/fr.json';
import uploaderEs from '@uppy/locales/src/es_ES';
import uploaderFr from '@uppy/locales/src/fr_FR';
import '@app/styles/fonts.scss';
import '@app/styles/app.scss';

Vue.use(VueCompositionAPI);

const app = createApp<RootState>({
    i18n: {
        messages: {
            en: appLocaleEn,
            es: deepMerge({}, bowLocaleEs, appLocaleEs),
            fr: deepMerge({}, bowLocaleFr, appLocaleFr),
        },
    },
    i18nExtra: {
        countryFormatter: {
            locales: {
                es: countryEs,
                fr: countryFr,
            },
        },
    },
    uploader: {
        locales: {
            es: uploaderEs,
            fr: uploaderFr,
        },
    },
    vuetifyPreset: {
        lang: {
            locales: {
                es: vuetifyLocaleEs,
                fr: vuetifyLocaleFr,
            },
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
