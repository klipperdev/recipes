<template>
    <k-app :drawer-items="drawerItems">
        <template v-slot:drawer.append>
            <k-drawer-section-settings></k-drawer-section-settings>
        </template>
    </k-app>
</template>

<script lang="ts">
    import Vue from 'vue';
    import {Component} from 'vue-property-decorator';
    import {DrawerItem} from '@klipper/bow/drawer/DrawerItem';

    @Component
    export default class App extends Vue {
        public get drawerItems(): DrawerItem[] {
            return [];
        }
    }
</script>
