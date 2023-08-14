<script>

import Sidebar from '../Components/Sidebar.vue';
import LessonsDate from '../Components/LessonsDate.vue';

export default{
    components: {
        Sidebar, LessonsDate
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <div class="dashboard bg-light">

        <div class="lessons-header">
            <h2>Dnevnik škole</h2>
            <div class="date-container">
                <p>Pretraži po datumu: </p>
                <input type="date">
            </div>
        </div>

        <div class="lessons-container">
            <LessonsDate />
            <LessonsDate />
            <LessonsDate />
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

</style>