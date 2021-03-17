<template>
    <div class="flex flex-col mb-4 md:mx-10">

        <div v-for="(question, index) in questions">
            <AnswerTerminQuestion :question="question" :answer="answers" @CheckboxTicked="$emit('CheckboxTicked',$event)">

            </AnswerTerminQuestion>
        </div>
    </div>
</template>

<script>
import AnswerTerminQuestion from "./AnswerTerminQuestion";
export default {
    name: "AnswerManager",
    components: {AnswerTerminQuestion},
    props: ['questions','answers'],
    emits: ['CheckboxTicked'],

}
</script>

<style scoped>

</style>
