<template>

    <div class="mb-4">
        <Link
            :href="route('realtor.listing.index')"
        >
            ← Go back to Listings
        </Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>

        <div v-else class="md:col-span-7 items-center">
           <Offer  :listing-price="listing.price" :offer="offer" :key="offer.id" class="mb-4" v-for="offer in listing.offers"/>
        </div>

        <div class="md:col-span-5">
            <Box>
                <template #header>Basic Info</template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
        </div>

    </section>
</template>


<script setup>

import Price from "../../Components/Price";
import ListingSpace from "../../Components/ListingSpace";
import ListingAddress from "../../Components/ListingAddress";
import {computed} from "vue";
import Offer from "./Show/Components/Offer";
import Box from "../../Components/UI/Box";

const props = defineProps({
    listing:Object
})


const hasOffers = computed(
    () => props.listing.offers.length,
)

</script>


