<script>

export default{
    data() {
        return {
            errorMsg: '',
            checkedSubject: null,
            checkedClasses: [],
        }
    },
    props: [
        'subjects',
        'professorId',
        'allClasses'
    ],
    methods: {
        submitForm() {
            if(this.checkedSubject == null){
                this.errorMsg = "Izaberite predmet.";
            }else if(this.checkedClasses.length == 0){
                this.errorMsg = "Izaberite odeljenje.";
            }else{
                axios.post("http://localhost:8000/api/add-subject", {
                    profId: this.professorId,
                    subject: this.checkedSubject,
                    sClasses: this.checkedClasses, 
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
}

</script>

<template>

<div class="modal">
    <div class="form-container">
        <div class="modal-header">
            <button @click="$emit('toggleForm')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <h2>Dodaj predmet</h2>
        <form @submit.prevent="submitForm">
            <div class="form-flex">
                <div class="checkbox-group">
                    <label class="main-label">Predmeti: </label>
                    <div class="checkbox-input" v-for="subj in subjects">
                        <input type="radio" v-model="checkedSubject" name="checkedSubject" :value="subj.id" :id="subj.id">
                        <label :for="subj.id">{{ subj.subject_name }}</label>
                    </div>
                </div>
                <div class="checkbox-group">
                    <label class="main-label">Odeljenja: </label>
                    <div class="checkbox-input" v-for="sclass in allClasses">
                        <input type="checkbox" v-model="checkedClasses" :value="sclass.id" :id="sclass.id">
                        <label>{{ sclass.class_name }}</label>
                    </div>
                </div>
            </div>
            <p class="error-msg">{{ errorMsg }}</p>
            <input type="submit" value="Dodaj predmet">
        </form>
    </div>
</div>

</template>

<style scoped>

h2{
    border-bottom: 1px solid lightgray;
    padding-bottom: 0.5rem;
    margin-top: 1rem;
    text-align: center;
}

form{
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-top: 1rem;
    width: 15rem;
}

.form-flex{
    display: flex;
    gap: 2rem;
}
.main-label{
    font-weight: bold;
    font-size: 1.2rem;
}
.checkbox-group{
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.checkbox-input{
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

input[type="submit"]{
    padding: 0.5rem;
    background-color: var(--brown);
    border: 1px solid var(--brown);
    color: white;
    border-radius: 20px;
    font-size: 1.1rem;
    margin-top: 1rem;
    cursor: pointer;
}

input[type="submit"]:hover{
    background-color: #966560;
    border: 1px solid #966560;
}
.error-msg{
    color: rgb(255, 113, 113);
}

</style>