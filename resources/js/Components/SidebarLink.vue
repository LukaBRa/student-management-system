<script>

export default{
    props: [
        'icon',
        'title',
        'linkTo',
        'active'
    ],
    computed:{
        isActive(){
            return this.title == this.active;
        }
    }
}


</script>

<template>

<a :href="linkTo" class="bg-dark text-light" :class="{ 'active': isActive }">
    <span v-html="icon"></span>
    {{ title }}
</a>

</template>

<style>

a{
    width: 100%;
    padding: 1rem;
    text-decoration: none;
    display: flex;
    gap: 0.5rem;
}

a:hover{
    background-color: #474747;
}

.active{
    background-color: #474747;
    border-left: 5px solid var(--light-brown);
}

</style>