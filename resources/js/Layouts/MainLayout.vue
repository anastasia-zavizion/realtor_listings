<template>
    <Link href="/">Index</Link>
    <Link href="/hello">Show page</Link>

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

.errors{
    background-color: red;
    color: white;
}
</style>
