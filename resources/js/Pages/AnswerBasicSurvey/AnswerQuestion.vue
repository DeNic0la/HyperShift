<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

            <AnswerTerminQuestion :question="question['terminquestion']" @CheckboxTicked="$emit('CheckboxTicked',$event)">

            </AnswerTerminQuestion>

        </div>


    </div>


</template>

<script>
import AnswerTerminQuestion from "./AnswerTerminQuestion";
export default {
    name: "AnswerQuestion",
    components: {AnswerTerminQuestion},
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
