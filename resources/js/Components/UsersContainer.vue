<script setup>

import UserCard from './UserCard.vue';

</script>

<template>

<div class="users-container">
    <h2>Svi profesori/ucenici</h2>
    <div class="user-list">
        <UserCard />
        <UserCard />
        <UserCard />
        <UserCard />
        <UserCard />
        <UserCard />
        <UserCard />
    </div>
</div>

</template>

<style>

.users-container{
    background-color: white;
    margin-top: 1rem;
    padding: 1rem;
    height: 85vh;
}

.users-container h2{
    color: var(--black);
    padding-bottom: 0.5rem;
    border-bottom: 1px solid lightgray;
}

.user-list{
    display: flex;
    flex-wrap: wrap;
    margin-top: 1rem;
    overflow: auto;
    gap: 1rem;
}



</style>