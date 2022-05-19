<template>
    <user-home v-if="'user' === self.$route.params.org"></user-home>

    <org-home v-else></org-home>
</template>

<script lang="ts">
import OrgHome from '@app/views/home/OrgHome.vue';
import UserHome from '@app/views/home/UserHome.vue';
import {selfable} from '@klipper/bow/composables/mixins/selfable';
import {defineComponent} from '@vue/composition-api';

export default defineComponent({
    name: 'Home',

    mixins: [
        selfable,
    ],

    components: {
        OrgHome,
        UserHome,
    },
});
</script>
