<template>

    <div>
        <ListingAddress :listing="listing"></ListingAddress>
    </div>


</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import ListingAddress from "../../Components/ListingAddress";

defineProps({
    'listing':Object
})
</script>

<style scoped>

</style>
