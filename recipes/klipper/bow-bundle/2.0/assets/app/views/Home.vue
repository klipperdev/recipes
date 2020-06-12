<template>
    <v-container fill-height>
        <v-row no-gutters justify="center" align="center">
            <div class="text-center">
                <v-subheader></v-subheader>
                <h3 class="mb-5 text--secondary">{{ $t('views.home.title') }}</h3>
            </div>
        </v-row>
    </v-container>
</template>

<script lang="ts">
    import {MetaInfo} from 'vue-meta';
    import {Component, Vue} from 'vue-property-decorator';

    @Component
    export default class Home extends Vue {
        public metaInfo(): MetaInfo {
            return {
                title: this.$t('views.home.title') as string,
            };
        }
    }
</script>
