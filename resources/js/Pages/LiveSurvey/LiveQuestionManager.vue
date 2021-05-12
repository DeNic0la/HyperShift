<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <AnswerQuestion :question="question" @CheckboxTicked="$emit('CheckboxTicked',$event)" :isDisabled="isDisabled">

        </AnswerQuestion>
    </div>
</template>

<script>
import AnswerQuestion from "../AnswerBasicSurvey/AnswerQuestion";

export default {
    name: "LiveQuestionManager",
    props:['question','isDisabled'],
    components:{AnswerQuestion},
    emits:['CheckboxTicked'],

}
</script>

<style scoped>

</style>
