import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import vuetifyLocaleFr from 'vuetify/src/locale/fr';

Vue.use(Vuetify);

export default new Vuetify({
    icons: {
        iconfont: 'md',
    },
    theme: {
        themes: {
            light: {
                primary: '#384d76',
                secondary: '#4d89a0',
                accent: '#1e88e5',
                error: '#f44336',
                warning: '#f9a825',
                info: '#4fc3f7',
                success: '#4caf50',
            },
            dark: {
                primary: '#6185cc',
                secondary: '#4d89a0',
                accent: '#1e88e5',
                error: '#f44336',
                warning: '#f9a825',
                info: '#4fc3f7',
                success: '#4caf50',
            },
        },
    },
    lang: {
        locales: {
            fr: vuetifyLocaleFr,
        },
    },
});
