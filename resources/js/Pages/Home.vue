<script>

import Sidebar from '../Components/Sidebar.vue';
import StudentSubject from '../Components/StudentSubject.vue';
import Activity from '../Components/Activity.vue';
import AddMarkForm from '../Components/AddMarkForm.vue';
import Message from '../Components/Message.vue';
import AddActivity from '../Components/AddActivity.vue';
import ConfirmMark from '../Components/ConfirmMark.vue';

export default {
    data() {
        return {
            studActivities: [],
            toggledTab: 'marks',
            showAddMarkForm: false,
            canAddMarksSubjects: [],
            message: '',
            showMessage: false,
            showAddActivityForm: false,
            showConfirmMark: false,
            formSubjName: '',
            formSubjId: '',
            formAverageScore: null,
            formStudentId: null,
        }
    },
    components: {
        Sidebar, StudentSubject, Activity, AddMarkForm, Message, AddActivity, ConfirmMark
    },
    props: [
        'student',
        'user',
        'subjects',
        'studentClass',
        'numberOfAbsences',
        'activities',
        'parents',
        'finalMarks',
        'professorsSubjects',
        'finalScore',
        'professors'
    ],
    methods:{
        toggleMarksTab() {
            this.toggledTab = "marks";
        },
        toggleActivitiesTab() {
            this.toggledTab = "activities";
        },
        toggleAddMarkForm() {
            this.showAddMarkForm = !this.showAddMarkForm;
        },
        toggleAddActivitiesForm() {
            this.showAddActivityForm = !this.showAddActivityForm;
        },
        toggleConfirmMark() {
            this.showConfirmMark = !this.showConfirmMark;
        },
        toggleConfirmMarkData(subjectName, subjectId, averageScore, studentId) {
            this.formSubjName = subjectName;
            this.formSubjId = subjectId;
            this.formAverageScore = averageScore;
            this.formStudentId = studentId
            this.showConfirmMark = !this.showConfirmMark;
        },
        markAddedHandle() {
            this.message = "Uspešno je dodata ocena."
            this.showMessage = true;
            this.showAddMarkForm = false;
            setTimeout(() => {
                this.showMessage = false;
                this.message = "";
                window.location.href = "http://localhost:8000/ucenik/" + this.student.id;
            }, 1000);
        },
        activityAddedHandle(activity) {
            this.studActivities.push(activity);
            this.message = "Uspešno je upisana aktivnost.";
            this.showMessage = true;
            this.showAddActivityForm = false;
            setTimeout(() => {
                this.showMessage = false;
                this.message = "";
            }, 3000);
        },
        handleMarkDeleted(){
            this.message = "Uspešno je poništena zaključna ocena."
            this.showMessage = true;
            this.showAddMarkForm = false;
            setTimeout(() => {
                this.showMessage = false;
                this.message = "";
                window.location.href = "http://localhost:8000/ucenik/" + this.student.id;
            }, 1000);
        },
        handleSuccessfullConfirmation() {
            this.toggleConfirmMark();
            this.message = "Uspešno je Zaključena ocena."
            this.showMessage = true;
            this.showAddActivityForm = false;
            setTimeout(() => {
                this.showMessage = false;
                this.message = "";
                window.location.href = "http://localhost:8000/ucenik/" + this.student.id;
            }, 1000);
        }
    },
    computed: {
        showActivitiesTab() {
            return this.toggledTab == "activities"
        },
        showMarksTab() {
            return this.toggledTab == "marks"
        },
        professorsRule() {
            return this.user.type_id == 2;
        },
        isParent() {
            return this.user.type_id == 3;
        }
    },
    mounted() {
        this.studActivities = this.activities;
    }
}

</script>

<template>

