<template>
    <div class="flex flex-col flex-col-reverse  md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div v-if="listing.images.length" class="grid md:grid-cols-2 gap-2">
                <img  :key="image.id" v-for="image in listing.images" :src="image.src" class="rounded-md"/>
            </div>
            <div v-else class="w-full text-center font-medium text-gray-500">
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
                    Monthly payment
                </template>
               <div>
                   <label class="label">Interest rate ({{interestRate}}%)</label>
                   <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-200 rounded-lg appearence-none coursor-pointer">

                   <label class="label">Duration ({{duration}} years)</label>
                   <input v-model.number="duration" type="range" min="3" max="35" step="1" class="w-full h-4 bg-gray-200 rounded-lg appearence-none coursor-pointer">
               </div>

                <div class="text-gray-600 mt-2">
                    <div class="text-gray-400">
                        Your monthly payment
                        <Price :price="monthlyPayment"></Price>
                    </div>

                 <div class="text-gray-400">
                        Total paid
                        <Price :price="totalPaid"></Price>
                    </div>

                </div>
            </Box>

            <MakeOffer @offer-updated="offerUpdated($event)" v-if="user && !offerMade" :listingId="listing.id" :price="listing.price"></MakeOffer>

            <OfferMade v-else :offer="offerMade"></OfferMade>


        </div>
    </div>

</template>

<script setup>
import ListingAddress from "../../Components/ListingAddress";
import Price from "../../Components/Price";
import ListingSpace from "../../Components/ListingSpace";
import Box from "../../Components/UI/Box";
import {computed, ref} from "vue";
import {useMonthlyPayment} from "../../Composables/useMonthlyPayment";
import MakeOffer from "./Show/Components/MakeOffer";
import {usePage} from "@inertiajs/vue3";
import OfferMade from "./Show/Components/OfferMade";

const props = defineProps({
    'listing':Object,
    'offerMade':Object,
})

const interestRate = ref(2.5);
const duration = ref(3);

const offer = ref(props.listing.price);

const { monthlyPayment , totalPaid} = useMonthlyPayment(offer, interestRate, duration)

const page = usePage();
const user = computed(() => {
    return page.props.user;
});

const offerUpdated = (event)=> offer.value = event;


</script>
