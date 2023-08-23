<script>

export default {
    props: [
        'lesson'
    ],
    computed: {
        lessonLink() {
            return "/cas/" + this.lesson.id;
        }
    }
}

</script>

<template>

<div class="lesson-component">
        <p><span class="bold-accent">Naziv teme:</span> {{ lesson.lesson_title }}</p>
        <p><span class="bold-accent">Opis casa:</span> {{ lesson.lesson_description }}</p>

        <a :href="lessonLink" class="lesson-review-link">Detaljnije <i class="fa-solid fa-arrow-right"></i></a>
</div>

</template>

<style scoped>

.lesson-component{
    border: 1px solid lightgray;
    padding: 1rem;
    border-radius: 10px;
    width: 30%;
    min-height: 10rem;
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