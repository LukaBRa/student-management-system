<script>



</script>

<template>

<div class="lessons-card">

    <h3>V-1</h3>

    <table>
        <tr>
            <th>Čas</th>
            <th>Predmet</th>
        </tr>
        <tr>
            <td>1.</td>
            <td>Matematika</td>
            <td>Detaljnije</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Srpski jezik</td>
            <td>Detaljnije</td>
        </tr>
    </table>

</div>

</template>

<style scoped>

.lessons-card{
    border: 1px solid lightgray;
    width: max-content;
    padding: 1rem;
}

h3{
    padding-bottom: 0.5rem;
    border-bottom: 1px solid lightgray;
    margin-bottom: 0.5rem;
}

table{
    border-collapse: collapse;
    width: 100%;
}

td, th{
    border: 1px solid lightgray;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
  background-color: rgb(238, 237, 237);
}

</style>