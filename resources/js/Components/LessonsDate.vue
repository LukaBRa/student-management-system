<script>

import LessonsCard from './LessonsCard.vue';

export default {
    data() {
        return {
            uniqueClasses: [],
        }
    },
    components: {
        LessonsCard
    },
    props: [
        'lessonDate',
        'user'
    ],
    mounted() {
        if(this.lessonDate.classes){
            this.tempArr = this.lessonDate.classes;
            this.uniqueClasses = [...new Set(this.tempArr.map(item => item.class_name))];
        }
    }
}

</script>

<template>

<div class="date-lessons-container">
    <h3> {{ lessonDate.dayOfWeek }} - {{ lessonDate.formatedDate }}</h3>
    <div class="date-lessons-container-lessons">
        <LessonsCard v-for="uniqueClass in uniqueClasses" :key="uniqueClass" :user="user" :uniqueClass="uniqueClass" :lessons="this.tempArr"/>
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
    align-items: start;
    gap: 1rem;
}


</style>