<script>

import UserCard from './UserCard.vue';

export default {
    data() {
        return {
            containerTitle: '',
        }
    },
    components: {
        UserCard
    },
    props: [
        'users',
        'userType',
        'category',
    ],
    mounted() {
            if (this.userType == "professors" && this.category == 0) {
                this.containerTitle = "Svi profesori"
            }else{
                //
            }
            if(this.userType == "students" && this.category == 0){
                this.containerTitle = "Svi učenici"
            }else{
                //
            }
    }
}

</script>

<template>

<div class="users-container">
    <h2>{{ containerTitle }}</h2>
    <div class="user-list">
        <UserCard  v-for="user in users" :key="user.id" :userId="user.id" :userName="user.name" :type="userType"/>
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