<div class="container">

    <Sidebar :user="user" active="Početna"/>

    <Message v-if="showMessage" :message="message"/>

    <AddMarkForm v-if="showAddMarkForm" @success="markAddedHandle" @toggleAddMarkForm="toggleAddMarkForm" :canAddMarkSubjects="professorsSubjects" :professorId="user.id" :studentId="student.id"/>
    <AddActivity v-if="showAddActivityForm" @toggleAddActivitiesForm="toggleAddActivitiesForm" :studentId="student.id" @success="activityAddedHandle"/>
    <ConfirmMark v-if="showConfirmMark" @success="handleSuccessfullConfirmation" @toggleConfirmMark="toggleConfirmMark" :formStudentId="formStudentId" :user="user"  :formSubjName="formSubjName" :formSubjId="formSubjId" :formAverageScore="formAverageScore" />

    <div class="dashboard bg-light">

        <div class="student-container">

            <div class="student-personal-info">
                <i class="fa-solid fa-user-graduate"></i>
                <p class="student-name">{{ student.name }}</p>
                <div class="student-data">
                    <div class="data-box">
                        <p class="data-box-accent">Odeljenje:</p>
                        <p>{{ studentClass.class_name }}</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj izostanaka:</p>
                        <p>{{ numberOfAbsences }}</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Prosek: :</p>
                        <p>{{ finalScore }}</p>
                    </div>
                    <div class="appointments">
                        <h3>Konsultacije</h3>
                        <div class="consultations">
                            <table>
                                <tr>
                                    <th>Profesor</th>
                                    <th>Predmeti</th>
                                    <th>Termini</th><!-- 
                                    <th>Kabineti</th> -->
                                </tr>
                                <tr v-for="p in professors">
                                    <td>{{ p.name }}</td>
                                    <td>
                                        <tr v-for="subj in p.subjects"><td>{{ subj.subject_name }}</td></tr>
                                    </td>
                                    <td>
                                        <tr class="small-text" v-for="con in p.consultations"><td>{{ con.consultation_appointment }}</td></tr>
                                    </td>
                                    <!-- <td>
                                        <tr v-for="con in p.consultations"><td>{{ con.room_name }}</td></tr>
                                    </td> -->
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-statistics">

                <div class="student-tabs">
                    <button @click="toggleMarksTab" :class="{ 'active-btn': showMarksTab}">Ocene</button>
                    <button @click="toggleActivitiesTab" :class="{ 'active-btn': showActivitiesTab}">Aktivnosti</button>
                </div>

                <div class="marks-tab" v-if="showMarksTab">
                    <StudentSubject @markDeleted="handleMarkDeleted" @toggleConfirmMark="toggleConfirmMarkData" v-for="subject in subjects" :key="student.id" :professorsSubjects="professorsSubjects" :user="user" :subject="subject" :student="student" :finalMarks="finalMarks"/>
                </div>

                <div class="activities-tab" v-if="showActivitiesTab">
                    <Activity v-for="activity in activities" :key="activity.id" :activity="activity" :studentName="student.name"/>
                </div>

            </div>

        </div>

    </div>

</div>

</template>

<style scoped>

.student-container{
    width: 100%;
    height: 95vh;
    background-color: white;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: flex;
}

.consultations{
    height: 20rem;
    overflow: auto;
}
.student-personal-info{
    width: 60%;
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
    padding: 0rem;
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

.student-statistics{
    padding: 1rem;
    width: 50%;
}

.student-tabs{
    border-bottom: 1px solid lightgray;
    width: 100%;
    display: flex;
    justify-content: center;
}

.student-tabs button{
    background-color: white;
    border: none;
    font-size: 1.2rem;
    padding: 0.5rem 1rem;
    cursor: pointer;
}

.small-text{
    font-size: 0.9rem;
}
.student-tabs button.active-btn{
    border-bottom: 2px solid var(--brown);
    color: var(--brown);
}

.marks-tab{
    height: 95%;
    overflow: auto;
}

.activities-tab{
    height: 95%;
    overflow: auto;
    padding: 1rem 0rem;
}

.average-mark{
    margin-top: 2rem;
}

.student-btn-group{
    margin-top: 1rem;
    display: flex;
    gap: 1rem;
}

.student-btn-group button{
    background-color: var(--brown);
    padding: 0.5rem;
    border: 1px solid var(--brown);
    cursor: pointer;
    color: white;
    transition: all 0.3s ease;
    font-size: 1.1rem;
}

.student-btn-group button:hover{
    background-color: #966560;
    border: 1px solid #966560;
}

table{
    border-collapse: collapse;
    width: 100%;
    margin-top: 0.5rem;
}

td, th{
    border: 1px solid lightgray;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
  background-color: rgb(245, 245, 245);
}

</style>