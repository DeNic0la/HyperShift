<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Umfrage Beantworten
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg p-8 m-4">
                <div class="flex space-x-4 flex-col">
                    <SurveyDisplayer :name="survey['survey_name']" :creator="survey.user?.name">

                    </SurveyDisplayer>

                    <AnswerManager :answers="answers" :questions="survey['terminfrages']">

                    </AnswerManager>

                    <div class="flex flex-col mb-4 md:mx-10">
                        <button class="block mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded object-none object-center">
                            Antwort absenden
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import SurveyDisplayer from "./SurveyDisplayer";
import AppLayout from "../../Layouts/AppLayout";
import AnswerManager from "./AnswerManager";
export default {
    name: "Container",
    components: {
        AnswerManager,
        SurveyDisplayer,
        AppLayout
    },
    data()  {
        return {
            surveyString: "",
            survey: [],
            answers: [],
        }
    },
    created() {
        let url = window.location.href;
        this.surveyString = url.split('/').pop();
        axios.get('/getSurvey',{
            params: {
                surveyString: this.surveyString,
            }
        }).then( response => {
            if (response.status === 200){
                this. survey = response.data;
            }
        })

    }

}
</script>

<style scoped>

</style>
