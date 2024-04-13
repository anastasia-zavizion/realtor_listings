<template>
    gtg
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
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed':listing.deleted_at}">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-25':listing.deleted_at}">
                    <div class="xl:flex items-center gap-2">
                        <Price class="text-2xl font-medium" :price="listing.price"/>
                        <ListingSpace :listing="listing"/>
                    </div>

                    <ListingAddress :listing="listing"></ListingAddress>
                </div>

                <section>
                    <div class="flex items-center gap-1 text-gray-600">


                        <Link class="btnSmall" :href="route('realtor.listing.edit',{listing:listing.id})">Edit
                        </Link>

                        <Link as="a" target="_blank" class="btnSmall" :href="route('listing.show', listing.id)" >Preview</Link>


                        <Link v-if="!listing.deleted_at" class="btnSmall" as="button" method="DELETE" :href="route('realtor.listing.destroy',{listing:listing.id})">Delete
                        </Link>

                        <Link v-else class="btnSmall" as="button" method="PUT" :href="route('realtor.listing.restore',{listing:listing.id})">Restore
                        </Link>

                    </div>

                    <div class="mt-2">
                        <Link  class="btn-outline w-full block text-center" :href="route('realtor.listing.image.create', listing.id)">Images ({{listing.images_count}})</Link>

                    </div>
                </section>

            </div>
        </Box>
    </section>

    <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="listings.links"/>
    </div>

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
import Pagination from "../../Components/UI/Pagination";

const props = defineProps({
    listings:Array,
    filters:Array
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
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc'
})

watch(
    filterForm, debounce(()=>Inertia.get(
        route('realtor.listing.index'),
        filterForm,
        {preserveState: true, preserveScroll: true},
    ), 1000)
)

</script>
