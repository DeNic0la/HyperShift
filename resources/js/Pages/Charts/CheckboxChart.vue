<template>
    <div class="example">
        <apexcharts width="500" height="350" type="bar" :options="chartOptions" :series="series"></apexcharts>
    </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts';
export default {
    name: "CheckboxChart",
    props: ['options', 'answers'],
    components: {
        apexcharts: VueApexCharts,
    },
    methods: {
        mapChartData(){
            let dataX = [];
            let dataY = [];
            this.answers.forEach(answer => {
                dataX.push(answer.content);
                dataY.push(answer.count);
            })
            this.chartOptions.xaxis.categories = dataX;
            this.series[0].data = dataY;
        }
    },
    data: function() {
        return {
            chartOptions: {
                chart: {
                    id: 'basic-bar',
                    type: 'bar'
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

<style scoped>

</style>
