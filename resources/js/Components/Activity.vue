<script>

export default {
    data() {
        return {
            name: '',
        }
    },
    props: [
        'activity',
        'studentName',
    ],
    computed: {
        showPositive() {
            return this.activity.activity_type == "positive"
        },
        showNeutral() {
            return this.activity.activity_type == "neutral"
        },
        showNegative() {
            return this.activity.activity_type == "negative"
        },
        userLink() {
            return "/ucenik/" + this.activity.user_id;
        },
    },
    mounted() {
        if(this.studentName == "none"){
            axios.get("http://localhost:8000/api/get-user/" + this.activity.user_id)
            .then(response => {
                this.name = response.data;
            })
            .catch(error => console.log(error));
        }else{
            this.name = this.studentName;
        }
    }
}

</script>

<template>

<div class="activity">
    <div class="activity-header">
        <i v-if="showPositive" class="fa-regular fa-face-smile"></i>
        <i v-if="showNeutral" class="fa-regular fa-face-meh"></i>
        <i v-if="showNegative" class="fa-regular fa-face-tired"></i>
        <p class="activity-date">{{ activity.created_at }}</p>
    </div>
    <div class="activity-content">
        <p class="activity-student">Učenik:
            <a :href="userLink">{{ name }}</a>
        </p>
        <p class="content-text">{{ activity.comment }}</p>
    </div>
</div>

</template>

<style scoped>

.activity{
    margin-bottom: 0.5rem;
}
.activity-header{
    display: flex;
    gap: 1rem;
}

.activity-content{
    word-wrap: break-word;
}

.activity-content a{
    padding: 0;
    margin: 0;
    width: max-content;
    font-weight: bold;
    color: var(--brown);
}

.activity-content a:hover{
    text-decoration: underline;
    background: none;
}

.activity-content a:hover{
    text-decoration: underline;
}

.activity-student{
    display: flex;
    gap: 0.2rem;
    margin-bottom: 0.5rem;
}

.activity-content{
    padding: 1rem 1rem 1rem 1.5rem;
    margin-left: 0.5rem;
    border-left: 1px solid lightgray;
}


.activity-date{
    color: rgb(192, 192, 192);
}

.activity-header{
    color: green;
    font-size: 1.1rem;
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

</style>