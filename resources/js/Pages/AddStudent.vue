<script>

import Sidebar from '../Components/Sidebar.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Sidebar
    },
    setup() {
        const form = useForm({
            studentName: '',
            adress: '',
            studentPhoneNumber: '',
            parentsEmail: '',
            motherName: '',
            fatherName: '',
            motherPhoneNumber: '',
            fatherPhoneNumber: '',
            subjectsChecked: [],
            classChecked: '',
        });

        return { form };
    },
    props: [
        'subjects',
        'classes',
        'errors'
    ],
    methods: {
        submitForm() {
            this.form.post('/dodaj-studenta');
        }
    },
    mounted() {
        console.log(this.classes)
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <div class="dashboard bg-light">

        <div class="professor-form">
            <div class="form-container c-width">
                <h2>Dodaj novog učenika</h2>
            
                <form @submit.prevent="submitForm">
                    <div class="form-flex-container">
                        <div class="form-part">
                            <div class="form-input">
                            <label>Ime i prezime đaka</label>
                            <input v-model="form.studentName" type="text" placeholder="Ime i prezime...">
                            <p class="error-text">{{ errors.studentName }}</p>   
                        </div>
                        <div class="form-input">
                            <label>Adresa stanovanja</label>
                            <input v-model="form.adress" type="text" placeholder="Adresa...">
                            <p class="error-text">{{ errors.adress }}</p>
                        </div>
                        <div class="form-input">
                            <label>Broj telefona</label>
                            <input v-model="form.studentPhoneNumber" type="text" placeholder="Broj telefona...">
                            <p class="error-text">{{ errors.studentPhoneNumber }}</p>
                        </div>
                        <div class="form-input">
                            <label>Email roditelja</label>
                            <input v-model="form.parentsEmail" type="text" placeholder="Email adresa...">
                            <p class="error-text">{{ errors.parentsEmail }}</p>
                        </div>
                        <div class="form-input">
                            <label>Ime i prezime majke</label>
                            <input v-model="form.motherName" type="text" placeholder="Ime i prezime majke...">
                            <p class="error-text">{{ errors.motherName }}</p>
                        </div>
                        <div class="form-input">
                            <label>Ime i prezime oca</label>
                            <input v-model="form.fatherName" type="text" placeholder="Ime i prezime oca...">
                            <p class="error-text">{{ errors.fatherName }}</p>
                        </div>
                        <div class="form-input">
                            <label>Broj telefona majke: </label>
                            <input v-model="form.motherPhoneNumber" type="text" placeholder="Broj telefona majke...">
                            <p class="error-text">{{ errors.motherPhoneNumber }}</p>
                        </div>
                        <div class="form-input">
                            <label>Broj telefona oca: </label>
                            <input v-model="form.fatherPhoneNumber" type="text" placeholder="Broj telefona oca...">
                            <p class="error-text">{{ errors.fatherPhoneNumber }}</p>
                        </div>
                        </div>
                        <div class="form-part">
                            <div class="form-input">
                                <label>Predmeti</label>
                                <div class="checkbox-group h-20">
                                    <div class="checkbox-input" v-for="subject in subjects" :key="subject.id">
                                        <input type="checkbox" :value="subject.id" v-model="form.subjectsChecked">
                                        {{ subject.subject_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-part">
                            <div class="form-input">
                                <label>Odeljenja</label>
                                <div class="checkbox-group h-20">
                                    <div class="checkbox-input" v-for="cl in classes" :key="cl.id">
                                        <input type="radio" :value="cl.id" v-model="form.classChecked">
                                        {{ cl.class_name }}
                                    </div>
                                </div>
                                <p class="error-text">{{ errors.classChecked }}</p>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Dodaj učenika">
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
    gap: 3rem;
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
    gap: 0.5rem;
    height: 14rem;
    overflow: auto;
}

.h-20{
    height: 30rem;
}

.c-width{
    width: 50rem;
}

.error-text{
    color: rgb(252, 57, 57);
    margin-top: 0.2rem;
}

</style>