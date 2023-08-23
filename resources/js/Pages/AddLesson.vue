<script>

import axios from 'axios';
import Sidebar from '../Components/Sidebar.vue';
import Message from '../Components/Message.vue';
import { useForm } from '@inertiajs/vue3';

export default{
    data() {
        return {
            students: [],
            userId: '',
            classId: '',
            subjectId: '',
            lessonTitle: '',
            lessonDescription: '',
            checkedStudents: [],
            message: '',
            showMsg: false,
            errorMsg: '',
        }
    },
    mounted() {
        this.userId = this.user.id;
    },
    components: {
        Sidebar, Message
    },
    props: [
        'user',
        'subjects',
        'classes',
        'errors'
    ],
    methods: {
        showStudents() {
            this.students = [];
            if(this.classId == -1){
                //
            }else{
                axios.get("http://localhost:8000/api/get-class-students/" + this.classId)
                .then(response => {
                    this.students = response.data;
                })
                .catch(error => console.log(error))
            }
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
                userId: this.user.id,
                subjectId: this.subjectId,
                classId: this.classId,
                lessonTitle: this.lessonTitle,
                lessonDescription: this.lessonDescription,
                checkedStudents: this.checkedStudents
            })
            .then(response => {
                if(response.data == "success"){
                    this.showMessage();
                    this.errorMsg = "";
                }else{
                    this.errorMsg = "Popunite sva polja.";
                }
                console.log(response);
            }) 
            .catch(error => console.log(error));
        }
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <Message v-if="showMsg" :message="message"/>

    <div class="dashboard bg-light">

        <div class="professor-form">
            <div class="form-container">
                <h2>Upis časova</h2>
                <p class="error-text">{{ errorMsg }}</p>
                <form @submit.prevent="submitForm">
                    <div class="form-flex-container">
                        <div class="form-part">
                            <div class="form-input">
                                <label>Naziv teme</label>
                                <input v-model="lessonTitle" type="text" placeholder="Tema...">
                                <p class="error-text">{{ errors.lessonTitle }}</p>
                            </div>
                            <div class="form-input">
                                <label>Odaberi predmet</label>
                                <select v-model="subjectId">
                                    <option value="">Predmet...</option>
                                    <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.subject_name }}</option>
                                </select>
                                <p class="error-text">{{ errors.subjectId }}</p>
                            </div>
                            <div class="form-input">
                                <label>Opis časa</label>
                                <select v-model="lessonDescription">
                                    <option value="">Opis...</option>
                                    <option>Nova lekcija</option>
                                    <option>Vežbanje</option>
                                    <option>Sistematizacija</option>
                                    <option>Kontrolni</option>
                                    <option>Pismeni</option>
                                </select>
                                <p class="error-text">{{ errors.lessonDescription }}</p>
                            </div>
                            <div class="form-input">
                                <label>Odaberi odeljenje</label>
                                <select @change="showStudents" v-model="classId">
                                    <option value="">Odeljenje...</option>
                                    <option v-for="sclass in classes" :key="sclass.id" :value="sclass.id ">{{ sclass.class_name }}</option>
                                </select>
                                <p class="error-text">{{ errors.classId }}</p>
                            </div>
                        </div>
                        <div class="form-part">
                            <div class="form-input">
                                <label>Odsutni učenici</label>
                                <div class="checkbox-group">
                                    <div class="checkbox-input" v-for="student in students" :key="student.id">
                                        <input v-model="checkedStudents" name="absentStudent" type="checkbox" :value="student.id">
                                        <label>{{ student.name }}</label>
                                    </div>
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
}

.checkbox-input{
    display: flex;
    gap: 0.4rem;
}


</style>