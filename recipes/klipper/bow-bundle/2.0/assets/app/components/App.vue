<template>
    <k-app :drawer-items="drawerItems">
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
