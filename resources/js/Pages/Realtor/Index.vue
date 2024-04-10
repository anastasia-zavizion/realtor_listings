<template>
    <h1 class="text-3xl mb-4">Your listings</h1>
    <section class="mb-8">
        Filters
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings" :key="listing.id">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <Price class="text-2xl font-medium" :price="listing.price"/>
                        <ListingSpace :listing="listing"/>
                    </div>


                    <ListingAddress :listing="listing"></ListingAddress>
                </div>
                <div class="flex items-center gap-1 text-gray-600">

                    <Link class="btn-outline text-xs font-medium">Previw</Link>
                    <Link class="btn-outline text-xs font-medium">Edit</Link>

                    <Link class="btnSmall" as="button" method="DELETE" :href="route('realtor.listing.destroy',listing.id)">Delete
                    </Link>

                </div>

            </div>
        </Box>
    </section>

</template>

<script setup>
import {Link} from "@inertiajs/vue3";

import Box from "../../Components/UI/Box";
import ListingSpace from "../../Components/ListingSpace";
import Price from "../../Components/Price";
import ListingAddress from "../../Components/ListingAddress";

defineProps({
    listings:Array
})

</script>
