<template>
<form>
    <div class="mb-4 mt-4 flex flex-wrap  gap-2">
        <div class="flex flex-nowrap items-center gap-2">
            <input v-model="filterForm.deleted" id="deleted" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600  ring-indigo-500 focus:ring-2 focus:ring-indigo-500"/>
            <label for="deleted">Deleted</label>
        </div>

        <button @click="filter">Filter</button>
    </div>
</form>
</template>





<script setup>
import {useForm} from "@inertiajs/vue3";

import { Inertia } from '@inertiajs/inertia'


const filterForm = useForm({
    priceFrom:null,
    priceTo:null,
    beds: null,
    baths:null,
    areaFrom:null,
    areaTo:null,
})

const filter = () =>{
    console.log('filter1');
    filterForm.get(
        route('realtor.index', {
            preserveState:true,
            preserveScroll:true
        })
    );
}


</script>
