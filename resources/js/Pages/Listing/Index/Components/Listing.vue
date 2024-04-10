<template>
    <Box>
        <Link :href="route('listing.show',listing.id)">

            <div class="flex items-center gap-1">
                <Price class="text-2xl font-bold" :price="listing.price"></Price>
                <div class="text-xs text-gray-500">
                    <Price :price="monthlyPayment"></Price>
                </div>
            </div>

            <ListingSpace :listing="listing" class="text-md"></ListingSpace>
            <ListingAddress :listing="listing" class="text-gray-800"></ListingAddress>
        </Link>

        <div class="mb-2 mt-2">
            <Link class="btnSmall" :href="route('listing.edit',listing.id)">Edit
            </Link>
        </div>

    </Box>
</template>

<script setup>
import Box from "../../../../Components/UI/Box";
import {Link} from '@inertiajs/vue3';
import ListingAddress from "../../../../Components/ListingAddress";
import ListingSpace from "../../../../Components/ListingSpace";
import Price from "../../../../Components/Price";
import {useMonthlyPayment} from "../../../../Composables/useMonthlyPayment";

const props = defineProps({
    listing:Object
})

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 3);


</script>

<style scoped>

</style>
