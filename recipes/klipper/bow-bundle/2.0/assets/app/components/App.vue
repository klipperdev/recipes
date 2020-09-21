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
    import {TextDrawerItem} from '@klipper/bow/drawer/TextDrawerItem';

    @Component
    export default class App extends Vue {
        public get drawerItems(): DrawerItem[] {
            if ('user' === this.$store.state.account.organization) {
                return [
                    (new TextDrawerItem('my-organizations'))
                        .setIcon('fa fa-fw fa-home')
                        .setColor('primary')
                        .setRoute({name: 'home', params: {org: this.$org}}),
                ];
            }

            return [
                (new TextDrawerItem('views.home.title'))
                    .setIcon('fa fa-fw fa-home')
                    .setColor('primary')
                    .setRoute({name: 'home', params: {org: this.$org}}),
            ];
        }
    }
</script>
