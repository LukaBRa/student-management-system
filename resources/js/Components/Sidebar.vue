<script>

import SidebarLink from '../Components/SidebarLink.vue';

export default{
    components:{
        SidebarLink,
    },
    props: [
        'user',
        'active'
    ],
    computed: {
        isParent(){ 
            return this.user.type_id == 3;
        },
        isProfessor(){
            return this.user.type_id == 2;
        },
        isAdmin(){
            return this.user.type_id == 1;
        }
    }
}

</script>

<template>

<div class="sidebar bg-dark">

    <div>
        <div class="logo">
        <i class="fa-solid fa-graduation-cap text-light"></i>
        <h3 class="text-light">eDNEVNIK</h3>
        </div>

        <div class="links">
            <SidebarLink v-if="isParent" icon='<i class="fa-solid fa-house"></i>' title="Početna" linkTo="/pocetna" :active="active"/>
            <SidebarLink v-else icon='<i class="fa-solid fa-house"></i>' title="Početna" linkTo="/administracija" :active="active"/>
            <SidebarLink v-if="isAdmin" icon='<i class="fa-solid fa-user-tie"></i>' title="Profesori" linkTo="/profesori" :active="active"/>
            <SidebarLink v-if="!isParent" icon='<i class="fa-solid fa-user-graduate"></i>' title="Učenici" linkTo="/ucenici" :active="active"/>
            <SidebarLink v-if="!isParent" icon='<i class="fa-solid fa-book-bookmark"></i>' title="Dnevnik" linkTo="/dnevnik" :active="active"/>
            <SidebarLink icon='<i class="fa-solid fa-gear"></i>' title="Nalog" linkTo="/nalog" :active="active"/>        
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