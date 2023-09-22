<script>

export default{
    props: [
        'appointments'
    ],
    mounted() {
        console.log(this.appointments);
    }
}

</script>

<template>

<div class="appointments">
    <table>
        <tr>
            <th>Termin</th>
            <th>Kabinet</th>
        </tr>
        <tr v-for="appointment in appointments">
            <td>{{ appointment.consultation_appointment }}</td>
            <td>{{ appointment.room_name }}</td>
            <td><button class="delete-appointment" @click="$emit('deleteAppointment', appointment.id)">Ukloni termin</button></td>
        </tr>
    </table>
</div>

</template>

<style scoped>

table{
    border-collapse: collapse;
    width: max-content;
}

td, th{
    border: 1px solid lightgray;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
  background-color: rgb(238, 237, 237);
}

.delete-appointment{
    background-color: var(--brown);
    padding: 0.2rem;
    border: 1px solid var(--brown);
    color: white;
    cursor: pointer;
}

</style>