<script setup>



</script>

<template>

<div class="activity">
    <div class="activity-header">
        <i class="fa-regular fa-face-smile"></i>
        <p class="activity-date">02.05.2023</p>
    </div>
    <div class="activity-content">
        <p class="activity-student">Učenik: <a href="#">Luka Banovic</a></p>
        <p class="content-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel sunt, quia totam dicta temporibus doloribus cumque laboriosam cupiditate repudiandae laborum quo iste cum repellat odit non similique ullam obcaecati. Minus?</p>
    </div>
</div>

</template>

<style scoped>

.activity{
    margin-bottom: 0.5rem;
}
.activity-header{
    display: flex;
    gap: 1rem;
}

.activity-content{
    word-wrap: break-word;
}

.activity-content a{
    padding: 0;
    margin: 0;
    width: max-content;
    font-weight: bold;
    color: var(--brown);
}

.activity-content a:hover{
    text-decoration: underline;
}

.activity-student{
    display: flex;
    gap: 0.2rem;
    margin-bottom: 0.5rem;
}

.activity-content{
    padding: 1rem 1rem 1rem 1.5rem;
    margin-left: 0.5rem;
    border-left: 1px solid lightgray;
}

.activity-date{
    color: rgb(192, 192, 192);
}

.activity-header{
    color: green;
    font-size: 1.1rem;
}

</style>