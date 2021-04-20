<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

            <AnswerTerminQuestion :question="question['terminquestion']" :answer="answers" @CheckboxTicked="$emit('CheckboxTicked',$event)">

            </AnswerTerminQuestion>


            <div v-if="question.type === 2">
            <AnswerConfidenceQuestion :question="question" :answer="answers">

            </AnswerConfidenceQuestion>
            </div>

        </div>


    </div>


</template>

<script>
import AnswerTerminQuestion from "./AnswerTerminQuestion";
import AnswerConfidenceQuestion from "./AnswerConfidenceQuestion";
export default {
    name: "AnswerQuestion",
    components: {AnswerTerminQuestion, AnswerConfidenceQuestion},
    props: ['question', 'answer'],
    emits: ['CheckboxTicked'],
    methods: {

    },
    beforeCreate() {

    }
}
</script>

<style scoped>

</style>
