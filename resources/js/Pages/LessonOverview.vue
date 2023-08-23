<script>

import Sidebar from '../Components/Sidebar.vue';

export default{
    components: {
        Sidebar
    },
    props: [
        'lesson',
        'professor',
        'subject',
        'absentStudents',
        'className'
    ],
    mounted() {
        console.log(this.className)
    }
}

</script>

<template>

<div class="container">
    
    <Sidebar />

    <div class="dashboard bg-light">

        <div class="lesson-container">

            <h1 class="title">Pregled časa</h1>

            <div class="lesson-data-table">

                <div class="table-part">

                    <div class="data-box">
                        <p class="bold-accent">Nastavnik:</p>
                        <p>{{ professor.name }}</p>
                    </div>

                    <div class="data-box">
                        <p class="bold-accent">Predmet:</p>
                        <p>{{ subject.subject_name }}</p>
                    </div>

                    <div class="data-box">
                        <p class="bold-accent">Tema:</p>
                        <p>{{ lesson.lesson_title }}</p>
                    </div>

                    <div class="data-box">
                        <p class="bold-accent">Opis časa:</p>
                        <p>{{ lesson.lesson_description }}</p>
                    </div>

                    <div class="data-box">
                        <p class="bold-accent">Odeljenje:</p>
                        <p>{{ className }}</p>
                    </div>

                </div>

                <div class="table-part">
                    <div class="data-box-column">
                        <p class="bold-accent">Odsutni studenti:</p>
                        <p v-for="student in absentStudents" :key="student.id">- {{ student.name }}</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
</div>

</template>

<style scoped>

.lesson-container{
    background-color: white;
    width: 100%;
    height: 95%;
    margin-top: 1rem;
    padding: 1rem;
}

.title{
    color: var(--black);
    border-bottom: 1px solid lightgray;
    padding-bottom: 0.5rem;
    text-align: center;
}

.lesson-data-table{
    display: flex;
    height: 94%;
    padding: 1rem;
}

.table-part{
    width: 50%;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

.data-box{
    display: flex;
    gap: 0.5rem;
    font-size: 1.2rem;
}

.data-box .bold-accent{
    font-weight: bold;
}

.data-box-column{
    font-size: 1.2rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: start;
}

.data-box-column .bold-accent {
    font-weight: bold;
}

</style>