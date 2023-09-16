<script>

import Sidebar from '../Components/Sidebar.vue';
import Message from '../Components/Message.vue';
import LessonsDate from '../Components/LessonsDate.vue';

export default{
    data() {
        return {
            message: '',
            showMessage: false,
            dates: [],
            dateFilter: null,
        }
    },
    props: [
        'user',
        'groupedLessons'
    ],
    components: {
        Sidebar, Message, LessonsDate
    },
    computed: {
        professorRule() {
            return this.user.type_id == "2";
        }
    },
    mounted() {
        this.dates = this.groupedLessons;
    },
    methods: {
        searchDate() {
            axios.get("http://localhost:8000/api/searchDates/" + this.dateFilter)
            .then(response => {
                this.dates = [];
                this.dates.push(response.data);
            })
            .catch(error => console.log(error));
        },
        showAllDates() {
            axios.get("http://localhost:8000/api/all-dates")
            .then(response => {
                this.dates = response.data;
                console.log(response.data);
            })
            .catch(error => console.log(error));
        }
    }
}

</script>

<template>

<div class="container">

    <Sidebar :user="user" active="Dnevnik"/>

    <Message v-if="showMessage" :message="message"/>

    <div class="dashboard bg-light">

        <div class="lessons-header">
            <h2>Dnevnik škole</h2>
            <a href="/upis-casova" v-if="professorRule" class="toggle-btn">Upiši čas</a>
            <div class="date-container">
                <p>Pretraži po datumu: </p>
                <input type="date" v-model="dateFilter" @input="searchDate">
                <button @click="showAllDates" class="toggle-btn">Svi časovi</button>
            </div>
        </div>

        <div class="lessons-container">
            <LessonsDate v-for="lessonDate in dates" :key="lessonDate.formatedDate" :user="user" :lessonDate="lessonDate"/>
        </div>

    </div>

</div>

</template>

<style>

.lessons-header{
    background-color: white;
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.date-container{
    display: flex;
    gap: 0.5rem ;
    align-items: baseline;
}

.date-container p{
    font-weight: bold;
}

.lessons-container{
    background-color: white;
    margin-top: 1rem;
    width: 100%;
    height: 85vh;
    overflow: auto;
    padding: 1rem;
}

.toggle-btn{
    display: block;
    width: max-content;
    background-color: white;
    border: 1px solid var(--black);
    padding: 0.5rem;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--black);
}

.toggle-btn:hover{
    background-color: var(--brown);
    color: white;
    border: 1px solid var(--brown);
}

</style>