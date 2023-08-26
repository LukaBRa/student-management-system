<script>

import Sidebar from '../Components/Sidebar.vue';
import { useForm } from '@inertiajs/vue3';

export default{
    setup(){
        const form = useForm({
            name: '',
            email: '',
            adress: '',
            phoneNumber: '',
            checkedSubjects: []
        });

        return { form };
    },
    components: {
        Sidebar
    },
    props: [
        'user',
        'subjects',
        'errors'
    ],
    methods: {
        submitForm() {
            this.form.post('/dodaj-profesora');
        }
    }
}

</script>

<template>

<div class="container">

    <Sidebar :user="user" active="None"/>

    <div class="dashboard bg-light">

        <div class="professor-form">
            <div class="form-container">
                <h2>Dodaj novog profesora</h2>
                <form @submit.prevent="submitForm">
                    <div class="form-flex-container">
                        <div class="form-part">
                            <div class="form-input">
                                <label>Ime i prezime</label>
                                <input v-model="form.name" type="text" placeholder="Ime i prezime...">
                                <p class="error-text">{{ errors.name }}</p>
                            </div>
                            <div class="form-input">
                                <label>Email</label>
                                <input v-model="form.email" type="text" placeholder="Email adresa...">
                                <p class="error-text">{{ errors.email }}</p>
                            </div>
                            <div class="form-input">
                                <label>Adresa stanovanja</label>
                                <input v-model="form.adress" type="text" placeholder="Adresa...">
                                <p class="error-text">{{ errors.adress }}</p>
                            </div>
                            <div class="form-input">
                                <label>Broj telefona</label>
                                <input v-model="form.phoneNumber" type="text" placeholder="Broj telefona...">
                                <p class="error-text">{{ errors.phoneNumber }}</p>
                            </div>
                        </div>
                        <div class="form-part">
                            <div class="form-input">
                                <label>Predmeti</label>
                                <div class="checkbox-group">
                                    <div class="checkbox-input" v-for="subject in subjects" :key="subject.id">
                                        <input type="checkbox" :value="subject.id" v-model="form.checkedSubjects">
                                        {{ subject.subject_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Dodaj profesora">
                </form>
            </div>
        </div>

    </div>

</div>

</template>

<style>

.professor-form{
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-container{
    background-color: white;
    width: 35rem;
    padding: 2rem;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    border-radius: 5px;
}

.form-container h2{
    text-align: center;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid lightgray;
}

.form-container form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 2rem;
    width: 100%;
}

.form-flex-container{
    display: flex;
    gap: 1rem;
    justify-content: space-between;
}

.form-part{
    width: 45%;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-input{
    display: flex;
    flex-direction: column;
}

.form-input label{
    font-weight: 1.1rem;
}

.form-input input{
    padding: 0.5rem 0rem;
    border: none;
    border-bottom: 1px solid var(--black);
}

.form-input input:focus{
    outline: none;
}

.form-input input::placeholder{
    color: rgb(175, 175, 175);
    font-style: italic;
}

input[type="submit"]{
    background-color: var(--brown);
    border: 1px solid var(--brown);
    color: var(--white);
    padding: 0.5rem;
    font-size: 1.1rem;
    border-radius: 20px;
    margin-top: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

input[type="submit"]:hover{
    background-color: #94645e;
    border: 1px solid #94645e;
}

.checkbox-group{
    margin-top: 1rem;
    display: flex;
    flex-direction: column;
    gap: 00.5rem;
    height: 14rem;
    overflow: auto;
}

.error-text{
    color: rgb(252, 57, 57);
    margin-top: 0.2rem;
}


</style>