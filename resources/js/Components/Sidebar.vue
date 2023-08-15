<script setup>

import SidebarLink from '../Components/SidebarLink.vue';

</script>

<template>

<div class="sidebar bg-dark">

    <div>
        <div class="logo">
        <i class="fa-solid fa-graduation-cap text-light"></i>
        <h3 class="text-light">eDNEVNIK</h3>
        </div>

        <div class="links">
            <SidebarLink icon='<i class="fa-solid fa-house"></i>' title="Početna" linkTo="/administracija"/>
            <SidebarLink icon='<i class="fa-solid fa-user-tie"></i>' title="Profesori" linkTo="/profesori"/>
            <SidebarLink icon='<i class="fa-solid fa-user-graduate"></i>' title="Učenici" linkTo="/ucenici" />
            <SidebarLink icon='<i class="fa-solid fa-book-bookmark"></i>' title="Dnevnik" linkTo="/dnevnik" />        
        </div>

    </div>

    <SidebarLink icon='<i class="fa-solid fa-arrow-right-from-bracket"></i>' title="Odjava" linkTo="/logout" />

</div>

</template>

<style>

.sidebar{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}

.logo{
    text-align: center;
    padding: 1rem 3rem;
    margin-bottom: 1rem;
}

.logo i{
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.links{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

</style>