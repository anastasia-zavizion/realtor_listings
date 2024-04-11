<template>
    <div>
        <form @submit.prevent="handleSubmit">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-2">
                    <label class="label">Beds</label>
                    <input class="input" v-model.number="form.beds" type="text" />
                    <div class="inputError" v-if="form.errors.beds">{{form.errors.beds}}</div>
                </div>

                <div class="col-span-2">
                    <label class="label">Baths</label>
                    <input  class="input" v-model.number="form.baths" type="text" />
                    <div class="inputError" v-if="form.errors.baths">{{form.errors.baths}}</div>
                </div>

                <div class="col-span-2">
                    <label class="label">Area</label>
                    <input class="input" v-model.number="form.area" type="text" />
                    <div class="inputError" v-if="form.errors.area">{{form.errors.area}}</div>

                </div>

                <div class="col-span-4">
                    <label class="label">City</label>
                    <input  class="input" v-model="form.city" type="text" />
                    <div class="inputError" v-if="form.errors.city">{{form.errors.city}}</div>
                </div>

                <div class="col-span-2">
                    <label class="label">Post Code</label>
                    <input class="input" v-model="form.code" type="text" />
                    <div class="inputError" v-if="form.errors.code">{{form.errors.code}}</div>

                </div>

                <div class="col-span-2">
                    <label class="label">Street</label>
                    <input class="input"  v-model="form.street" type="text" />
                    <div class="inputError" v-if="form.errors.street">{{form.errors.street}}</div>
                </div>

                <div class="col-span-2">
                    <label class="label">Street Nr</label>
                    <input class=" input"  v-model="form.street_nr"  type="text" />
                    <div class="inputError" v-if="form.errors.street_nr">{{form.errors.street_nr}}</div>
                </div>

                <div class="col-span-2">
                    <label class="label">Price</label>
                    <input class="input" v-model="form.price" type="text" />
                    <div class="inputError" v-if="form.errors.price">{{form.errors.price}}</div>
                </div>

                <div class="col-span-6">
                    <button class="btn" type="submit">{{buttonText}}</button>
                </div>
            </div>
        </form>
    </div>


</template>

<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    methodName:String,
    buttonText:String,
    listing:Object
})

const form = useForm({
    beds: (props.listing && props.listing.beds) ?? 0,
    baths: (props.listing && props.listing.baths) ?? 0,
    area: (props.listing && props.listing.area) ?? 0,
    city: (props.listing && props.listing.city) ?? '',
    street: (props.listing && props.listing.street) ?? '',
    code: (props.listing && props.listing.code) ?? '',
    street_nr: (props.listing && props.listing.street_nr) ?? '',
    price: (props.listing && props.listing.price) ?? 0,
});

const handleSubmit = () => {
    if(props.methodName === 'create'){
        form.post(route('listing.store'));
    }else{
        form.put(route('realtor.listing.update',props.listing.id));
    }
};


</script>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>
