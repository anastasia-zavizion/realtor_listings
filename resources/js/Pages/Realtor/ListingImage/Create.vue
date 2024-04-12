<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
          <section class="flex items-center gap-2 mt-4 mb-4">
              <input class="border file:cursor-pointer file:hover:bg-gray-200 rounded-md file:px-4 file:py-2 border-gray-200 file:border-0 file:bg-gray-100 file:font-medium" @input="addFiles" type="file" multiple />
              <button :disabled="!filesExists" class="btnSmall disabled:opacity-25" type="submit">Send</button>
              <button :disabled="!filesExists" @click="reset" class="btnSmall disabled:opacity-25" type="button">Reset</button>
          </section>
        </form>
    </Box>

</template>

<script setup>
import Box from "../../../Components/UI/Box";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    listing:Object
})

const form = useForm({
    images:[]
})

const filesExists = computed(()=>{
    return form.images.length > 0;
})

const upload = () =>{
    form.post(route('realtor.listing.image.store', {listing:props.listing.id}), {
        onSuccess:()=>{
            reset();
        }
    });
}

const addFiles = (event)=>{
    for(const image of event.target.files){
        form.images.push(image);
    }
}

const reset = ()=>{
    form.reset('images');
}

</script>


