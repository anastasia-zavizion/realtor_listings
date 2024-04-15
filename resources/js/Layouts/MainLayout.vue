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
                </div>
                <div class="flex gap-4 items-center" v-if="user">
                    <Link  :href="route('notification.index')" v-if="notificationCount" class="text-gray-500 relative pr-2 py-2 cursor-pointer">
                        🔔<div class="absolute right-0 top-0 w-5 h-5 bg-red-700 text-white font-medium border border-white rounded-full text-xs text-center">{{notificationCount}}</div>
                    </Link>

                   <div  v-if="user.email_verified_at !== null" class="text-sm text-gray-500">  <Link class="link btn" :href="route('realtor.listing.index')">{{user.name}}</Link> </div>
                    <Link v-if="user.email_verified_at" class="link btn" :href="route('realtor.listing.create')">+ New Listing</Link>
                    <div>

                        <Link class="link btn" method="delete" as="button" :href="route('logout')">Logout</Link>


<!--                        <form action="">
                            <Link class="link btn" :href="route('logout')">Logout</Link>
                        </form>-->

                    </div>
                </div>
                <div class="flex gap-4 items-center" v-else>
                    <Link class="link btn" :href="route('login')">Sign-In</Link>
                    <Link class="link btn" :href="route('user-account.create')">Register</Link>
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

const user = computed(() => {
    return page.props.user;
});

console.log(user);


const notificationCount = computed(() => {
    return Math.min(page.props.user.notificationCount,9);
});

</script>
