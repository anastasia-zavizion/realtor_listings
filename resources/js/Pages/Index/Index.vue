<template>
        <div>Index</div>
        <div>{{message}}</div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    'message': String
});

</script>


<style scoped>

</style>
