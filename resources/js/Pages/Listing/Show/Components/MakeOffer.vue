<template>
<Box>
    <template #header>Making offer</template>
    <div>
        <form @submit.prevent="makeOffer">
            <input v-model.number="form.amount" type="text" class="input">

            <input v-model.number="form.amount" type="range" :min="min" :max="props.price" step="0,1" class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearence-none coursor-pointer">

            <button type="submit" class="btn-outline w-full mt-2 text-sm">Make an Offer</button>
        </form>
    </div>
    <div class="flex justify-between text-gray-500 mt-2">
        <div>
            Difference
        </div>
        <div>
           <Price :price="difference"></Price>
        </div>
    </div>

</Box>
</template>

<script setup>
import Box from "../../../../Components/UI/Box";
import Price from "../../../../Components/Price";
import {useForm} from "@inertiajs/vue3";
import {computed, watch} from "vue";
import {debounce} from 'lodash';

const props = defineProps({
    listingId:Number,
    price:Number
})
const form = useForm({
amount:props.price
})

const difference = computed(()=> props.price - form.amount)
const min = Math.round(computed(()=> props.price / 2));

const makeOffer = ()=>{
    form.post(route('listing.offer.store',{listing:props.listingId}),{
        preserveState:true,
        preserveScroll:true,
    })
}

const emit = defineEmits(['offerUpdated'])
watch(()=>form.amount, debounce((value)=> emit('offerUpdated',value) ), 2000);

</script>

<style scoped>

</style>
