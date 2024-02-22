<template>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3  gap-4">
          <Box :key="listing.id"  v-for="listing in listings">
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

          </Box>
      </div>



</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import ListingAddress from "../../Components/ListingAddress";
import Box from "../../Components/UI/Box";

defineProps({
    'listings': Array
});
</script>

<style scoped>

</style>
