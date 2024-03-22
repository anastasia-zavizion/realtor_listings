<template>

    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div class="mb-2">
                <label for="email">E-mail</label>
                <input v-model="form.email" class="input" type="text" id="email" name="email">
                <div class="input-error">Errors...</div>
            </div>

            <div class="mb-2">
                <label for="email">Password</label>
                <input v-model="form.password" class="input" type="password" id="password" name="password">
                <div class="input-error">Errors...</div>
            </div>

            <div class="mb-2">
                <button class="btn w-full" type="submit">Login</button>
            </div>



        </div>
    </form>

</template>

<script setup>
import {useForm} from "@inertiajs/vue3";


const form = useForm({
    email:null,
    password:null,
});

const login = () => form.post(route('login.store'));


</script>

