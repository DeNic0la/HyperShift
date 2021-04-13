<template>
    <div class="flex flex-col mb-4 md:mx-10">

        <div v-for="(question, index) in questions">

            <SurveyResults :question="question" :answer="answers">

            </SurveyResults>
        </div>
    </div>
</template>

<script>
import SurveyResults from "@/Pages/SurveyResults/SurveyResults";
export default {
    name: "SurveyResultsManager",
    components: {SurveyResults},
    props: ['questions','answers'],
}
</script>

<style scoped>

</style>
