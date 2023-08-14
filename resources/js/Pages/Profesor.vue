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

        <div class="student-container">

            <div class="student-personal-info">
                <i class="fa-solid fa-user-tie"></i>
                <p class="student-name">Luka Banovic</p>
                <div class="user-btn-group">
                    <button>Dodaj predmet</button>
                </div>
            </div>

            <div class="proffesor-info">
                <div class="student-data">
                    <div class="data-box">
                        <p class="data-box-accent">Adresa:</p>
                        <p>Mislopoljska 82</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Broj telefona:</p>
                        <p>0649040015</p>
                    </div>
                    <div class="data-box">
                        <p class="data-box-accent">Email adresa:</p>
                        <p>profesor@gmail.com</p>
                    </div>
                    <div class="table-box">
                        <p class="data-box-accent data-box-flex">Predmeti:</p>
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th>Šifra predmeta</th>
                                    <th>Naziv predmeta</th>
                                </tr>
                                <tr>
                                    <td>1234</td>
                                    <td>Matematika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                                <tr>
                                    <td>1334</td>
                                    <td>Fizika</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</template>

<style>

.student-container{
    width: 100%;
    height: 95vh;
    background-color: white;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: flex;
}

.student-personal-info{
    width: 40%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.student-personal-info i {
    font-size: 10rem;
    padding: 2rem 0rem;
}

.student-name{
    font-size: 1.5rem;
    font-weight: bold;
}

.student-data{
    margin-top: 2rem;
    width: 90%;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.data-box{
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.data-box-accent{
    font-weight: bold;
}

.table-box{
    display: flex;
    flex-direction: column;
    gap: 1rem;
    width: 100%;
    
}

.table-container{
    height: 80vh;
    overflow: auto;
}

table{
    width: 100%;
    border: 1px solid var(--brown);
}

td, th{
    border: 1px solid var(--brown);
    padding: 0.5rem;
    text-align: center;
}

.data-box-flex{
    display: flex;
    justify-content: space-between;
}

.proffesor-info{
    width: 50%;
}

.user-btn-group{
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
}

.user-btn-group button{
    background-color: var(--brown);
    padding: 0.5rem;
    border: 1px solid var(--brown);
    cursor: pointer;
    color: white;
    transition: all 0.3s ease;
}

.user-btn-group button:hover{
    background-color: #966560;
    border: 1px solid #966560;
}

</style>