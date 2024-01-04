<template>
       <div :key="listing.id"  v-for="listing in listings">
           <Link :href="`/listing/${listing.id}`"><ListingAddress :listing="listing"></ListingAddress>
           </Link>
       </div>

</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import ListingAddress from "../../Components/ListingAddress";

defineProps({
    'listings': Array
});
</script>

<style scoped>

</style>
