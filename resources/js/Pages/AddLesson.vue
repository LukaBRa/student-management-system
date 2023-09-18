<script>

import axios from 'axios';
import Sidebar from '../Components/Sidebar.vue';
import Message from '../Components/Message.vue';
import { useForm } from '@inertiajs/vue3';

export default{
    data() {
        return {
            subjects: [],
            students: [],
            selectedSubject: '',
            selectedStudents: [],
            selectedClass: null,
            showMsg: false,
            message: '',
            lessonTitle: '',
            lessonDescription: '',
            lessonNumber: '',
            lessonDate: null,
            errorMsg: '',
        }
    },
    mounted() {
    },
    components: {
        Sidebar, Message
    },
    props: [
        'user',
        'classes',
        'errors'
    ],
    methods: {
        getData() {
            axios.get("http://localhost:8000/api/get-class-subjects/ " + this.selectedClass + "/professor/" + this.user.id)
            .then(response => {
                this.subjects = response.data
                console.log(this.subjects)
            })
            .catch(error => console.log(error))
            axios.get("http://localhost:8000/api/get-class-students/" + this.selectedClass)
            .then(response => {
                this.students = response.data
            })
            .catch(error => console.log(error))
        },  
        showMessage() {
            this.message = "Čas je uspešno upisan."
            this.showMsg = true;
            setTimeout(() => {
                this.message = "";
                this.showMsg = false;
            }, 3000);
        },  
        submitForm() {
            axios.post("/add-lesson", {
                professorId: this.user.id,
                selectedStudents: this.selectedStudents,
                classId: this.selectedClass,
                subjectId: this.selectedSubject,
                lessonTitle: this.lessonTitle,
                lessonDescription: this.lessonDescription,
                lessonNumber: this.lessonNumber,
                lessonDate: this.lessonDate
            })
            .then(response => {
                console.log(response)
                if(response.data == "success"){
                    this.showMessage();
                    this.errorMsg = "";
                    setTimeout(() => {
                        window.location.href = "http://localhost:8000/dnevnik";
                    }, 1000);
                }else if(response.data == "lessonNumberError"){
                    this.errorMsg = "Čas sa unetim rednim brojem već je upisan.";
                }else if(response.data == "error"){
                    this.errorMsg = "Popunite sva polja.";
                }
            }) 
            .catch(error => console.log(error));
        }
    }
}

</script>

<template>

<div class="container">

    <Sidebar :user="user" active="None"/>

    <Message v-if="showMsg" :message="message"/>

    <div class="dashboard bg-light">

        <div class="professor-form">
            <div class="form-container">
                <h2>Upis časova</h2>
                <p class="error-text">{{ errorMsg }}</p>
                <form @submit.prevent="submitForm">
                    <div class="form-flex-container">
                        <div class="form-part">
                            <div class="select-input">
                                    <label for="sclass">Odaberite odeljenje:</label>
                                    <select @change="getData" v-model="selectedClass" name="sclass" id="sclass">
                                        <option value="null" default>Odeljenje...</option>
                                        <option v-for="pClass in classes" :value="pClass.id">{{ pClass.class_name }}</option>
                                    </select>
                            </div>
                            <div v-if="selectedClass" class="add-form">
                                <div class="select-input">
                                <label for="subject">Odaberite predmet:</label>
                                <select v-model="selectedSubject" name="subject" id="subject">
                                    <option value="" default>Predmet...</option>
                                    <option v-for="subject in subjects" :value="subject.id">{{ subject.subject_name }}</option>
                                </select>
                            </div>
                                <div class="form-input">
                                    <label for="">Naziv teme</label>
                                    <input v-model="lessonTitle" type="text" placeholder="Naziv teme...">
                                </div>
                                <div class="form-input">
                                    <label for="">Opis časa</label>
                                    <select v-model="lessonDescription">
                                        <option value="" default>Opis...</option>
                                        <option value="Nova lekcija">Nova lekcija</option>
                                        <option value="Vežbanje">Vežbanje</option>
                                        <option value="Sistematizacija">Sistematizacija</option>
                                        <option value="Kontrolni">Kontrolni</option>
                                        <option value="Pismeni">Pismeni</option>
                                    </select>
                                </div>
                                <div class="form-input">
                                    <label for="">Redni broj časa</label>
                                    <select v-model="lessonNumber">
                                        <option value="" default>Redni broj...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="form-inout">
                                    <label>Datum</label>
                                    <input v-model="lessonDate" class="date-picker" type="date">
                                </div>
                                
                        </div>
                    </div>
                    <div v-if="selectedClass" class="form-part">
                        <label>Učenici</label>
                        <div class="checkbox-group">
                            <div v-for="student in students" class="checkbox-input">
                                <input v-model="selectedStudents" :id="student.id" name="checkedStudents" type="checkbox" :value="student.id">
                                <label :for="student.id">{{ student.name }}</label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <input type="submit" value="Upiši čas">
                </form>
            </div>
        </div>

    </div>

</div>

</template>

<style scoped>

.professor-form{
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
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

.form-input select{
    border: 1px solid white;
    border-bottom: 1px solid var(--black);
    padding: 0.2rem 0rem;
    margin-top: 0.5rem;
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
    text-align: center;
}

.checkbox-input{
    display: flex;
    gap: 0.4rem;
}

.select-input{
    display: flex;
    align-items: center;
    gap: 1rem;
}

select{
    padding: 0.5rem;
}

.add-form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.add-form.activeAditionalInputs{
    display: flex;
}

label{
    font-weight: bold;
}

.date-picker{
    padding: 0.5rem;
    margin-left: 1rem;
}

</style>