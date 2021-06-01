<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

            <div v-if="question['terminquestion']">
                <AnswerTerminQuestion :question="question['terminquestion']" :answer="answers" @CheckboxTicked="$emit('CheckboxTicked',$event)">

                </AnswerTerminQuestion>
            </div>

            <div v-if="question['confidencevotequestion']">
                <AnswerConfidenceQuestion :question="question['confidencevotequestion']" :answer="answers" @ConfidenceValue="$emit('ConfidenceValue',$event)">

                </AnswerConfidenceQuestion>
            </div>

            <div v-if="question['checkboxquestion']">
                <AnswerCheckboxQuestion :question="question['checkboxquestion']" :answer="answers" @CheckboxAnswerTicked="$emit('CheckboxAnswerTicked',$event)">

                </AnswerCheckboxQuestion>
            </div>

        </div>


    </div>


</template>

<script>
import AnswerTerminQuestion from "./AnswerTerminQuestion";
import AnswerConfidenceQuestion from "./AnswerConfidenceQuestion";
import AnswerCheckboxQuestion from "@/Pages/AnswerBasicSurvey/AnswerCheckboxQuestion";
export default {
    name: "AnswerQuestion",
    components: {AnswerCheckboxQuestion, AnswerTerminQuestion, AnswerConfidenceQuestion},
    props: ['question', 'answer'],
    emits: ['CheckboxTicked', 'ConfidenceValue', 'CheckboxAnswerTicked'],
    methods: {

    },

}
</script>

<style scoped>

</style>
