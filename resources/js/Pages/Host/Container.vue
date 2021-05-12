<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-5">
                <div class="float-left">Host Survey</div>
                <div class="float-right">Joined People: {{numberOfPeople}}</div>
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg m-4">
                <div class="flex space-x-4 flex-col">

                    <InfoDisplayer :titel="joinCodeString(join_key)" :subtitel="'Geben sie diesen Code ein um beizutreten'" :question="currentQuestion" v-if="this.currentQuestion === 0 || ( this.currentQuestion === 1 && this.questionNumberInSync === false)">
                        <div class="shadow border rounded-lg bg-white">
                            <div class="flex items-center rounded-lg space-x-4 p-4">
                                <a :href="'/join/'+this.join_key" target="_blank" title="Join">
                                    <div class="flex items-center p-4 bg-blue-600 text-white rounded-lg">
                                        <span class="material-icons w-7 h-7">open_in_new</span>
                                    </div>
                                </a>
                                <div class="flex-1 rounded-lg">
                                    <p class="text-gray-500 font-semibold">Beigetreten: {{numberOfPeople}}</p>
                                    <div class="flex items-baseline rounded-lg space-x-4">
                                        <h2 class="text-gray-800 text-2xl font-semibold">
                                            {{joinCodeString(join_key)}}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <button @click="startSurvey()" class="block p-3 inline w-full text-lg rounded-lg font-semibold bg-blue-100 text-blue-800 hover:bg-blue-200 cursor-pointer">
                                Start
                            </button>
                        </div>
                    </InfoDisplayer>
                    <div v-else>
                        <LiveResultsDisplayer>

                        </LiveResultsDisplayer>
                        <div class="flex justify-center">
                            <div class="flex flex-row content-around">
                                <button class="block p-3 m-5 text-lg rounded-lg font-semibold bg-blue-700 hover:bg-blue-500 cursor-pointer">Prev</button>
                                <button class="block p-3 m-5 text-lg rounded-lg font-semibold bg-blue-700 hover:bg-blue-500 cursor-pointer">Next</button>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import AppLayout from "../../Layouts/AppLayout";
import InfoDisplayer from "./InfoDisplayer";
import Button from "../../Jetstream/Button";
import LiveResultsDisplayer from "./LiveResultsDisplayer";

export default {
    name: "Container",
    components: {
        Button,
        InfoDisplayer,
        AppLayout,
        LiveResultsDisplayer,
    },
    props: ['join_key'],
    data()  {
        return {
            bluePrintString: "",
            bluePrintData: {},
            numberOfPeople: 0,
            currentQuestion: 0,
            questionNumberInSync: true,
        }
    },
    methods:{
        updateLobby() {
            axios.get('/runLobby',{
                params: {
                    bluePrintString: this.bluePrintString,
                }
            }).then( response => {
                if (response.status === 200){
                    this.numberOfPeople = response.data;
                }
                else
                    this.updateLobby();
            })
        },
        startSurvey(){
            this.questionNumberInSync = false;
            this.currentQuestion++;
        },
        joinCodeString(joinKey){
            let key = joinKey.toString();
            let matchedKey = key.match(/.{1,2}/g);
            return matchedKey.join(' ');
        },
        updateCurrentQuestionToServer(questionNumber){
            this.questionNumberInSync = false;
            axios.post('/host/update',{

                bluePrintString: this.bluePrintString,
                questionNumber: questionNumber,

            }).then( response => {
                if (response.status !== 200){
                    setTimeout(this.updateCurrentQuestionToServer,1000)
                }
                else {
                    this.questionNumberInSync = true;
                }
            }).catch(error => {
                console.log(error);
                setTimeout(this.updateCurrentQuestionToServer,500)
            })
        }
    },
    watch:{
        currentQuestion: function (newValue){
            this.updateCurrentQuestionToServer(newValue);
        }
    },
    created() {
        let url = window.location.href;
        this.bluePrintString = url.split('/').pop();
        axios.get('/getBluePrint',{
            params: {
                bluePrintString: this.bluePrintString,
            }
        }).then( response => {
            if (response.status === 200){
                this.bluePrintData = response.data;
            }
        })
        this.interval = setInterval(() => this.updateLobby(), 5000);
    }

}
</script>

