<script>

import Sidebar from '../Components/Sidebar.vue';
import Message from '../Components/Message.vue';
import AddSubjectProfessor from '../Components/AddSubjectProfessor.vue';
import Appointments from '../Components/Appointments.vue';

export default{
    data() {
        return {
            showMessage: false,
            msgText: '',
            showForm: false,
        }
    },
    components: {
        Sidebar, Message, AddSubjectProfessor, Appointments
    },
    props: [
        'professor',
        'professorSubjects',
        'allSubjects',
        'user',
        'prClassesSubjects',
        'allClasses',
        'appointments'
    ],
    methods: {
        toggleForm(){
            this.showForm = !this.showForm
        },
        handleSubjectAdded() {
            this.msgText = "Uspešno ste dodali predmet profesoru.";
            this.showMessage = true;
            this.showForm = false;
            setTimeout(() => {
                window.location.href = "http://localhost:8000/profesor/" + this.professor.id;
            }, 1000);
        },
        getClasses(subjectId){
            return this.prClassesSubjects.filter(el => el.subject_id == subjectId);
        }
    },
    computed: {
        adminRule() {
            return this.user.type_id == 1;
        },
        professorRule() {
            return this.user.type_id == 2;
        },
    }
}


</script>

<template>

<div class="container">

    <Sidebar :user="user" active="None"/>

    <Message v-if="showMessage" :message="msgText"/>

    <AddSubjectProfessor v-if="showForm" :allClasses="allClasses" :subjects="allSubjects" :professorId="professor.id" @toggleForm="toggleForm" @success="handleSubjectAdded"/>

    <div class="dashboard bg-light">

        <div class="student-container">

            <div class="student-personal-info">
                <i class="fa-solid fa-user-tie"></i>
                <p class="student-name">{{ professor.name }}</p>
                <div class="user-btn-group">
                    <button v-if="adminRule" @click="toggleForm">Dodaj predmet</button>
                </div>
                <div class="app-section">
                    <h3>Konsultacije</h3>
                    <Appointments @deleteAppointment=""  :appointments="appointments"/>
                </div>
            </div>

            <div class="proffesor-info">
                <div class="student-data">
                    <div class="data-box">
                        <p class="data-box-accent">Adresa:</p>
                        <p>{{ professor.adress }}</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj telefona:</p>
                        <p>{{ professor.phone_number }}</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Email adresa:</p>
                        <p>{{ professor.email }}</p>
                    </div>
                    <div class="table-box">
                        <p class="data-box-accent data-box-flex">Predmeti:</p>
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th>Šifra predmeta</th>
                                    <th>Naziv predmeta</th>
                                    <th>Odeljenja</th>
                                </tr>
                                <tr v-for="subject in professorSubjects" :key="subject.id">
                                    <td>{{ subject.subject_code }}</td>
                                    <td>{{ subject.subject_name }}</td>
                                    <td>
                                        <p v-for="className in getClasses(subject.id)">{{ className.class_name }}</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</template>

<style>

.student-container{
    width: 100%;
    height: 95vh;
    background-color: white;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: flex;
}

.student-personal-info{
    width: 40%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.student-personal-info i {
    font-size: 10rem;
    padding: 2rem 0rem;
}

.student-name{
    font-size: 1.5rem;
    font-weight: bold;
}

.student-data{
    margin-top: 2rem;
    width: 90%;
    height: 94%;
    overflow: auto;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}


.data-box{
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.data-box-accent{
    font-weight: bold;
}

.table-box{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    width: 100%;
    
}

.table-container{
    height: max-content;
    overflow: auto;
}

table{
    width: 100%;
    border: 1px solid var(--brown);
}

td, th{
    border: 1px solid var(--brown);
    padding: 0.5rem;
    text-align: center;
}

.data-box-flex{
    display: flex;
    justify-content: space-between;
}

.proffesor-info{
    width: 50%;
}

.user-btn-group{
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
}

.user-btn-group button{
    background-color: var(--brown);
    padding: 0.5rem;
    border: 1px solid var(--brown);
    cursor: pointer;
    color: white;
    transition: all 0.3s ease;
}

.user-btn-group button:hover{
    background-color: #966560;
    border: 1px solid #966560;
}

.app-section{
    margin-top: 1rem;
    height: 24rem;
    width: 80%;
    overflow: auto;
}

.app-section h3{
    margin-bottom: 0.5rem;
}

.app-section table{
    width: 100%;
}

</style>