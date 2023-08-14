<script setup>



</script>

<template>

<div class="subject-container">
    <div>
        <div class="subject-marks">
            <p class="subject-name">Matematika: </p>
            <p class="subject-mark">3</p>
            <p class="subject-mark">3</p>
            <p class="subject-mark">3</p>
            <p class="subject-mark">3</p>
            <p class="subject-mark">3</p>
        </div>
        <p class="avg-mark">Prosečna ocena: 3.00</p>
    </div>
    <div class="final-mark-container">
        <p class="final-mark">Zakljucna ocena: <span class="final-mark-accent">3</span></p>
        <span class="light-accent">Nije zakljucena ocena</span>
    </div>
</div>

</template>

<style scoped>

.subject-container{
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    padding: 1rem 0.5rem;
}

.subject-marks{
    display: flex;
}

.subject-name{
    font-weight: bold;
    margin-right: 0.5rem;
}

.subject-mark{
    margin-right: 0.2rem;
    border-right: 1px solid lightgray;
    border-bottom: 1px solid lightgray;
    padding: 0rem 0.2rem;
}

.final-mark-container{
    display: flex;
    gap: 0.5rem;
    align-items: baseline;
}

.final-mark-accent{
    font-size: 1.5rem;
    color: var(--brown);
    font-weight: bold;
}
.light-accent{
    color: rgb(170, 170, 170);
}

.avg-mark{
    color: rgb(170, 170, 170);
    margin-top: 0.5rem;
}

</style>