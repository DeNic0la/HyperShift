<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div v-for="(question, index) in survey.questions">
            <QuestionResults :question="question" :answers="survey.basicanswers" :confidenceVoteAnswers="confidenceVoteAnswers" :checkboxAnswers="checkboxAnswers">

            </QuestionResults>
        </div>
    </div>
</template>

<script>
import QuestionResults from "@/Pages/SurveyResults/QuestionResults";
export default {
    name: "SurveyResultsManager",
    components: {QuestionResults},
    props: ['survey', 'confidenceVoteAnswers', 'checkboxAnswers'],
    mounted() {
        console.log(this.$props.survey);
    }
}

</script>

<style scoped>

</style>
