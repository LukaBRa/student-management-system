<script>



</script>


<template>

<div class="modal">

    <div class="form-container">
        <div class="modal-header">
            <button @click="$emit('toggleAddActivitiesForm')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <h1>Upis aktivnosti</h1>
        <form>
            <div class="form-input">
                <label>Odaberite tip aktivnosti</label>
                <div class="radio-buttons">
                    <div class="radio-group">
                        <input type="radio" name="activity-type">
                        <i class="fa-regular fa-face-smile-beam"></i>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="activity-type">
                        <i class="fa-regular fa-face-meh"></i>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="activity-type">
                        <i class="fa-regular fa-face-tired"></i>
                    </div>
                </div>
            </div>
            <div class="form-input">
                <label>Opis aktivnosti</label>
                <textarea placeholder="Opis..."></textarea>
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

</style>