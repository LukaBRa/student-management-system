<script>

import Sidebar from '../Components/Sidebar.vue';
import Welcome from '../Components/Welcome.vue';
import TotalCard from '../Components/TotalCard.vue';
import Activity from '../Components/Activity.vue';
import GoogleChart from '../Components/GoogleChart.vue';
import Appointments from '../Components/Appointments.vue';
import Message from '../Components/Message.vue';

export default{
    data(){
        return {
            message: '',
            showMessage: false,
        }
    },
    components: {
    Sidebar, Welcome, TotalCard, Activity, GoogleChart, Appointments,
    Appointments, Message
},
    props: [
        'user',
        'numberOfStudents',
        'numberOfProfessors',
        'lessons',
        'activities',
        'lessonGroups',
        'appointments'
    ],
    computed: {
        isProfessor(){
            return this.user.type_id == 2;
        }
    },
    methods: {
        deleteAppointment(id){ 
            axios.post("http://localhost:8000/api/delete-appointment", {
                appId: id
            })
            .then(response => {
                if(response.data == "success"){
                    this.message = "Uspešno ste uklonili termin konsultacija."
                    this.showMessage = true;
                    setTimeout(() => {
                        this.showMessage = false;
                        this.message = "";
                        window.location.href = "http://localhost:8000/administracija";
                    }, 1000);
                }
            })
            .catch(error => console.log(error));
        }
    }
}

</script>

<template>

<div class="container">
    
    <Sidebar :user="user" active="Početna"/>

    <Message v-if="showMessage" :message="message"/>

    <div class="dashboard bg-light">

        <Welcome :userName="user.name"/>

        <div class="total-cards">

            <TotalCard title="Učenici" icon='<i class="fa-solid fa-graduation-cap"></i>' :number="numberOfStudents" color="#4682A9"/>
            <TotalCard title="Profesori" icon='<i class="fa-solid fa-user-tie"></i>' :number="numberOfProfessors" color="#A78295"/>
            <TotalCard title="Časovi" icon='<i class="fa-solid fa-chalkboard-user"></i>' :number="lessons.length" color="#FF6666"/>

        </div>

        <div class="flex-container">

            <div class="recent-activities">
                <h2>Aktivnosti</h2>

                <div class="activities">
                    <Activity v-for="activity in activities" :key="activity.id" :activity="activity" :studentName="activity.student.name"/>
                </div>

            </div>

            <div class="lesson-statistics">
                <GoogleChart v-if="!isProfessor" :lessonGroups="lessonGroups"/>
            </div>

            <div v-if="isProfessor" class="recent-activities">
                <h2>Vaše konsultacije</h2>

                <Appointments @deleteAppointment="deleteAppointment"  :appointments="appointments"/>

            </div>

        </div>

    </div>
    
</div>

</template>

<style>

.flex-container{
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
}

.total-cards{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 1rem;
}

.recent-activities{
    background-color: white;
    width: 45%;
    height: 65vh;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activities{
    height: 95%;
    overflow: auto;
}

.lesson-statistics{
    background-color: white;
    height: 65vh;
    display: flex;
    align-items: center;
}

</style>