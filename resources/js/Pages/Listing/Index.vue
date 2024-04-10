<template>

    <Filters :filters="filters">

    </Filters>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3  gap-4">
         <Listing :key="listing.id"  :listing="listing" v-for="listing in listings.data"/>
      </div>

      <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
          <Pagination :links="listings.links"/>
      </div>
</template>

<script setup>

import Listing from "./Index/Components/Listing";
import Pagination from "../../Components/UI/Pagination";
import Filters from "./Index/Components/Filters";

const props = defineProps({
    'listings': Object,
    'filters': Object,
});
</script>

