<script>

export default{
    props: [
        'userName',
        'type'
    ],
    computed: {
        showProffesorIcon(){
            return this.type == "professors"
        },
        showStudentIcon(){
            return this.type == "student";
        }
    }
}

</script>

<template>

<a href="" class="user-card">
    <i v-if="showProffesorIcon" class="fa-solid fa-user-tie"></i>
    <i v-if="showStudentIcon" class="fa-solid fa-user-graduate"></i>
    <p>{{ userName }}</p>
</a>

</template>

<style>

.user-card{
    width: 15%;
    padding: 1rem;
    border: 1px solid lightgray;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: var(--black);
    gap: 1rem;
    transition: all 0.3s ease;
}

.user-card:hover{
    color: var(--brown);
    background-color: white;
    border: 1px solid var(--brown);
}

.user-card i{
    font-size: 3rem;
}

</style>