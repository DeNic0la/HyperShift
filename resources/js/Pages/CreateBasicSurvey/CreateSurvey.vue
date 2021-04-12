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

                <div class="relative text-gray-600 focus-within:text-gray-400">

                    <input type="text" id="copyValue" :value="toCopy" class="py-2 text-sm rounded-md w-2/3 pl-2 focus:outline-none focus:bg-white focus:text-gray-900">
                    <button @click="copyCode" :class="buttonStyles" class="font-semibold py-2 px-4 ml-5 border rounded">
                        {{buttonText}}
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
                    <div class="flex flex-col mb-4 md:mx-10" v-if="errors.length">
                        <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg" v-for="error in errors">
                            {{ error }}
                        </div>
                    </div>
                    <div class="flex flex-col mb-4 md:mx-10">
                        <label class="mb-2 font-bold text-lg text-grey-darkest" for="SurveyName">Name der Umfrage:</label>
                        <input type="text" v-model="surveyName" id="SurveyName" class="border py-2 px-3 text-grey-darkest" name="name">
                    </div>
                    <div class="flex flex-col mb-4 md:mx-10">
                        <QuestionManager :questions="questions">

                        </QuestionManager>
                    </div>


                    <div class="flex flex-col mb-4 md:mx-10">
                        <div class="flex justify-around items-stretch px-12">
                            <button @click="createSurvey(1)" class="block mx-auto bg-pink-500 border border-pink-800 hover:bg-pink-700 text-white font-bold py-4 px-10 rounded object-none object-center">
                                Umfrage erstellen
                            </button>
                            <button @click="createSurvey(2)" class="block mx-auto bg-blue-500 border border-blue-800 hover:bg-blue-700 text-white font-bold py-4 px-10 rounded object-none object-center">
                                Blueprint erstellen
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </app-layout>



</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import ActionMessage from "../../Jetstream/ActionMessage";
import ConfirmationModal from "../../Jetstream/ConfirmationModal";
import DialogModal from "../../Jetstream/DialogModal";
import QuestionManager from "./QuestionManager";
export default {
    name: "CreateSurvey",
    components: {
        QuestionManager,
        DialogModal,
        ConfirmationModal,
        ActionMessage,
        AppLayout,
    },
    data: function () {
        return{
            surveyName: "",
            errors: [],
            showMessage: false,
            url_string: "",
            creatingFailed: false,
            toCopy: "",
            buttonStyles: {
                'bg-transparent':true,
                'hover:bg-blue-500':true,
                'text-blue-700':true,
                'hover:text-white': true,
                'border-blue-500':true,
                'hover:border-transparent':true,
                'bg-opacity-75': false,
                'bg-green-700': false,
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

                axios.post(url,{
                    name: this.surveyName,
                    questions: this.questions,
                }).then( response =>{
                    if (response.status === 201){
                        console.log(response.data['url_string']);
                        this.url_string = response.data['url_string'];
                        this.showMessage = true;
                        this.toCopy = document.getElementById("baseURL").getAttribute('content') + (pressedButton === 1 ? '/survey/fill/':'/host/' )+this.url_string;
                    }else{
                        this.creatingFailed = true;
                        setTimeout(() => {
                            this.creatingFailed = false;
                        }, 10*1000)
                    }
                });
            }
        },
        validateFields(){
            return true;
        },
        goHome(){
            window.location.href = '/'
        },
        copyCode(){
            //this.toCopy  =
            let testingCodeToCopy = document.querySelector('#copyValue')
            testingCodeToCopy.select()

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';

                this.buttonStyles = this.negateAllValues(this.buttonStyles);
                this.buttonText = "Text Kopiert";
                setTimeout(() => {
                    this.buttonStyles = this.negateAllValues(this.buttonStyles);
                    this.buttonText = "Kopieren";
                }, 3*1000)

            } catch (err) {
                alert('Oops, unable to copy');
            }

            /* unselect the range */
            window.getSelection().removeAllRanges()
        },negateAllValues(obj){
            Object.keys(obj).forEach(function(key){ obj[key] = !obj[key] });
            return obj;
        }
    }
}
</script>

<style scoped>

</style>
