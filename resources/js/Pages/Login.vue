<script>

import { useForm } from '@inertiajs/vue3';

export default {
    props: [
        'errors',
        'admin'
    ],
    setup(){
        const form = useForm({
            name: '',
            email: '',
            password: '',
            remember: false,
        });

        return { form };
    },
    methods: {
        submitForm() {
            this.form.post('/login');
        }
    }
}

</script>

<template>

<div class="container bg-light">

    <div class="login-background">
            <div class="login-logo">
                <i class="fa-solid fa-graduation-cap text-light"></i>
                <h2 class="text-light">eDNEVNIK</h2>
            </div>
    </div>

    <div class="login-form">
        <i class="fa-solid fa-user-group text-dark"></i>
        <h2 class="text-dark">PRIJAVA</h2>
        <p class="text-dark">Dobrodošli na elektronski dnevnik</p>
        <p class="error-message">{{ errors.invalidData }}</p>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="email" class="text-dark">Email adresa</label>
                <div class="form-input">
                    <i class="fa-solid fa-envelope text-dark"></i>
                    <input v-model="form.email" class="bg-light" type="text" name="email" id="email" placeholder="Vaša email adresa...">
                </div>
                <p class="error-message">{{ errors.email }}</p>
            </div>
            <div class="form-group">
                <label for="password" class="text-dark">Lozinka</label>
                <div class="form-input">
                    <i class="fa-solid fa-key text-dark"></i>
                    <input v-model="form.password" class="bg-light" type="password" name="password" id="password" placeholder="Vaša lozinka...">
                </div>
                <p class="error-message">{{ errors.password }}</p>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" v-model="form.remember">Zapamti me?
            </div>
            <input class="bg-brown text-light" type="submit" value="Prijavi se">
        </form>
    </div>

</div>

</template>

<style>

.login-background{
    background-image: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('/images/login-background.jpg');
    width: 50%;
    height: 100%;
    clip-path: circle(90% at 4% 50%);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-logo{
    color: white;
    font-size: 3rem;
    text-align: center;
}

.login-logo i {
    font-size: 7rem;
    margin-bottom: 1rem;
}

label{
    font-weight: bold;
}

.login-form{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 50%;
    height: 100%;
    gap: 1rem;
}

.login-form i{
    font-size: 4rem;
}

form{
    display: flex;
    flex-direction: column;
    gap: 1.7rem;
    margin-top: 1rem;
    width: 40%;
}

form .form-group{
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
}

.form-input {
    border-bottom: 1px solid black;
    padding-bottom: 0.3rem;
}

.form-input i{
    font-size: 1.2rem;
}

.form-input input{
    outline: none;
    padding: 0.3rem;
    border: none;
    width: 85%;
    margin-left: 0.8rem;
}

input[type='submit'] {
    padding: 0.4rem;
    font-size: 1.1rem;
    border-radius: 20px;
    margin-top: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type='submit']:hover {
    background-color: #96615b;
}

.error-message{
    color: rgb(243, 75, 75);
}

.form-checkbox{
    display: flex;
    gap: 0.5rem;
}


</style>