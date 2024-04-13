<template>
<Box>
    <template #header>Making offer</template>
    <div>
        <form>
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
import {computed} from "vue";

const props = defineProps({
    listingId:Number,
    price:Number
})
const form = useForm({
amount:props.price
})

const difference = computed(()=> props.price - form.amount)
const min = computed(()=> props.price / 2)


</script>

<style scoped>

</style>
