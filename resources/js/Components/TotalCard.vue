<script setup>

import { onMounted } from 'vue';

const props = defineProps(['title', 'icon', 'color', 'number']);


</script>

<template>

<div class="total-card" :style="`border-left: 5px solid ${color};`">

    <p class="card-icon" v-html="icon" :style="`color: ${color}`"></p>

    <div class="stats">
        <p>{{ title }}</p>
        <h3 class="text-dark">{{ number }}</h3>
    </div>

</div>

</template>

<style>

.total-card{
    background-color: white;
    padding: 1rem;
    border-radius: 10px;
    display: flex;
    gap: 2rem;
    align-items: center;
    width: 30%;
}

.card-icon {
    font-size: 3rem;
    border-right: 2px solid rgb(228, 228, 228);
    padding-right: 1rem;
    color: rgb(238, 145, 145);
}

.stats {
    width: 100%;
    text-align: center;
}

.stats p{
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: rgb(90, 90, 90);
}

.stats h3{
    font-size: 2rem;
}

</style>