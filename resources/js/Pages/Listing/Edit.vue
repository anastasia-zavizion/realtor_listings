<template>
    <ListingForm methodName="update"  :listing="listing" buttonText="Update"></ListingForm>
</template>

<style scoped>

</style>


<script setup>
import ListingForm from "../../Components/ListingForm";

import {reactive} from 'vue';
import {Inertia} from '@inertiajs/inertia';

const props = defineProps({
    listing:Object
});

</script>


