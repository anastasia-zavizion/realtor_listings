<template>
<Box>
    <template #header>Offer #{{offer.id}} <span class="rounded-md font-bold text-green-900  ml-2 p-1 bg-green-100 uppercase" v-if="accepted">accepted</span></template>

    <section class="flex justify-between mt-1">
        <div>
            <Price :price="offer.amount" class="text-xl"/>
            <div class="text-gray-500">Difference <Price :price="difference"/></div>
            <div class="text-gray-500">Made By {{offerMadeBy}}</div>
            <div class="text-gray-500">Made On {{offerMadeOn}}</div>
        </div>
        <div>
            <Link v-if="!accepted"  as="button" method="put" :href="route('realtor.offer.accept', {offer:offer.id})" class="btn-outline text-sm font-medium">Accept</Link>

        </div>
    </section>
</Box>
</template>

<script setup>

import {Link} from "@inertiajs/vue3";

import Box from "../../../../Components/UI/Box";
import Price from "../../../../Components/Price";
import {computed} from "vue";

const props = defineProps({
    offer:Object,
    listingPrice:Number
})

const difference = computed(()=> props.listingPrice - props.offer.amount);

const offerMadeOn = computed(()=> new Date(props.offer.created_at).toDateString())
const offerMadeBy = computed(()=> props.offer.bidder.name)
const accepted = computed(()=> props.offer.accepted_at)


</script>
