<script>

import LessonsCard from './LessonsCard.vue';

export default {
    data() {
        return {
            lessons: [],
        }
    },
    components: {
        LessonsCard
    },
    /* props: [
        'date',
    ], */
}

</script>

<template>

<div class="date-lessons-container">
    <h3>12.04.2023</h3>
    <div class="date-lessons-container-lessons">
        <LessonsCard />
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