<template>
    <k-app>
        <template v-slot:drawer.append>
            <k-drawer-section-settings/>
        </template>
    </k-app>
</template>

<script lang="ts">
    import Vue from 'vue';
    import {Component} from 'vue-property-decorator';

    @Component
    export default class App extends Vue {
    }
</script>
