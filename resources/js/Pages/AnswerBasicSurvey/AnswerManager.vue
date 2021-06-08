<template>
    <div class="flex flex-col mb-4 md:mx-10">

        <div v-for="(question, index) in questions">

            <AnswerQuestion :question="question" :answer="answers" @CheckboxTicked="$emit('CheckboxTicked',$event)" @ConfidenceValue="$emit('ConfidenceValue',$event)">

            </AnswerQuestion>

        </div>
    </div>
</template>

<script>
import AnswerQuestion from "./AnswerQuestion";
export default {
    name: "AnswerManager",
    components: {AnswerQuestion},
    props: ['questions','answers'],
    emits: ['CheckboxTicked', 'ConfidenceValue'],

}
</script>

<style scoped>

</style>
