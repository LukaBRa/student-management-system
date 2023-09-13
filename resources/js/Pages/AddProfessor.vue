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
            checkedSubject: null,
            checkedClasses: [],
        });

        return { form };
    },
    components: {
        Sidebar
    },
    props: [
        'user',
        'subjects',
        'classes',
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
                                        <input type="radio" :id="subject.id" name="subject_id" :value="subject.id" v-model="form.checkedSubject">
                                        <label :for="subject.id">{{ subject.subject_name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-part">
                            <div class="form-input">
                                <label>Odeljenja</label>
                                <div class="checkbox-group">
                                    <div class="checkbox-input" v-for="sclass in classes" :key="sclass.id">
                                        <input type="checkbox" :value="sclass.id" v-model="form.checkedClasses">
                                        <label>{{ sclass.class_name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="error-text">{{ errors.invalidSubject }}</p>
                    <p class="error-text">{{ errors.invalidClasses }}</p>
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
    width: 45rem;
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

.checkbox-input{
    display: flex;
    align-items: baseline;
    gap: 0.2rem;
}

.error-text{
    color: rgb(252, 57, 57);
    margin-top: 0.2rem;
}


</style>