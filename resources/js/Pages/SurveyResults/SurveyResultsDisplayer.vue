<template>

    <div class="flex flex-col mb-4 md:mx-10">

        <div v-for="(question, index) in questions">
            <ResultsTerminQuestion :question="question" :answer="answers">

            </ResultsTerminQuestion>
        </div>
    </div>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ResultsTerminQuestion from "@/Pages/SurveyResults/ResultsTerminQuestion";
export default {
name: "SurveyResultsDisplayer",
props: ['questions','answers'],
components: {ResultsTerminQuestion, AppLayout}
}
</script>

<style scoped>

</style>
