<script>
import axios from 'axios';


export default {
    data() {
        return {
            marks: [],
            finalMark: 0,
            errorMsg: '',
        }
    },
    props: [
        'user',
        'formStudentId',
        'formSubjName',
        'formSubjId',
        'formAverageScore'
    ],
    methods: {
        submitForm() {
            if(this.finalMark == 0){
                this.errorMsg = "Zaključna ocena je obavezna."
            }else{
                if(!(Math.round(this.formAverageScore * 100) / 100)){
                    this.errorMsg = "Učenik još uvek nema ocene."
                }else{
                    axios.post("http://localhost:8000/api/confirm-mark", {
                        studentId: this.formStudentId,
                        subjectId: this.formSubjId,
                        finalMark: this.finalMark
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
    },
    mounted() {
        let avgMark = Math.round(this.formAverageScore);
        for(let i = avgMark; i<=5; i++){
            this.marks.push(i);
        }
    },
    computed: {
        averageScore() {
            return Math.round(this.formAverageScore * 100) / 100;
        }
    }
}

</script>

<template>

<div class="modal">

    <div class="form-container">
        <form @submit.prevent="submitForm">
            <div class="modal-header">
                <button @click="$emit('toggleConfirmMark')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <h2>Zaključivanje ocene</h2>
            <p><span class="bold-accent">Predmet:</span> {{ formSubjName }}</p>
            <p><span class="bold-accent">Prosečna ocena:</span> {{ averageScore }}</p>
            <p class="light-accent">(Možete zaključiti samo ocenu odredjenu prosekom ili veću)</p>
            <div class="input-box">
                <label>Izaberite zaključnu ocenu:</label>
                <select v-model="finalMark">
                    <option value="0" default>Izaberite ocenu</option>
                    <option v-for="mark in marks" :value="mark">{{ mark }}</option>
                </select>
            </div>
            <p class="error-msg">{{ errorMsg }}</p>
            <input type="submit" value="Zaključi ocenu">
        </form>
    </div>

</div>

</template>


<style scoped>

.bold-accent{
    font-weight: bold;
}

h2{
    margin-bottom: 1.5rem;
    text-align: center;
    border-bottom: 1px solid lightgray;
    padding-bottom: 0.5rem;
}

form p{
    margin-top: 0.5rem;
    font-size: 1.2rem;
}

.input-box{
    margin-top: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.input-box label{
    font-weight: bold;
    font-size: 1.2rem;
}

.light-accent{
    font-size: 1rem;
    color: rgb(167, 166, 166);
}

select{
    padding: 0.5rem;
    width: max-content;
}

input[type="submit"]{
    background-color: var(--brown);
    border: 1px solid var(--brown);
    color: white;
    padding: 0.5rem;
    margin-top: 1rem;
    width: 100%;
    font-size: 1.1rem;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="submit"]:hover{
    background-color: #966560;
    border: 1px solid #966560;
}

.error-msg{
    color: rgb(255, 124, 124);
}

</style>