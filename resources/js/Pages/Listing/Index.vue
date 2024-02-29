<template>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3  gap-4">
          <Box :key="listing.id"  v-for="listing in listings">
              <Link :href="route('listing.show',listing.id)">
                  <Price class="text-2xl font-bold" :price="listing.price"></Price>
                  <ListingSpace :listing="listing" class="text-md"></ListingSpace>
                  <ListingAddress :listing="listing" class="text-gray-800"></ListingAddress>
              </Link>

              <div class="mb-2 mt-2">
                  <Link class="btnSmall" :href="route('listing.edit',listing.id)">Edit
                  </Link>
              </div>

              <div>
                  <Link class="btnSmall" as="button" method="DELETE" :href="route('listing.destroy',listing.id)">Delete
                  </Link>
              </div>

          </Box>
      </div>



</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import ListingAddress from "../../Components/ListingAddress";
import Box from "../../Components/UI/Box";
import ListingSpace from "../../Components/ListingSpace";
import Price from "../../Components/Price";

defineProps({
    'listings': Array
});
</script>

<style scoped>

</style>
