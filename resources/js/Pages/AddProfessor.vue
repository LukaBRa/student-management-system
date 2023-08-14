<script>

import Sidebar from '../Components/Sidebar.vue';

export default{
    components: {
        Sidebar
    }
}

</script>

<template>

<div class="container">

    <Sidebar />

    <div class="dashboard bg-light">

        <div class="professor-form">
            <div class="form-container">
                <h2>Dodaj novog profesora</h2>
                <form>
                    <div class="form-input">
                        <label>Ime i prezime</label>
                        <input type="text" placeholder="Ime i prezime...">
                    </div>
                    <div class="form-input">
                        <label>Email</label>
                        <input type="text" placeholder="Email adresa...">
                    </div>
                    <div class="form-input">
                        <label>Adresa stanovanja</label>
                        <input type="text" placeholder="Adresa...">
                    </div>
                    <div class="form-input">
                        <label>Broj telefona</label>
                        <input type="text" placeholder="Broj telefona...">
                    </div>
                    <input type="submit" value="Dodaj profesora">
                </form>
            </div>
        </div>

    </div>

</div>

</template>

<style>

.professor-form{
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-container{
    background-color: white;
    padding: 2rem;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    border-radius: 5px;
}

.form-container h2{
    text-align: center;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid lightgray;
}

.form-container form{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 2rem;
    width: 20rem;
}

.form-input{
    display: flex;
    flex-direction: column;
}

.form-input label{
    font-weight: 1.1rem;
}

.form-input input{
    padding: 0.5rem 0rem;
    border: none;
    border-bottom: 1px solid var(--black);
}

.form-input input:focus{
    outline: none;
}

.form-input input::placeholder{
    color: rgb(175, 175, 175);
    font-style: italic;
}

input[type="submit"]{
    background-color: var(--brown);
    border: 1px solid var(--brown);
    color: var(--white);
    padding: 0.5rem;
    font-size: 1.1rem;
    border-radius: 20px;
    margin-top: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

input[type="submit"]:hover{
    background-color: #94645e;
    border: 1px solid #94645e;
}

</style>