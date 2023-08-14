<template>
    <div class="chart">
      <GChart
        type="PieChart"
        :options="options"
        :data="data"
      />    
    </div>
  </template>
   
  <script>
  import { GChart } from "vue-google-charts";
  export default {
    name: "App",
    components: {
      GChart
    },
    data() {
      return {
        data: [
            ['Tip časa', 'Ukupno'],
            ['Nova lekcija',     14],
            ['Vezbanje',      1],
            ['Sistematizacija',  2],
            ['Kontrolni', 2],
            ['Pismeni',    5]
        ],
        options: {
          width: 600,
          height: 400
        }
      };
    }
  };
  </script>
