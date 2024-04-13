<template>
<Box>
    <template #header>Offer #{{offer.id}}</template>

    <section class="flex text-center justify-between">

        <div>
            <Price :price="offer.amount" class="text-xl"/>
        </div>

        <div class="text-gray-500">
            Difference <Price :price="difference"/>
        </div>

        <div class="text-gray-500">
            Made By {{offerMadeBy}}
        </div>

        <div class="text-gray-500">
            Made On {{offerMadeOn}}
        </div>


        <div>
            <Link  as="button" method="post" class="btn-outline text-sm font-medium" >Accept</Link>
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


</script>
