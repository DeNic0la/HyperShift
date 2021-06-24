<template>

    <h3 v-if="currentQuestion > 0" class="TestClassWithNoCss">Frage {{currentQuestion}} von {{AmountOfQuestions}}</h3>
    <div v-else class="absolute inset-0 z-10 bg-white opacity-80" >
        <div class="z-30 items-center justify-center pt-12">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="top-1/2" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <path fill="none" stroke="#000000" stroke-width="8" stroke-dasharray="42.76482137044271 42.76482137044271" d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z" stroke-linecap="round" style="transform:scale(0.8);transform-origin:50px 50px">
                    <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0;256.58892822265625"></animate>
                </path>
            </svg>

        </div>
    </div>

    <LiveQuestionManager @CheckboxTicked="updateArray($event)" :question="question" :answers="answers" :isDisabled="questionIsAnswered" v-if="question !== null">

    </LiveQuestionManager>
    <div class="flex flex-col mb-4 md:mx-10" v-if="question !== null">
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
                    this.answeredQuestions[this.question.id] = {answers: this.answers};
                    this.answers = [];
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
                        if (this.answeredQuestions[this.question.id]?.answers === undefined){
                            this.answers = [];
                            this.questionIsAnswered = false;
                        }
                        else{
                            this.answers = this.answeredQuestions[this.question.id]?.answers;
                            this.questionIsAnswered = true;
                        }


                    }
                    else if(response.data.surveyIsFinished === true){
                        // Close Survey With Message
                        clearInterval(this.myInterval);
                        window.location.href = '/';
                        //TODO Display cleaner "survy is finished"- Message

                    }
                }
            })
        },
        updateArray(id){
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
            answeredQuestions: {},
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
