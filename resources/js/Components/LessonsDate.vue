<script setup>

import LessonsComponent from '../Components/LessonsComponent.vue';

</script>

<template>

<div class="date-lessons-container">
    <h3>Ponedeljak - 3.4.2023</h3>
    <div class="date-lessons-container-lessons">
        <LessonsComponent />
        <LessonsComponent />
        <LessonsComponent />
        <LessonsComponent />
        <LessonsComponent />
        <LessonsComponent />
        <LessonsComponent />
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