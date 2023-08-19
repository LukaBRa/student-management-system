<script>

export default{
    data() {
        return {
            marks: [],
            finalMark: '',
            averageMark: 0,
        }
    },
    props: [
        'subject',
        'student',
        'finalMarks'
    ],
    mounted() {
        this.finalMarks.forEach(mark => {
            if(mark.subject_id == this.subject.id){
                this.finalMark = mark.final_mark;
            }
        });

        axios.get(`http://localhost:8000/api/get-marks/${this.subject.id}/student/${this.student.id}`)
        .then(response => {
            this.marks = response.data.marks;
            
            if(this.marks.length > 0) {
                let sum = 0;

                this.marks.forEach(mark => {
                    sum += mark;
                });

                this.averageMark = sum/this.marks.length;
            }

        })
        .catch(error => console.log(error));

    },
    computed: {
        showFinalMark(){
            return this.finalMark != null;
        }
    }
}

</script>

<template>

<div class="subject-container">
    <div>
        <div class="subject-marks">
            <p class="subject-name">{{ subject.subject_name }}: </p>
            <p class="subject-mark" v-for="mark in marks">{{ mark }}</p>
        </div>
        <p class="avg-mark">Prosečna ocena: {{ averageMark }}</p>
    </div>
    <div class="final-mark-container">
        <p v-if="showFinalMark" class="final-mark">Zaključna ocena: <span class="final-mark-accent">3</span></p>
        <span v-else class="light-accent">Nije zaključena ocena</span>
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