<script>

import { useForm } from '@inertiajs/vue3';
import Sidebar from '../Components/Sidebar.vue';
import Message from '../Components/Message.vue';

export default {
    data() {
        return {
            showMessage: false,
            message: '',
        }
    },
    components: {
        Sidebar, Message
    },
    props: [
        'user',
        'errors'
    ],
    setup(){

        const form = useForm({
            newPassword: '',
            confirmedPassword: ''
        });

        return { form };
    },
    methods: {
        submitForm() {
            this.form.post("/change-password");
        }
    },
}


</script>

<template>

<div class="container">
    
    <Sidebar :user="user"/>

    <Message v-if="showMessage" :message="message"/>

    <div class="dashboard bg-light">

        <div class="change-password-form">
            <h2>Promena lozinke</h2>
            <form @submit.prevent="submitForm">
                <div class="form-input">
                    <label for="new-password">Nova lozinka</label>
                    <input v-model="form.newPassword" type="password" id="new-password" placeholder="Lozinka...">
                    <p class="error-msg">{{ errors.newPassword }}</p>
                </div>
                <div class="form-input">
                    <label for="confirm-password">Potvrdi lozinku</label>
                    <input v-model="form.confirmedPassword" type="password" id="confirm-password" placeholder="Potvrdi lozinku">
                    <p class="error-msg">{{ errors.confirmedPassword }}</p>
                    <p class="error-msg">{{ errors.notMatching }}</p>
                </div>
                <input type="submit" value="Izmeni lozinku">
            </form>
        </div>

    </div>
    
</div>

</template>

<style scoped>

.change-password-form{
    background-color: white;
    width: max-content;
    padding: 2rem;
    margin-inline: auto;
    margin-top: 2rem;
}

h2{
    border-bottom: 1px solid lightgray;
    padding-bottom: 0.5rem;
    text-align: center;
    margin-bottom: 2rem;
}

form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-input{
    display: flex;
    flex-direction: column;
}

.form-input input{
    padding: 0.3rem 0rem;
    background: none;
    border: none;
    border-bottom: 1px solid var(--black);
    margin-bottom: 0.5rem;
}

.form-input input:focus{
    outline: none;
}

.form-input input::placeholder{
    color: rgb(167, 167, 167);
    font-style: italic;
}

input[type="submit"]{
    margin-top: 1rem;
    background-color: var(--brown);
    color: white;
    border: 1px solid var(--brown);
    padding: 0.5rem;
    font-size: 1.1rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
}

input[type="submit"]:hover{
    background-color: #966560;
    border: 1px solid #966560;
}

.error-msg{
    color: rgb(248, 116, 116);
}

</style>