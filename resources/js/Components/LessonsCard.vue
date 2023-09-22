<script>
import axios from 'axios';


export default {
    data() {
        return {
            tempArr: [],
            classLessons: [],
        }
    },
    props: [
        'uniqueClass',
        'lessons',
        'user'
    ],
    mounted() {
    }
}

</script>

<template>

<div class="lessons-card">

    <h3>{{ uniqueClass.class_name }}</h3>

    <table>
        <tr>
            <th>Čas</th>
            <th>Predmet</th>
        </tr>
        <tr v-for="tmpLesson in lessons">
            <td>{{ tmpLesson.lesson_number }}</td>
            <td>{{ tmpLesson.subject_name }}</td>
            <td>
                <a v-if="tmpLesson.user_id == user.id" class="lessons-link" :href="'/cas/' + tmpLesson.id">Detaljnije</a>
                <a v-if="user.type_id == 1" class="lessons-link" :href="'/cas/' + tmpLesson.id">Detaljnije</a>
            </td>
        </tr>
    </table>

</div>

</template>

<style scoped>

.lessons-card{
    border: 1px solid lightgray;
    width: max-content;
    padding: 1rem;
    min-height: 15rem;
}

h3{
    padding-bottom: 0.5rem;
    border-bottom: 1px solid lightgray;
    margin-bottom: 0.5rem;
}

table{
    border-collapse: collapse;
    width: 100%;
}

td, th{
    border: 1px solid lightgray;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
  background-color: rgb(238, 237, 237);
}

.lessons-link{
    font-size: 0.8rem;
    background-color: var(--brown);
    color: white;
    transition: all 0.3s ease;
}

.lessons-link:hover{
    background-color: #96635d;
}

</style>