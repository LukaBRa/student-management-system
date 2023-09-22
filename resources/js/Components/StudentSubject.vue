<script>

export default{
    data() {
        return {
            marks: [],
            averageMark: 0,
            canConfirmMark: false,
            tempSubjects: [],
            tempSubj: null,
            explanation: '',
        }
    },
    props: [
        'user',
        'subject',
        'student',
        'finalMarks',
        'professorsSubjects'
    ],
    methods: {
        deleteMark() {
            axios.post("http://localhost:8000/api/delete-mark", {
                studentId: this.student.id,
                subjectId: this.subject.id,
            })
            .then(response => {
                if(response.data == "success"){
                    this.$emit('markDeleted');
                }
            })
            .catch(error => console.log(error));
        }
    },
    mounted() {
        for(let i=0; i < this.finalMarks.length; i++){
            if(this.finalMarks[i].subject_id == this.subject.id && this.finalMarks[i].user_id == this.student.id){
                this.explanation = this.finalMarks[i].explanation;
            }
        }
        this.tempSubjects = this.professorsSubjects;
        this.tempSubj = this.subject;

        this.canConfirmMark = this.tempSubjects.some(subj => subj.id == this.tempSubj.id) && this.user.type_id == 2;

    },
    computed: {
        showFinalMark(){
            return this.subject.finalMark != null;
        },
        averageScore() {
            return Math.round(this.averageMark * 100) / 100;
        },
        canDeleteFinalMark() {
            return this.user.type_id == '1' ? true : false;
        }
    }
}

</script>

<template>

<div class="subject-container">
    
    <div>
        <div class="subject-marks">
            <p class="subject-name">{{ subject.subject_name }}: </p>
            <p class="subject-mark" v-for="mark in subject.marks">{{ mark.mark }}</p>
        </div>
        <p class="avg-mark">Prosečna ocena: {{ subject.avgMark }}</p>
    </div>
    <div class="final-mark-container">
        <p v-if="showFinalMark" class="final-mark">
            Zaključna ocena: <span class="final-mark-accent">{{ subject.finalMark }}</span><br>
            Obrazloženje: {{ explanation }}
        </p>
        <span v-else class="light-accent">
            <button v-if="canConfirmMark" @click="$emit('toggleConfirmMark', subject.subject_name, subject.id, subject.avgMark, student.id, subject.marks)" class="confirm-mark-btn">Zaključi ocenu</button>
            Nije zaključena ocena
        </span>
        <button @click="deleteMark" v-if="canDeleteFinalMark && showFinalMark" class="confirm-mark-btn">Poništi ocenu</button>
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
    padding-right: 0.5rem;
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

.confirm-mark-btn{
    background-color: var(--brown);
    color: white;
    border: 1px solid var(--brown);
    padding: 0.2rem;
    cursor: pointer;
    margin-right: 0.5rem;
}

.confirm-mark-btn:hover{
    background-color: #97645f;
    color: white;
    border: 1px solid #97645f;
}

</style>