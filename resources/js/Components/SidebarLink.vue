<script setup>


const props = defineProps(['icon', 'title', 'linkTo']);


</script>

<template>

<a :href="linkTo" class="bg-dark text-light">
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

</style>