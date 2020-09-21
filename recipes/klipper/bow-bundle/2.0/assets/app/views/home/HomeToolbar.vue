<template>
    <div class="v-toolbar--content" v-if="'user' === $route.params.org">
        <v-spacer></v-spacer>

        <k-search-field prefix="toolbar-search"></k-search-field>

        <v-spacer></v-spacer>

        <v-btn rounded ripple icon @click="refresh">
            <v-icon>refresh</v-icon>
        </v-btn>
    </div>

    <v-spacer v-else></v-spacer>
</template>

<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator';

    @Component
    export default class HomeToolbar extends Vue {
        public refresh(): void {
            this.$root.$emit('toolbar-search-request-refresh');
        }
    }
</script>
