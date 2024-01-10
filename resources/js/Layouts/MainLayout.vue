<template>
    <Link class="link" href="/listing">Listing</Link>
    <Link class="link" href="/listing/create">Create</Link>

   <div v-if="successMessage" class="success">
        {{successMessage}}
    </div>


    <slot>
    </slot>
</template>

<script setup>

import {Link, usePage} from '@inertiajs/vue3';

import {ref, computed} from 'vue';

//page.props.flash.success
const page = usePage();

const successMessage = computed(()=>{
    return page.props.flash.success;
});

</script>

<style scoped>
.success{
    background-color: green;
    color: white;
}
.link{
    margin-right: 10px;
}

</style>
