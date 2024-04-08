<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div class="mb-2">
                <label for="email">Name</label>
                <input v-model="form.name" class="input" type="text" id="name" name="name">
                <div v-if="form.errors.name" class="inputError">{{form.errors.name}}</div>
            </div>

            <div class="mb-2">
                <label for="email">E-mail</label>
                <input v-model="form.email" class="input" type="text" id="email" name="email">
                <div v-if="form.errors.email" class="inputError">{{form.errors.email}}</div>
            </div>

            <div class="mb-2">
                <label for="email">Password</label>
                <input v-model="form.password" class="input" type="password" id="password" name="password">
                <div v-if="form.errors.password" class="inputError">{{form.errors.password}}</div>
            </div>

            <div class="mb-2">
                <label for="email">Password confirmation</label>
                <input v-model="form.password_confirmation" class="input" type="password" id="password_confirmation" name="password_confirmation">
                <div v-if="form.errors.password_confirmation" class="inputError">{{form.errors.password_confirmation}}</div>
            </div>

            <div class="mb-2">
                <button class="btn w-full" type="submit">Create Account</button>
            </div>
        </div>
    </form>

</template>

<script setup>
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    email:null,
    name:null,
    password:null,
    password_confirmation:null,
});

const register = () => form.post(route('user-account.store'));


</script>

