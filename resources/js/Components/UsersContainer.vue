<script>

import UserCard from './UserCard.vue';
import ClassCard from './ClassCard.vue';

export default {
    data() {
        return {
            containerTitle: '',
            isProfessor: false,
        }
    },
    components: {
        UserCard, ClassCard
    },
    props: [
        'users',
        'userType',
        'category',
        'currentUser',
        'profClasses'
    ],
    updated() {
        if (this.userType == "professors" && this.category == 0) {
                this.containerTitle = "Svi profesori"
            }else if(this.userType == "professors" && this.category != 0){
                switch (this.category) {
                    case 1:
                        this.containerTitle = "Profesori matematike";
                        break;
                    case 2:
                        this.containerTitle = "Profesori fizike";
                        break;
                    case 3:
                        this.containerTitle = "Profesori hemije";
                        break;
                    case 4:
                        this.containerTitle = "Profesori informatike";
                        break;
                    case 5:
                        this.containerTitle = "Profesori srpskog jezika";
                        break;
                    case 6:
                        this.containerTitle = "Profesori francuskog jezika";
                        break;
                    case 7:
                        this.containerTitle = "Profesori engleskog jezika";
                        break;
                    case 8:
                        this.containerTitle = "Profesori geografije";
                        break;
                    case 9:
                        this.containerTitle = "Profesori istorije";
                        break;
                    case 10:
                        this.containerTitle = "Profesori biologije";
                        break;
                    case 11:
                        this.containerTitle = "Profesori fizičkog";
                        break;
                    case 12:
                        this.containerTitle = "Profesori likovnog";
                        break;
                    default:
                        break;
                }

            }
            if(this.userType == "students" && this.category == 0){
                this.containerTitle = "Svi učenici"
            }else if(this.userType == "students" && this.category != 0){
                switch (this.category) {
                    case 1:
                        this.containerTitle = "V-1";
                        break;
                    case 2:
                        this.containerTitle = "V-2";
                        break;
                    case 3:
                        this.containerTitle = "V-3";
                        break;
                    case 4:
                        this.containerTitle = "VI-1";
                        break;
                    case 5:
                        this.containerTitle = "VI-2";
                        break;
                    case 6:
                        this.containerTitle = "VI-3";
                        break;
                    case 7:
                        this.containerTitle = "VII-1";
                        break;
                    case 8:
                        this.containerTitle = "VII-2";
                        break;
                    case 9:
                        this.containerTitle = "VII-3";
                        break;
                    case 10:
                        this.containerTitle = "VIII-1";
                        break;
                    case 11:
                        this.containerTitle = "VIII-2";
                        break;
                    case 12:
                        this.containerTitle = "VIII-3";
                        break;
                    default:
                        break;
                }
            }
    },
    mounted() {
            if (this.userType == "professors" && this.category == 0) {
                this.containerTitle = "Svi profesori"
            }
            if(this.userType == "students" && this.category == 0){
                this.containerTitle = "Svi učenici"
            }
            this.isProfessor = this.currentUser.type_id == 2;  },
}

</script>

<template>

<div class="users-container">
    <h2>{{ containerTitle }}</h2>
    <div v-if="!isProfessor" class="user-list">
        <UserCard  v-for="user in users" :key="user.id" :userId="user.id" :userName="user.name" :type="userType"/>
    </div>

    <div class="professors-students user-list">
        <ClassCard v-for="pClass in profClasses" :key="pClass.id" :pClass="pClass" :currentUser="currentUser"/>
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

.professors-students{
    height: 75vh;
    overflow: auto;
}


</style>