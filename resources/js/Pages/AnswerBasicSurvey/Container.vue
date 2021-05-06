<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Umfrage beantworten
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

                    <AnswerManager :answers="answers" :questions="survey['questions']" @CheckboxTicked="updateTerminAnswers($event)" @ConfidenceValue="updateConfidenceAnswers($event)">

                    </AnswerManager>

                    <div class="flex flex-col mb-4 md:mx-10">
                        <button @click="sendAnswers" class="block mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded object-none object-center">
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
            terminAnswers: [],
            confidenceAnswers: [],
            name: "",
        }
    },
    methods:{
        sendAnswers(
        ){
            //ValidateAnswersHereIfneeded

            axios.post('/answerSurvey',null,{
                params:{
                    terminAnswers: this.terminAnswers,
                    confidenceAnswers: this.confidenceAnswers,
                    survey: this.survey.url_string,
                    name: this.name,
                }
            }).then(response => {
                if (response.status === 200){
                    window.location.href = '/';
                }
            })
        },
        updateTerminAnswers(id){
            console.log(id);
            if (this.terminAnswers.includes(id)){
                this.terminAnswers.splice( this.terminAnswers.indexOf(id), 1);
            }
            else {
                this.terminAnswers.push(id);
            }
            const index = array.indexOf(element);
            array.splice(index, 1);
        },
        updateConfidenceAnswers(id){
            console.log(id);
            if (this.confidenceAnswers.includes(id)){
                this.confidenceAnswers.splice( this.confidenceAnswers.indexOf(id), 1);
            }
            else {
                this.confidenceAnswers.push(id);
            }
            const index = array.indexOf(element);
            array.splice(index, 1);
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
                this.survey = response.data;
            }
        })

    }

}
</script>

<style scoped>

</style>
