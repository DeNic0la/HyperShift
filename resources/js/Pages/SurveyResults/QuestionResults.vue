<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

            <div v-if="question['terminquestion']">
                <SurveyTerminResult :question="question.terminquestion" :answers="answers">

                </SurveyTerminResult>
            </div>

            <div v-if="question['confidencevotequestion']">
                <SurveyConfidenceVoteResult :question="question.confidencevotequestion" :answers="answers">

                </SurveyConfidenceVoteResult>
            </div>

        </div>
    </div>
</template>

<script>
import SurveyTerminResult from "@/Pages/SurveyResults/SurveyTerminResult";
import SurveyConfidenceVoteResult from "@/Pages/SurveyResults/SurveyConfidenceVoteResult";
export default {
    name: "QuestionResults",
    components: {SurveyConfidenceVoteResult, SurveyTerminResult},
    props: ['question', 'answers'],
}
</script>

<style scoped>

</style>
