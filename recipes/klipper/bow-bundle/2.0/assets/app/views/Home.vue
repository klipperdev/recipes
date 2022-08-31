<template>
    <user-home v-if="'user' === $route.params.org"></user-home>

    <org-home v-else></org-home>
</template>

<script lang="ts">
import OrgHome from '@app/views/home/OrgHome.vue';
import UserHome from '@app/views/home/UserHome.vue';
import {defineComponent} from '@vue/composition-api';

export default defineComponent({
    name: 'Home',

    components: {
        OrgHome,
        UserHome,
    },
});
</script>
