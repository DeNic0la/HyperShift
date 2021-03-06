<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Umfrage erstellen
            </h2>
        </template>

        <confirmation-modal @close="creatingFailed = false" :show="creatingFailed">
            <template #title>
                Fehler
            </template>

            <template #content>
                Beim erstellen der Umfrage ist ein Fehler aufgetreten
            </template>

            <template #footer>
                <secondary-button @click.native="goHome">
                    Home
                </secondary-button>
            </template>
        </confirmation-modal>

        <dialog-modal  :show="showMessage" @close="goHome">
            <template #title>
                Umfrage wurde erstellt!
            </template>

            <template #content>
                <div class="h-8">
                    <CopyLink :isBluePrint="createdBluePrint" :url_string="url_string" :showResultBtn="false">
                    </CopyLink>
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
                    <div class="flex flex-col mb-4 md:mx-10" v-if="errors.length">
                        <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg" v-for="error in errors">
                            {{ error }}
                        </div>
                    </div>
                    <div class="flex flex-col mb-4 md:mx-10">
                        <label class="mb-2 font-bold text-lg text-grey-darkest" for="SurveyName">Name der Umfrage:</label>
                        <input type="text" @blur="writeToLocalStorage" v-model="surveyName" id="SurveyName" class="border py-2 px-3 text-grey-darkest" name="name">
                    </div>
                    <div class="flex flex-col mb-4 md:mx-10">
                        <QuestionManager @questionUpdate="writeToLocalStorage" :questions="questions">

                        </QuestionManager>
                    </div>


                    <div class="flex flex-col mb-4 md:mx-10">
                        <div class="flex justify-around items-stretch px-12">
                            <button @click="createSurvey(1)" class="block mx-auto text-white font-bold py-4 px-10 rounded object-none object-center border-create-border hover:border-create-boarderhover bg-create hover:bg-create-hover">
                                Umfrage erstellen
                            </button>
                            <!--
                            <button @click="createSurvey(2)" class="block mx-auto bg-blue-500 border border-blue-800 hover:bg-blue-700 text-white font-bold py-4 px-10 rounded object-none object-center border-host-border hover:border-host-boarderhover bg-host hover:bg-host-hover">
                                Blueprint erstellen
                            </button>
                            -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </app-layout>



</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import ConfirmationModal from "../../Jetstream/ConfirmationModal";
import DialogModal from "../../Jetstream/DialogModal";
import QuestionManager from "./QuestionManager";
import CopyLink from "@/Pages/CopyLink";
export default {
    name: "CreateSurvey",
    components: {
        QuestionManager,
        DialogModal,
        ConfirmationModal,
        AppLayout,
        CopyLink
    },
    data: function () {
        return{
            surveyName: "",
            errors: [],
            showMessage: false,
            url_string: "",
            createdBluePrint: false,
            creatingFailed: false,
            buttonStyles: {
                'bg-transparent':true,
                'hover:bg-answer-hover':true,
                'text-answer':true,
                'hover:text-white': true,
                'border-answer-border':true,
                'hover:border-transparent':true,
                'bg-opacity-75': false,
                'bg-answer': false,
                'text-gray-800':false,
            },
            buttonText: "Kopieren",
            questions: [],
        }
    },
    methods:{
        createSurvey(pressedButton ){
            this.errors = [];
            if (this.validateFields() && (pressedButton === 1 || pressedButton === 2)){
                const url = pressedButton === 1 ? '/createSurvey': '/createBlueprint';
                console.log(this.errors);

                    if(this.errors.length === 0) {
                    axios.post(url, {
                        name: this.surveyName,
                        questions: this.questions,
                    }).then(response => {
                        if (response.status === 201) {
                            localStorage.removeItem('surveyName');
                            localStorage.removeItem('questions');
                            this.createdBluePrint = pressedButton === 2;
                            this.url_string = response.data['url_string'];
                            this.showMessage = true;
                        } else {
                            this.creatingFailed = true;
                            setTimeout(() => {
                                this.creatingFailed = false;
                            }, 10 * 1000)
                        }
                    });
                }
            }
        },
        writeToLocalStorage(){
          const parsedQuestions = JSON.stringify(this.questions);
          localStorage.setItem('questions',parsedQuestions);
          localStorage.setItem('surveyName',this.surveyName);

        },
        validateFields(){
            if(this.surveyName === ""){
                this.errors.push("Sie müssen einen Umfrage-Namen definieren")
            }
            this.questions.forEach(question => {
                if (question.type === "1") {
                    question.options.forEach(option => {
                        if (question.name === "") {
                            this.errors.push("Sie müssen einen Fragesatz formulieren")
                        }
                        if (option.duration ===  "0" || option.duration === null) {
                            this.errors.push("Die Options-Dauer soll länger als 0 Minuten sein")
                        }
                        if (option.datetime === null) {
                            this.errors.push("Es muss ein Datum gewählt werden")
                        }
                    })
                } else if (question.type === "2") {
                    question.options.forEach(option => {
                        if (question.name === "") {
                            this.errors.push("Sie müssen einen Fragesatz formulieren")
                        }
                        if (option.maxValue <= 0) {
                            this.errors.push("Der Maximal-Wert muss mindestens 1 sein")
                        }
                    })
                } else if (question.type === "3") {
                    question.options.forEach(option => {
                        if (question.name === "") {
                            this.errors.push("Sie müssen einen Fragesatz formulieren")
                        }
                        if (option.content === "" || option.content === null) {
                            this.errors.push("Formulieren Sie eine Antwort-Möglichkeit")
                        }
                    })
                }
            })
            if (this.errors.length === 0) {
                console.dir(this.errors);
                return true
            } else {
                return false
            }
        },
        goHome(){
            window.location.href = '/'
        },
        negateAllValues(obj){
            Object.keys(obj).forEach(function(key){ obj[key] = !obj[key] });
            return obj;
        },
    },
    mounted() {
        if (localStorage.getItem('questions')){
            try{
                this.questions = JSON.parse(localStorage.getItem('questions'));
            }
            catch (e) {
                localStorage.removeItem('questions')
            }
        }

        if (localStorage.getItem('surveyName'))
            this.surveyName = localStorage.getItem('surveyName');
    }
}
</script>

<style scoped>

</style>
