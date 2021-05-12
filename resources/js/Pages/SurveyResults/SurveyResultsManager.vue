<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div v-for="(question, index) in survey.questions">
            <QuestionResults :question="question" :answers="survey.basicanswers" :confidenceVoteAnswers="confidenceVoteAnswers">

            </QuestionResults>
        </div>
    </div>
</template>

<script>
import QuestionResults from "@/Pages/SurveyResults/QuestionResults";
export default {
    name: "SurveyResultsManager",
    components: {QuestionResults},
    props: ['survey', 'confidenceVoteAnswers'],
    mounted() {
        /*this.survey.questions.forEach(question => {
            console.log(question);
        })*/
        console.log(this.$props.survey);
    }
}

</script>

<style scoped>

</style>
