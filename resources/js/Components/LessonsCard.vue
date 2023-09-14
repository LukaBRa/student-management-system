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
        this.tempArr = this.lessons;
        this.classLessons = this.tempArr.filter(el => el.class_name == this.uniqueClass)
        this.classLessons.sort((a,b) => a.lesson_number - b.lesson_number);
        this.classLessons.forEach((item) => {
            axios.get("http://localhost:8000/api/get-subject-name/" + item.subject_id)
            .then(response => {
                item.subject_name = response.data;
                if(this.user.type_id == 2){
                    if(item.user_id == this.user.id){
                        item.canView = true;
                    }else{
                        item.canView = false;
                    }
                }else{
                    item.canView = true;
                }
            })
            .catch(error => console.log(error));
        })
    }
}

</script>

<template>

<div class="lessons-card">

    <h3>{{ uniqueClass }}</h3>

    <table>
        <tr>
            <th>Čas</th>
            <th>Predmet</th>
        </tr>
        <tr v-for="tmpLesson in classLessons">
            <td>{{ tmpLesson.lesson_number }}</td>
            <td>{{ tmpLesson.subject_name }}</td>
            <td><a v-if="tmpLesson.canView" class="lessons-link" :href="'/cas/' + tmpLesson.id">Detaljnije</a></td>
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