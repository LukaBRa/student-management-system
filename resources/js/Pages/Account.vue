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

        const consultationForm = useForm({
            dayOfWeek: '',
            fromHours: '',
            fromMinutes: '',
            toHours: '',
            toMinutes: '',
            roomName: '',
        });

        return { form, consultationForm };
    },
    methods: {
        submitForm() {
            this.form.post("/change-password");
        },
        submitConsultationsForm(){
            this.consultationForm.post("/add-consultation-appointment");
        }
    },
    computed: {
        isProfessor(){
            return this.user.type_id == 2;
        }
    }
}


</script>

<template>

<div class="container">
    
    <Sidebar :user="user" active="Nalog"/>

    <Message v-if="showMessage" :message="message"/>

    <div class="dashboard bg-light">

        <div class="flex-container">
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

        <div v-if="isProfessor" class="change-password-form">
            <h2>Dodajte termin za konsultacije</h2>
            <form @submit.prevent="submitConsultationsForm">
                <div class="form-input">
                    <label for="dayOfWeek">Izaberite dan</label>
                    <select id="dayOfWeek" v-model="consultationForm.dayOfWeek">
                        <option value="" default>Dan...</option>
                        <option value="Ponedeljak">Ponedeljak</option>
                        <option value="Utorak">Utorak</option>
                        <option value="Sreda">Sreda</option>
                        <option value="Četvrtak">Četvrtak</option>
                        <option value="Petak">Petak</option>
                    </select>
                </div>
                <div class="form-input">
                    <label for="appointment">Odaberite termin</label>
                    <div class="appointment-input">
                        <label for="fromDayofWeek">Od</label>
                        <select id="fromDayofWeek" v-model="consultationForm.fromHours">
                            <option value="" default>Časovi...</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                        </select>
                        -
                        <select v-model="consultationForm.fromMinutes">
                            <option value="" default>Minuti...</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                            <option value="55">55</option>
                        </select>
                    </div>
                    <div class="appointment-input">
                        <label for="toDayofWeek">Do</label>
                        <select id="toDayofWeek" v-model="consultationForm.toHours">
                            <option value="" default>Časovi...</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                        -
                        <select v-model="consultationForm.toMinutes">
                            <option value="" default>Minuti...</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                            <option value="55">55</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label id="room-label" for="roomName">Unesite naziv kabineta</label>
                        <input type="text" id="roomName" placeholder="Naziv kabineta..." v-model="consultationForm.roomName">
                    </div>
                    <p class="error-msg">{{ errors.errorMsg }}</p>
                </div>
                <input type="submit" value="Dodajte termin">
            </form>
        </div>
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
    height: max-content;
}

.flex-container{
    display: flex;
}

#dayOfWeek{
    padding: 0.5rem;
    margin-top: 0.5rem;
    width: max-content;
}

#room-label{
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.appointment-input{
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.appointment-input select {
    margin-top: 0.5rem;
    padding: 0.5rem;
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