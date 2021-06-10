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
                        <SurveyDisplayer :name="survey.survey_name" :creator="survey.user?.name">

                        </SurveyDisplayer>

                        <SurveyResultsManager v-if="survey.length !== 0" :survey="survey" :confidenceVoteAnswers="confidenceVoteAnswers" :checkboxAnswers="checkboxAnswers">

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
            survey: {},
            name: "",
            confidenceVoteAnswers: {},
            checkboxAnswers: {}
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
                this.sortConfidenceVote(this.survey.basicanswers);
                this.sortCheckbox(this.survey.basicanswers);
            }
        })
    },
    methods: {
        sortConfidenceVote(answers){
            let results = {};
            answers.forEach(answer => {
                if(answer.confidencevoteanswer !== null){
                    answer.confidencevoteanswer.forEach(confidenceanswer => {
                        if(!results.hasOwnProperty(confidenceanswer.questionId)){
                            results[confidenceanswer.questionId] = {};
                        }
                        if(results[confidenceanswer.questionId].hasOwnProperty(confidenceanswer.value)) {
                            results[confidenceanswer.questionId][confidenceanswer.value]++;
                        }
                        else{
                            results[confidenceanswer.questionId][confidenceanswer.value] = 1;
                        }
                    })
                }
            })
           this.confidenceVoteAnswers = results;
        },
        sortCheckbox(answers){
            let results = {};
            this.survey.questions.forEach(question => {
                if(question.hasOwnProperty("checkboxquestion")){
                    question.checkboxquestion.selections.forEach(selection => {
                        results[selection.id] = {content: selection.content, count: 0};
                    })
                }
            })
            answers.forEach(answer => {
                if(answer.checkboxanswers !== null){
                    console.log(answer.checkboxanswers);
                    for(let i = 0; i < answer.checkboxanswers.length; i++){
                        results[answer.checkboxanswers[i].selectionId].count += 1;
                    }
                }
            })
            this.checkboxAnswers = results;
        },

    }
}
</script>

<style scoped>

</style>
