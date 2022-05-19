<template>
    <v-container fill-height>
        <v-row no-gutters justify="center" align="center">
            <div class="text-center">
                <h3 class="mb-5 text--secondary">{{ self.$t('app.description', {name: self.$klipper.name, org: self.$orgLabel}) }}</h3>
            </div>
        </v-row>
    </v-container>
</template>

<script lang="ts">
import {selfable} from '@klipper/bow/composables/mixins/selfable';
import {defineComponent} from '@vue/composition-api';
import {MetaInfo} from 'vue-meta';

export default defineComponent({
    name: 'OrgHome',

    mixins: [
        selfable,
    ],

    metaInfo(): MetaInfo {
        return {
            title: this.$t('views.home.title') as string,
        };
    },
});
</script>
