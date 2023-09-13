<script>

import Sidebar from '../Components/Sidebar.vue';
import UsersContainer from '../Components/UsersContainer.vue';

export default {
    data() {
        return {
            searchText: '',
            pageUsers: [],
            studentFilter: 0
        }
    },
    components: {
        Sidebar, UsersContainer
    },
    props: [
        'students',
        'classes',
        'user',
        'profClasses'
    ],
    mounted() {
        this.pageUsers = [...this.students];
    },
    computed: {
        adminRule() {
            return this.user.type_id == 1;
        },
        professorRule() {
            return this.user.type_id == 2;
        }
    },
    methods: {
        searchStudents() {
                axios.get("http://localhost:8000/api/search-students/" + this.searchText)
                .then(response => {
                    this.pageUsers = response.data;
                })
                .catch(error => console.log(error));
        },
        srcByClassName(){
            axios.get("http://localhost:8000/api/search-students/by-class/" + this.studentFilter)
            .then(response => {
                this.pageUsers = response.data;
                console.log(response.data);
            })
            .catch(error => console.log(error));
        }
    }
}

</script>

<template>

<div class="container">

    <Sidebar :user="user" active="Učenici"/>

    <div class="dashboard bg-light">

        <div class="students-header">
            <a v-if="adminRule" href="/dodaj-ucenika" class="add-professor-link">Dodaj učenika <i class="fa-solid fa-plus"></i></a>
            <div class="search-box">
                <input type="text" @input="searchStudents" v-model="searchText" placeholder="Pretrazi učenike...">
                <i class="fa-solid fa-magnifying-glass fa-rotate-90"></i>
            </div>
            <select @change="srcByClassName" class="select-filter" v-model="studentFilter">
                <option value="0" default>Svi učenici</option>
                <option v-for="cl in classes" :key="cl.id" :value="cl.id">{{ cl.class_name }}</option>
            </select>
        </div>

        <UsersContainer :users="pageUsers" userType="students" :category="studentFilter" :currentUser="user" :profClasses="profClasses"/>

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