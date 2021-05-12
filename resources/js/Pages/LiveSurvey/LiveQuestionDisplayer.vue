<template>
    <h3 v-if="currentQuestion > 0" class="TestClassWithNoCss">Frage {{currentQuestion}} von {{AmountOfQuestions}}</h3>
    <LiveQuestionManager @CheckboxTicked="updateArray($event)" :question="question" :isDisabled="questionIsAnswered">

    </LiveQuestionManager>
    <div class="flex flex-col mb-4 md:mx-10">
        <button @click="sendAnswers"  class="block mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded object-none object-center" v-if="!questionIsAnswered">
            Antwort absenden
        </button>
    </div>

</template>

<script>
import LiveQuestionManager from "./LiveQuestionManager";
export default {
    name: "LiveQuestionDisplayer",
    props:['Key','currentQuestionNumber','AmountOfQuestions'],
    components:{LiveQuestionManager},
    methods:{
        sendAnswers(){
            axios.post('/live/answer',null,{
                params:{
                    answers: this.answers,
                    Key: this.Key,
                    questionNumber: this.currentQuestion,
                }
            }).then(response => {
                if (response.status === 200){
                    this.questionIsAnswered = true;
                }
            })
        },
        fetchQuestionInfo(){
            axios.get('/live/question',{
                params: {
                    Key: this.Key,
                    lastKnownQuestion: this.currentQuestion,
                },
                data: {
                    Key: this.Key,
                    lastKnownQuestion: this.currentQuestion,
                }
            }).then( response => {
                if (response.status === 200){
                    if (response.data.newQuestion === true){
                        this.question = response.data.question;
                        this.currentQuestion = response.data.currentQuestion;
                        //Unlock Survey
                        this.questionIsAnswered = false;
                    }
                    else {
                        //Maybe Decrease interval here

                    }
                }
            })
        },
        updateArray(id){
            console.log(id);
            if (this.answers.includes(id)){
                this.answers.splice( this.answers.indexOf(id), 1);
            }
            else {
                this.answers.push(id);
            }
        },
    },

    data: function (){
        return {
            currentQuestion: 0,
            intervalTimeOut: 3000,
            question: null,
            myInterval: null,
            answers: [],
            questionIsAnswered: false,
        }
    },
    created() {
        this.myInterval = setInterval(() => this.fetchQuestionInfo(), this.intervalTimeOut);
        this.currentQuestion =  this.currentQuestionNumber !== 1 ? this.currentQuestionNumber : 0;
    }
}
</script>

<style scoped>

</style>
