<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Umfrage Resultate
            </h2>
        </template>

            <div class="container mx-auto pt-5">
                <div class="w-full bg-white rounded shadow-lg p-8 m-4">
                    <div class="flex space-x-4 flex-col">
                        <SurveyDisplayer :name="survey['survey_name']" :creator="survey.user?.name">

                        </SurveyDisplayer>

                        <label v-if="$page.props.user == null">
                            <div class="flex flex-col mb-4 md:mx-10">
                                <div class="mb-2 text-grey-darkest">Dein Name: </div>
                                <input type="text" v-model="name">
                            </div>
                        </label>

                        <SurveyResultsManager :answers="answers" :questions="survey['questions']">

                        </SurveyResultsManager>

                    </div>
                </div>
            </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SurveyResultsManager from "@/Pages/SurveyResults/SurveyResultsManager";
import SurveyDisplayer from "@/Pages/AnswerBasicSurvey/SurveyDisplayer";
export default {
    name: "Container",
    components: {
        SurveyDisplayer,
        SurveyResultsManager,
        AppLayout
    },
    data()  {
        return {
            surveyString: "",
            survey: [],
            answers: [],
            name: "",
        }
    },
    created() {
        let url = window.location.href;
        this.surveyString = url.split('/').pop();
        axios.get('/getResults', {
            params: {
                surveyString: this.surveyString,
            }
        }).then(response => {
            if (response.status === 200) {
                this.survey = response.data;
            }
        })
    }
}
</script>

<style scoped>

</style>
