<template>
    <organization-list :title="$t('my-organizations')"></organization-list>
</template>

<script lang="ts">
import OrganizationList from '@klipper/bow/views/organizations/OrganizationList/OrganizationList.vue';
import {defineComponent} from '@vue/composition-api';

export default defineComponent({
    name: 'UserHome',
    components: {
        OrganizationList,
    }
});
</script>
