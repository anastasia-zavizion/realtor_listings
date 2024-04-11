<template>
    <h1 class="text-3xl mb-4">Your listings</h1>
    <section>
        <form>
            <div class="mb-4 mt-4 flex flex-wrap  gap-4">
                <div class="flex flex-nowrap items-center gap-2">
                    <input v-model="filterForm.deleted" id="deleted" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600  ring-indigo-500 focus:ring-2 focus:ring-indigo-500"/>
                    <label for="deleted">Deleted</label>
                </div>

                <div>
                    <select class="input-filter-l w-24" v-model="filterForm.by">
                        <option value="created_at">Added</option>
                        <option value="price">Price</option>
                    </select>
                    <select class="input-filter-r w-32" v-model="filterForm.order">
                        <option :value="sortItem.value" :key="sortItem.value" v-for="sortItem in sortOptions">{{sortItem.label}}</option>
                    </select>

                </div>

                <button @click="filter">Filter</button>
            </div>
        </form>
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

                    <Link class="btnSmall" as="button" method="DELETE" :href="route('realtor.destroy',listing.id)">Delete
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
import RealtorFilters from "./Components/RealtorFilters";
import { Inertia } from '@inertiajs/inertia'
import { reactive, watch, computed } from 'vue'
import {debounce} from 'lodash';

defineProps({
    listings:Array
})

const sortLabels = {
    created_at:[
        {
            'label':'Latest',
            'value':'desc'
        },
        {
            'label':'Oldest',
            'value':'asc'
        }

    ],
    price:[
        {
            'label':'Pricey',
            'value':'desc'
        },
        {
            'label':'Cheapest',
            'value':'asc'
        }
    ]
}

const sortOptions = computed(()=>sortLabels[filterForm.by])

const filterForm = reactive({
    deleted: false,
    by:'created_at',
    order:'desc'
})

watch(
    filterForm, debounce(()=>Inertia.get(
        route('realtor.index'),
        filterForm,
        {preserveState: true, preserveScroll: true},
    ), 1000)
)

</script>
