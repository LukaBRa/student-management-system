<script>

import LessonsComponent from '../Components/LessonsComponent.vue';

export default {
    data() {
        return {
            lessons: [],
        }
    },
    components: {
        LessonsComponent
    },
    props: [
        'date',
    ],
    mounted() {
        axios.get("http://localhost:8000/api/get-lessons/date/" + this.date)
        .then(response => {
            this.lessons = response.data;
        })
        .catch(error => console.log(error));
    }
}

</script>

<template>

<div class="date-lessons-container">
    <h3>{{ date }}</h3>
    <div class="date-lessons-container-lessons">
        <LessonsComponent v-for="lesson in lessons" :key="lesson.id" :lesson="lesson"/>
    </div>
</div>

</template>

<style scoped>

.date-lessons-container{
    padding: 0.5rem;
}

.date-lessons-container h3{
    border-bottom: 1px solid lightgray;
    padding-bottom: 0.5rem;
}

.date-lessons-container-lessons{
    margin-top: 0.5rem;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1rem;
}


</style>