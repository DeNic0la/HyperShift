<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-5">
                <div class="float-left">Live Survey</div>
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg m-4">
                <div class="flex space-x-4 flex-col">
                    <InfoDisplayer v-if="currentQuestion === 0" :titel="'Sie sind der Umfrage beigetreten'" :subtitel="'warten sie bis der Host mit der Umfrage Startet.'">
                        <SurveyDisplayer v-bind:name="BluePrint.survey_name" v-bind:creator="BluePrint.user?.name">

                        </SurveyDisplayer>
                    </InfoDisplayer>
                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import AppLayout from "../../Layouts/AppLayout";
import SurveyDisplayer from "../AnswerBasicSurvey/SurveyDisplayer";
import InfoDisplayer from "../Host/InfoDisplayer";


export default {
    name: "Container",
    components: {
        AppLayout,
        SurveyDisplayer,
        InfoDisplayer,
    },
    props: ['Key','BluePrint'],
    data()  {
        return {
            currentQuestion: 0,
        }
    },
    methods:{
        updateQuestion(){
            axios.get('/live/update',{
                params: {
                    Key: this.Key,
                }
            }).then( response => {
                if (response.status === 200){
                    if (response.data > 0)
                        this.currentQuestion = response.data;
                }
            })
        },
    },
    created() {
        this.interval = setInterval(() => this.updateQuestion(), 5000);
    },
    beforeDestroy() {
        axios.get('/leave/'+this.Key);
    }

}
</script>

