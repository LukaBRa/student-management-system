<script>

import Sidebar from '../Components/Sidebar.vue';
import UsersContainer from '../Components/UsersContainer.vue';

export default{
    data() {
        return {
            pageUsers: [],
            professorFilter: 0
        }
    },
    components: {
        Sidebar, UsersContainer
    },
    props: [
        'professors',
        'subjects',
        'user'
    ],
    mounted() {
        this.pageUsers = [...this.professors];
    },
    computed: {
        adminRule() {
            return this.user.type_id == 1;
        },
        professorRule() {
            return this.user.type_id == 2;
        }
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <div class="dashboard bg-light">

        <div class="professors-header">
            <a v-if="adminRule" href="/dodaj-profesora" class="add-professor-link">Dodaj profesora <i class="fa-solid fa-plus"></i></a>
            <div class="search-box">
                <input type="text" placeholder="Pretrazi profesora...">
                <i class="fa-solid fa-magnifying-glass fa-rotate-90"></i>
            </div>
            <select class="select-filter">
                <option value="0" default>Svi profesori</option>
                <option v-for="subject in subjects" :value="subject.id">{{ subject.subject_name }}</option>
            </select>
        </div>

        <UsersContainer :users="pageUsers" userType="professors" :category="professorFilter"/>

    </div>

</div>

</template>

<style>

.professors-header{
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
}

.add-professor-link{
    display: block;
    width: max-content;
    border: 1px solid var(--black);
    color: var(--black);
    padding: 0.5rem;
    transition: all 0.3s ease;
}

.add-professor-link i{
    margin-left: 0.5rem;
}

.add-professor-link:hover{
    background-color: var(--black);
    color: white;
}

.search-box{
    border: 1px solid rgb(145, 144, 144);
    padding: 0.5rem;
    width: 15rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 20px;
}

.search-box input{
    border: none;
    width: 90%;
    margin-left: 0.5rem;
}

.search-box input:focus{
    outline: none;
}

.search-box i{
    color: rgb(145, 144, 144);
}

.select-filter{
    padding: 0.5rem;
    border: 1px solid var(--black);
    color: var(--black);
    outline: var(--black);
}

.select-filter option{
    transition: all 0.3s ease;
    padding: 0.5rem;
}

.select-filter option:checked{
    background-color: rgb(230, 230, 230);
}

.select-filter option:hover{
    background-color: rgb(145, 144, 144);
}

</style>