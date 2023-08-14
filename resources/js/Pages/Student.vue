<script>

import Sidebar from '../Components/Sidebar.vue';
import StudentSubject from '../Components/StudentSubject.vue';
import Activity from '../Components/Activity.vue';

export default {
    data() {
        return {
            toggledTab: 'marks'
        }
    },
    components: {
        Sidebar, StudentSubject, Activity
    },
    methods:{
        toggleMarksTab() {
            this.toggledTab = "marks";
        },
        toggleActivitiesTab() {
            this.toggledTab = "activities";
        }
    },
    computed: {
        showActivitiesTab() {
            return this.toggledTab == "activities"
        },
        showMarksTab() {
            return this.toggledTab == "marks"
        },
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <div class="dashboard bg-light">

        <div class="student-container">

            <div class="student-personal-info">
                <i class="fa-solid fa-user-graduate"></i>
                <p class="student-name">Luka Banovic</p>
                <div class="student-data">
                    <div class="data-box">
                        <p class="data-box-accent">Ime majke:</p>
                        <p>Jelena Banovic</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Ime oca:</p>
                        <p>Zoran Banovic</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Adresa:</p>
                        <p>Mislopoljska 82</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj telefona:</p>
                        <p>0649040015</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj telefona majke:</p>
                        <p>0649040015</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj telefona oca:</p>
                        <p>0649040015</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Email adresa roditelja:</p>
                        <p>roditelj@gmail.com</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Odeljenje:</p>
                        <p>VII-4</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj izostanaka:</p>
                        <p>3</p>
                    </div>
                    <h3 class="average-mark">Prosek: 4.40</h3>
                    <div class="student-btn-group">
                        <button>Upiši ocenu</button>
                        <button>Upiši aktivnost</button>
                    </div>
                </div>
            </div>

            <div class="student-statistics">

                <div class="student-tabs">
                    <button @click="toggleMarksTab" :class="{ 'active-btn': showMarksTab}">Ocene</button>
                    <button @click="toggleActivitiesTab" :class="{ 'active-btn': showActivitiesTab}">Aktivnosti</button>
                </div>

                <div class="marks-tab" v-if="showMarksTab">
                    <StudentSubject />
                    <StudentSubject />
                    <StudentSubject />
                    <StudentSubject />
                    <StudentSubject />
                    <StudentSubject />
                    <StudentSubject />
                    <StudentSubject />
                </div>

                <div class="activities-tab" v-if="showActivitiesTab">
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
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

.student-statistics{
    padding: 1rem;
    width: 60%;
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

</style>