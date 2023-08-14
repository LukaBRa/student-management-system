<script setup>



</script>

<template>

<div class="welcome-container">

    <div>
        <p class="welcome-message">Dobrodošli, Luka <img src="/images/wave.png" width="30" height="30" /></p>
        <p class="message-secondary">na elektronski dnevnik</p>
    </div>
    
    <button class="small-btn"><i class="fa-regular fa-bell"></i></button>

</div>

</template>

<style>

.welcome-container{
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
}

.welcome-message{
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.message-secondary{
    margin-top: 0.5rem;
    color: rgb(163, 163, 163);
}

</style>