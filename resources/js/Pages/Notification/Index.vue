<template>
    <Box>
        <template #header>Your notifications</template>
        <section v-if="notifications.data.length" class="text-gray-700 mb-4">
            <div :key="notification.id" v-for="notification in notifications.data"
                 class="border-b border-gray-200 py-4 justify-between flex items-center">
                <div>
                    <span v-if="notification.type === 'App\\Notifications\\OfferMade'">Offer
                        <Price :price="notification.data.amount"/>
                        for <Link class="text-indigo-600" :href="route('realtor.listing.show',notification.data.listing_id)">
                            listing</Link></span> was made
                </div>
                <div>
                    <button class="btn-outline uppercase" v-if="!notification.read_at">Mark as read</button>
                </div>

            </div>
        </section>

        <Pagination :links="notifications.links"/>
    </Box>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';

import Box from "../../Components/UI/Box";
import Pagination from "../../Components/UI/Pagination";
import Price from "../../Components/Price";

defineProps({
    notifications: Array
})
</script>
