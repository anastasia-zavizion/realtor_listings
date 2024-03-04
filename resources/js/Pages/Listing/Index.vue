<template>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3  gap-4">
          <Listing :key="listing.id"  :listing="listing" v-for="listing in listings"/>
      </div>
</template>

<script setup>

import Listing from "./Index/Components/Listing";

defineProps({
    'listings': Array
});
</script>

<style scoped>

</style>
