<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meine Umfragen
            </h2>
        </template>

        <div class="container mx-auto pt-5" v-for="(item,index) in survey">
            <div class="w-full bg-white rounded shadow-lg p-8 m-4">
                <div class="flex space-x-4 flex-col">

                    <CopyLink  :url_string="item['url_string']" :id="index">
                    </CopyLink>

                </div>
            </div>
        </div>

    </app-layout>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SurveyDisplayer from "../AnswerBasicSurvey/SurveyDisplayer";
import MySurveysDisplayer from "@/Pages/MySurveys/MySurveysDisplayer";
import CopyLink from "@/Pages/CopyLink";
export default {
    name: "MySurveys",
    components: {
        CopyLink,
        MySurveysDisplayer,
        SurveyDisplayer,
        AppLayout
    },
    data()  {
        return {
            survey: [],
        }
    },
    created() {
        axios.get('/getUserSurveys')
        .then( response => {
            if (response.status === 200){
                this. survey = response.data;
            }
        })
    }
}
</script>

<style scoped>

</style>
