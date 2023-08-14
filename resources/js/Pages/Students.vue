<script>

import Sidebar from '../Components/Sidebar.vue';
import UsersContainer from '../Components/UsersContainer.vue';

export default {
    components: {
        Sidebar, UsersContainer
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <div class="dashboard bg-light">

        <div class="students-header">
            <a href="/add-student" class="add-professor-link">Dodaj učenika <i class="fa-solid fa-plus"></i></a>
            <div class="search-box">
                <input type="text" placeholder="Pretrazi učenike...">
                <i class="fa-solid fa-magnifying-glass fa-rotate-90"></i>
            </div>
            <select class="select-filter">
                <option value="Svi studenti" default>Svi učenici</option>
                <option value="V-1" default>V-1</option>
                <option value="V-2" default>V-2</option>
                <option value="VII-5" default>VII-5</option>
                <option value="VIII-1" default>VIII-1</option>
                <option value="VIII-2" default>VIII-2</option>
            </select>
        </div>

        <UsersContainer />

    </div>

</div>

</template>

<style>

.students-header{
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