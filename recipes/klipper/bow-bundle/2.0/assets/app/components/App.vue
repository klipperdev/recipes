<template>
    <k-app>
        <template v-slot:drawer.append>
            <k-drawer-section-settings/>
        </template>
    </k-app>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';

export default defineComponent({
    name: 'App',
});
</script>
