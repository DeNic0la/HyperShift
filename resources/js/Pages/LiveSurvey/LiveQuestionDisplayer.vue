<template>
    <h3>Frage {{currentQuestion}} von {{AmountOfQuestions}}</h3>
    <LiveQuestionManager @CheckboxTicked="updateArray($event)" :question="question">

    </LiveQuestionManager>
    <div class="flex flex-col mb-4 md:mx-10">
        <button @click="sendAnswers" class="block mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded object-none object-center">
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
        updateQuestionToParent(){
            this.$emit('update:currentQuestionNumber', this.currentQuestion );
        },
        sendAnswers(){
            axios.post('/live/answer',null,{
                params:{
                    answers: this.answers,
                    Key: this.Key,
                }
            }).then(response => {
                if (response.status === 200){
                    //Lock Survey
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
                    clearInterval(this.myInterval);
                    if (response.data.newQuestion === true){
                        this.intervalTimeOut = 5000;
                        this.question = response.data.question;
                        this.currentQuestion = response.data.currentQuestion;
                        this.updateQuestionToParent();
                        //Unlock Survey
                    }
                    else {
                        //Maybe Decrease interval here
                        if (this.intervalTimeOut > 5000 )
                            console.log('going into Long Delay')
                        else if (this.intervalTimeOut <= 500)
                            this.intervalTimeOut = 10000;
                        else if (this.intervalTimeOut <= 1000 )
                            this.intervalTimeOut -= 50;
                        else
                            this.intervalTimeOut -= 1000;
                    }
                    this.myInterval = setInterval(() => this.fetchQuestionInfo(), this.intervalTimeOut);

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
            intervalTimeOut: 5000,
            question: null,
            myInterval: null,
            answers: [],
        }
    },
    emits: ['update:currentQuestionNumber'],
    created() {
        this.myInterval = setInterval(() => this.fetchQuestionInfo(), this.intervalTimeOut);
        this.currentQuestion =  this.currentQuestionNumber !== 1 ? this.currentQuestionNumber : 0;
    }
}
</script>

<style scoped>

</style>
