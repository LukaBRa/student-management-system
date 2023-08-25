<script>
import { useForm } from '@inertiajs/vue3';


export default{
    data() {
        return {
            subjectId: 0,
            mark: 0,
        }
    },
    props: [
        'canAddMarkSubjects',
        'professorId',
        'studentId'
    ],
    methods: {
        addMark() {
            axios.post('http://localhost:8000/api/add-mark', {
                subjectId: this.subjectId,
                studentId: this.studentId,
                mark: this.mark,
            })
            .then(response => {
                if(response.data == "success"){
                    this.$emit('success');
                }
            })
            .catch(error => console.log(error));
        }
    }
}

</script>

<template>

<div class="modal">

    <div class="form-container">
        <div class="modal-header">
            <button @click="$emit('toggleAddMarkForm')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form @submit.prevent="addMark">
            <h1>Upis ocene</h1>
            <div class="form-input">
                <label>Izaberi predmet:</label>
                <select v-model="subjectId">
                    <option v-for="subject in canAddMarkSubjects" :key="subject.id" :value="subject.id">{{ subject.subject_name }}</option>
                </select>
            </div>
            <div class="form-input">
                <label>Izaberi ocenu:</label>
                <select v-model="mark">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-input">
                <label>Izaberi opis ocene:</label>
                <select>
                    <option value="Kontrolni">Kontrolni</option>
                    <option value="Usmeni">Usmeni</option>
                    <option value="Pismeni">Pismeni</option>
                </select>
            </div>
            <input type="submit" value="Upiši ocenu">
        </form>
    </div>

</div>

</template>

<style scoped>

form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-inline: 5rem;
    margin-bottom: 2rem;
}

h1{
    margin-bottom: 1rem;
}

.form-input{
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

label{
    font-size: 1.1rem;
    font-weight: bold;
}

select{
    padding: 0.5rem;
    border-radius: 5px;
}

input[type="submit"]{
    margin-top: 1rem;
    background-color: var(--brown);
    color: white;
    border: 1px solid var(--brown);
    padding: 0.5rem;
    font-size: 1.2rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
}

input[type="submit"]:hover{
    background-color: #966560;
    border: 1px solid #966560;
}

</style>