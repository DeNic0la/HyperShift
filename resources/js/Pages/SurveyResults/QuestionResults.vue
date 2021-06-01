<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

            <div v-if="question['terminquestion']">
                <SurveyTerminResult :question="question.terminquestion" :answers="answers">

                </SurveyTerminResult>
            </div>

            <div v-if="question['confidencevotequestion']">
                <SurveyConfidenceVoteResult :question="question.confidencevotequestion" :answer="confidenceVoteAnswers[question.confidencevotequestion.id]">

                </SurveyConfidenceVoteResult>
            </div>

            <div v-if="question['checkboxquestion']">
                <SurveyCheckboxResults :question="question.checkboxquestion" :answers="answers">

                </SurveyCheckboxResults>
            </div>

        </div>
    </div>
</template>

<script>
import SurveyTerminResult from "@/Pages/SurveyResults/SurveyTerminResult";
import SurveyConfidenceVoteResult from "@/Pages/SurveyResults/SurveyConfidenceVoteResult";
import SurveyCheckboxResults from "@/Pages/SurveyResults/SurveyCheckboxResults";
export default {
    name: "QuestionResults",
    components: {SurveyCheckboxResults, SurveyConfidenceVoteResult, SurveyTerminResult},
    props: ['question', 'answers', 'confidenceVoteAnswers'],
}
</script>

<style scoped>

</style>
