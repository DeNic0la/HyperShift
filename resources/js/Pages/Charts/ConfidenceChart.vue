<template>
    <div class="example">
        <apexcharts width="500" height="350" type="area" :options="chartOptions" ref="realtimeChart" :series="series"></apexcharts>
    </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts';
export default {
    name: 'ConfidenceChart',
    props: ['answer', 'maxValue'],
    components: {
        apexcharts: VueApexCharts,
    },
    methods: {
        mapChartData(){
            let dataX = [];
            let dataY = [];
            for(let i = 1; i <= this.maxValue; i++){
                dataX.push(i);
                dataY.push(this.answer[i] || 0);
            }
            this.chartOptions.xaxis.categories = dataX;
            this.series[0].data = dataY;

            //return value === 1 ? dataY: dataX;
        }
    },
    watch:{
        answer: function (oldVal,newVal){
            let dataY = [];
            for(let i = 1; i <= this.maxValue; i++){
                dataY.push(this.answer[i] || 0);
            }
            this.series = [{
                name: 'Resultat',
                data: dataY,
            }];
        }
    },
    data: function() {
        return {
            chartOptions: {
                chart: {
                    id: 'basic-bar',
                    type: 'area'
                },
                xaxis: {
                    categories: [1, 2, 3],
                },
                stroke: {
                    curve: 'smooth',
                }
            },
            series: [{
                name: 'Resultat',
                data: [14, 11, 23],
            }]
        }
    },
    beforeUpdate() {
        this.mapChartData();
    },
    created() {
        this.mapChartData();
    }
}
</script>
