<template>
    <user-home v-if="'user' === $route.params.org"></user-home>

    <org-home v-else></org-home>
</template>

<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator';
    import UserHome from '@app/views/home/UserHome.vue';
    import OrgHome from '@app/views/home/OrgHome.vue';

    @Component({
        components: {
            OrgHome,
            UserHome,
        },
    })
    export default class Home extends Vue {
    }
</script>
