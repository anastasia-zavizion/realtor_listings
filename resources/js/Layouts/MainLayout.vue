<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg text-indigo-600  font-bold text-centered">
                    <Link class="link" :href="route('listing.index')">Home</Link>
                </div>

                <div>
                    <Link class="link" :href="route('listing.index')">Listing</Link>
                </div>
                <div>
                    <Link class="link btn" :href="route('listing.create')">+ New Listing</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <div v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3">
            {{ successMessage }}
        </div>

        <slot>
        </slot>
    </main>
</template>

<script setup>

import {Link, usePage} from '@inertiajs/vue3';

import {ref, computed} from 'vue';

const page = usePage();

const successMessage = computed(() => {
    return page.props.flash.success;
});

</script>
