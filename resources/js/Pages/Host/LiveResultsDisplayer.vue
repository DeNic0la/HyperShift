<template>

    <div class="w-full p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <div class="p-5 flex-auto justify-center">
            <div v-if="question.terminquestion !== null">
                <LiveTerminResult :question="question.terminquestion" :answers="answer"/>
            </div>
            <div v-else-if="question.confidencevotequestion !== null">
                <SurveyConfidenceVoteResult :answer="sortedConfidenceVote" :question="question.confidencevotequestion" />
            </div>

        </div>
    </div>
</template>

<script>
import SurveyConfidenceVoteResult from "../SurveyResults/SurveyConfidenceVoteResult";
import LiveTerminResult from "../LiveSurvey/LiveTerminResult";
export default {
    name: "LiveResultsDisplayer",
    components:{LiveTerminResult, SurveyConfidenceVoteResult},
    props: ['question','bluePrintString'],
    methods:{
        getAnswers(){
            axios.get('/host/result',{
                params:{
                    bluePrintString: this.bluePrintString,
                    questionId: this.question.id
                }
            })
            .then(response => {
                if (response.status === 200){
                    this.answer = response.data;
                }
            })
        },
    },
    computed:{
        sortedConfidenceVote(){
            let results = {};
            if (Object.keys(this.answer).length === 0||this.question.confidencevotequestion === undefined){
                return results;
            }
            this.answer.forEach(confidenceanswer => {
                if(results.hasOwnProperty(confidenceanswer.value)) {
                    results[confidenceanswer.value]++;
                }
                else{
                    results[confidenceanswer.value] = 1;
                }
            })
            return results;
        }
    },
    data()  {
        return {
            answer: {}
        }
    },
    mounted() {
        this.interval = setInterval(this.getAnswers, 3000);
    }
}
</script>

<style scoped>

</style>
