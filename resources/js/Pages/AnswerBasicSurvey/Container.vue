<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Umfrage beantworten
            </h2>
        </template>


        <dialog-modal :max-width="'sm'" :show="showMessage" @close="goHome">
            <template #title>
                <div class="text-center">
                    Wollen Sie die Resultate ansehen?
                </div>
            </template>

            <template #content>
                <div class="relative text-gray-600 focus-within:text-gray-400 flex flex-row justify-center space-x-5">
                    <button @click="goToResults()" class="w-36 font-semibold py-2 px-4 border text-white rounded border-result-border hover:border-result-boarderhover bg-result hover:bg-result-hover">
                        Resultate
                    </button>
                    <button @click="goHome()" class="w-36 font-semibold py-2 px-4 border text-white rounded border-code-border hover:border-code-boarderhover bg-code hover:bg-code-hover">
                        Home
                    </button>
                </div>
            </template>

            <template #footer>
                <secondary-button @click.native="goHome">
                    Home
                </secondary-button>
            </template>
        </dialog-modal>


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

                    <AnswerManager :answers="answers" :questions="survey['questions']" @CheckboxTicked="updateTerminAnswers($event)" @ConfidenceValue="updateConfidenceAnswers($event)" @CheckboxAnswerTicked="updateCheckboxAnswers($event)">

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
import DialogModal from "../../Jetstream/DialogModal";
import AnswerManager from "./AnswerManager";
export default {
    name: "Container",
    components: {
        AnswerManager,
        SurveyDisplayer,
        AppLayout,
        DialogModal,
    },
    data()  {
        return {
            surveyString: "",
            survey: [],
            terminAnswers: [],
            checkboxAnswers: [],
            confidenceAnswers: {},
            name: "",
            showMessage: false,
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
                    checkboxAnswers: this.checkboxAnswers,
                    survey: this.survey.url_string,
                    name: this.name
                }
            }).then(response => {
                if (response.status === 200){
                    this.showMessage = true;
                }
            })
        },
        updateTerminAnswers(id){
            if (this.terminAnswers.includes(id)){
                this.terminAnswers.splice( this.terminAnswers.indexOf(id), 1);
            }
            else {
                this.terminAnswers.push(id);
            }
        },
        updateCheckboxAnswers(id){
            if (this.checkboxAnswers.includes(id)){
                this.checkboxAnswers.splice( this.checkboxAnswers.indexOf(id), 1);
            }
            else {
                this.checkboxAnswers.push(id);
            }
        },
        updateConfidenceAnswers(value){
            this.confidenceAnswers[value.questionId] = value.value;
        },
        goHome(){
            window.location.href = '/'
        },
        goToResults(){
            let resultsLocation = document.getElementById("baseURL").getAttribute('content') + '/survey/results/'+this.survey.url_string
            window.location.assign(resultsLocation)
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
            if (response.status === 200) {
                this.survey = response.data;
                this.survey.questions.forEach(surveyQuestion => {
                    if (surveyQuestion.confidencevotequestion !== null) {
                            this.confidenceAnswers[surveyQuestion.confidencevotequestion.id] = 1;
                    }
                })
            }
        })
    }

}
</script>

<style scoped>

</style>
