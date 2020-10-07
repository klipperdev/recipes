<template>
    <organization-list :title="$t('my-organizations')"></organization-list>
</template>

<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator';
    import OrganizationList from '@klipper/bow/views/organizations/OrganizationList.vue';

    @Component({
        components: {
            OrganizationList,
        },
    })
    export default class UserHome extends Vue {
    }
</script>
