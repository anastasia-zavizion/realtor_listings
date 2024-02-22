<template>
       <div class="text-3xl font-bold underline" :key="listing.id"  v-for="listing in listings">
           <Link :href="route('listing.show',listing.id)"><ListingAddress :listing="listing"></ListingAddress>
           </Link>

           <div>
               <Link :href="route('listing.edit',listing.id)">Edit
               </Link>
           </div>

           <div>

               <Link as="button" method="DELETE" :href="route('listing.destroy',listing.id)">Delete
               </Link>
           </div>

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
