<template>
<div>
    <span class="font-bold">{{listing.beds}}</span> beds <span class="text-gray-300">|</span> <span class="font-bold">{{listing.baths}}</span> baths <span class="text-gray-300">|</span> <span class="font-bold">{{listing.area}}</span> m²
</div>
</template>

<script setup>

defineProps({
    listing:Object
})

</script>

<style scoped>

</style>
