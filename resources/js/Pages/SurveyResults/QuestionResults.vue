<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

            <SurveyTerminResult :question="question.terminquestion" :answers="answers">

            </SurveyTerminResult>

        </div>


    </div>


</template>

<script>
import SurveyTerminResult from "@/Pages/SurveyResults/SurveyTerminResult";
export default {
    name: "SurveyResults",
    components: {SurveyTerminResult},
    props: ['question', 'answers'],
}
</script>

<style scoped>

</style>
