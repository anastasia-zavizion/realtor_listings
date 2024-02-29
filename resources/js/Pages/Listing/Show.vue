<template>
    <div class="flex flex-col flex-col-reverse  md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">
                No images
            </div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">

            <Box>
                <template #header>
                    Basic info
                </template>
                <Price class="text-2xl font-bold" :price="listing.price"></Price>
                <ListingSpace :listing="listing" class="text-md"></ListingSpace>
                <ListingAddress :listing="listing" class="text-gray-800"></ListingAddress>
            </Box>

            <Box>
                <template #header>
                    Offer
                </template>
                Make offer
            </Box>
        </div>
    </div>

</template>

<script setup>
import ListingAddress from "../../Components/ListingAddress";
import Price from "../../Components/Price";
import ListingSpace from "../../Components/ListingSpace";
import Box from "../../Components/UI/Box";

defineProps({
    'listing':Object
})
</script>

<style scoped>

</style>
