<script>
import axios from 'axios';


export default {
    data() {
        return {
            activityType: 'positive',
            description: '',
            errorMessage: '',
            lessonId: '',
        }
    },
    props: [
        'studentId',
        'professorLessons'
    ],
    methods: {
        addActivity() {
            if(this.description == '' || this.lessonId == ''){
                this.errorMessage = "Popunite sva polja.";
            }else{
                axios.post("http://localhost:8000/api/add-activity", {
                    studentId: this.studentId,
                    actType: this.activityType,
                    description: this.description,
                    lessonId: this.lessonId,
                })
                .then(response => {
                        this.$emit("success", response.data);
                })
                .catch(error => console.log(error));
            }
        }
    }
}

</script>


<template>

<div class="modal">

    <div class="form-container">
        <div class="modal-header">
            <button @click="$emit('toggleAddActivitiesForm')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <h1>Upis aktivnosti</h1>
        <form @submit.prevent="addActivity">
            <div class="form-input">
                <label>Odaberite tip aktivnosti</label>
                <div class="radio-buttons">
                    <div class="radio-group">
                        <input v-model="activityType" id="positive" type="radio" name="activity-type" value="positive" checked>
                        <label for="positive"><i class="fa-regular fa-face-smile-beam"></i></label>
                    </div>
                    <div class="radio-group">
                        <input v-model="activityType" id="neutral" type="radio" name="activity-type" value="neutral">
                        <label for="neutral"><i class="fa-regular fa-face-meh"></i></label>
                    </div>
                    <div class="radio-group">
                        <input v-model="activityType" id="negative" type="radio" name="activity-type" value="negative">
                        <label for="negative"><i class="fa-regular fa-face-tired"></i></label>
                    </div>
                </div>
            </div>
            <div class="form-input">
                <label for="choose-lesson">Odaberite čas</label>
                <select id="choose-lesson" v-model="lessonId">
                    <option value="" default>Čas...</option>
                    <option v-for="lesson in professorLessons" :value="lesson.id">{{ lesson.dayOfWeek }} - {{ lesson.formatedDate }} - {{ lesson.subjectName }}</option>
                </select>
            </div>
            <div class="form-input">
                <label>Opis aktivnosti</label>
                <textarea v-model="description" placeholder="Opis..."></textarea>
                <p class="error-txt">{{ errorMessage }}</p>
            </div>
            <input type="submit" value="Dodaj aktivnost">
        </form>
    </div>

</div>

</template>

<style scoped>

h1{
    margin-top: 1rem;
    text-align: center;
}

form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 2rem;
}

.form-input{
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.radio-buttons{
    display: flex;
    gap: 1rem;
}

.radio-group{
    font-size: 1.5rem;
    display: flex;
    gap: 0.3rem;
}

label{
    font-size: 1.1rem;
    font-weight: bold;
}

.radio-group label{
    font-size: 1.5rem;
}

textarea{
    resize: none;
    padding: 0.5rem;
    height: 30vh;
    width: 15vw;
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

.fa-face-smile-beam{
    color: green;
}

.fa-face-meh{
    color: rgb(226, 193, 85);
}

.fa-face-tired{
    color: rgb(252, 74, 74);
}

.error-txt{
    color: rgb(248, 90, 90);
    text-align: center;
}

select{
    padding: 0.5rem;
}

</style>