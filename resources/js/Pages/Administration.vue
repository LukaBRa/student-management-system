<script>

import Sidebar from '../Components/Sidebar.vue';
import Welcome from '../Components/Welcome.vue';
import TotalCard from '../Components/TotalCard.vue';
import Activity from '../Components/Activity.vue';
import GoogleChart from '../Components/GoogleChart.vue';

export default{
    components: {
        Sidebar, Welcome, TotalCard, Activity, GoogleChart
    }
}

</script>

<template>

<div class="container">
    
    <Sidebar />

    <div class="dashboard bg-light">

        <Welcome />

        <div class="total-cards">

            <TotalCard title="Učenici" icon='<i class="fa-solid fa-graduation-cap"></i>' number="120" color="#4682A9"/>
            <TotalCard title="Profesori" icon='<i class="fa-solid fa-user-tie"></i>' number="10" color="#A78295"/>
            <TotalCard title="Časovi" icon='<i class="fa-solid fa-chalkboard-user"></i>' number="49" color="#FF6666"/>

        </div>

        <div class="flex-container">

            <div class="recent-activities">
                <h2>Aktivnosti</h2>

                <div class="activities">
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                    <Activity />
                </div>

            </div>

            <div class="lesson-statistics">
                <GoogleChart />
            </div>

        </div>

    </div>
    
</div>

</template>

<style>

.flex-container{
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
}

.total-cards{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 1rem;
}

.recent-activities{
    background-color: white;
    width: 45%;
    height: 65vh;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activities{
    height: 95%;
    overflow: auto;
}

.lesson-statistics{
    background-color: white;
    height: 65vh;
    display: flex;
    align-items: center;
}

</style>