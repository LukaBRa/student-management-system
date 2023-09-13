<script>

import UserCard from './UserCard.vue';

export default {
    data() {
        return {
            showStudents: false,
        }
    },
    components: {
        UserCard,
    },
    props:[
        'pClass',
        'currentUser'
    ],
    methods: {
        toggleStudentsDiv() {
            this.showStudents = !this.showStudents;
        }
    },
}

</script>

<template>

<div class="class-card">

    <div class="class-header">
        <div class="class-info">
            <p class="class-name">{{ pClass.pClass.class_name }}</p>
            <p v-for="subject in pClass.subjects" class="class-subjects">{{ subject.subject_name }}</p>
        </div>
        <button @click="toggleStudentsDiv" class="students-toggler"><i class="fa-solid fa-chevron-down"></i></button>
    </div>

    <div class="class-students" :class="{ activeStudents: showStudents }">
        <UserCard v-for="student in pClass.students" :key="student.id" :userId="student.id" :userName="student.name" type="students" />
    </div>

</div>

</template>

<style scoped>

.class-card{
    width: 100%;
    border: 1px solid rgb(173, 173, 173);
    padding: 0.5rem;
}
.class-name{
    font-weight: bold;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.class-header{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.class-info{
    display: flex;
    align-items: center;
}

.class-subjects{
    color: rgb(173, 173, 173);
    margin-right: 0.5rem;
    border-right: 1px solid rgb(173, 173, 173);
    padding-right: 0.5rem;
}

.students-toggler{
    padding: 0.5rem;
    padding-left: 1rem;
    background-color: white;
    border: none;
    border-left: 1px solid rgb(173, 173, 173);
    cursor: pointer;
    transition: all 0.3s ease;
}

.students-toggler:hover{
    color: var(--brown);
    border-left: 1px solid var(--brown);
}

.class-students{
    padding: 1rem 0rem;
    margin-top: 0.5rem;
    border-top: 1px solid rgb(173, 173, 173);
    display: none;
    flex-wrap: wrap;
    overflow: auto;
    gap: 1rem;
    transition: all 0.3s ease;
}

.class-students.activeStudents{
    display: flex;
}

</style>