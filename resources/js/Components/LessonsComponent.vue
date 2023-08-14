<script setup>



</script>

<template>

<div class="lesson-component">
        <p><span class="bold-accent">Nastavnik:</span> Zoran Zoranic</p>
        <p><span class="bold-accent">Predmet:</span> Matematika</p>
        <p><span class="bold-accent">Naziv teme:</span> Linearne jednacine</p>
        <p><span class="bold-accent">Opis casa:</span> Vezbanje</p>
        <p><span class="bold-accent">Odeljenje:</span> VII-2</p>
        <p><span class="bold-accent">Broj odsutnih:</span> 10</p>

        <a href="" class="lesson-review-link">Pregled časa <i class="fa-solid fa-arrow-right"></i></a>
</div>

</template>

<style scoped>

.lesson-component{
    border: 1px solid lightgray;
    padding: 1rem;
    border-radius: 10px;
}

.lesson-component p{
    margin-bottom: 0.5rem;
}

.bold-accent{
    font-weight: bold;
}

.lesson-review-link{
    display: block;
    margin-top: 1rem;
    padding: 0rem;
    color: var(--brown);
    font-weight: bold;
    display: flex;
    align-items: center;
}

.lesson-review-link:hover{
    text-decoration: underline;
    background-color: white;
}

</style>