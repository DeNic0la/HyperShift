<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.selections">
                <checkbox-ticker :option="option" :answer="answer" @CheckboxAnswerTicked="$emit('CheckboxAnswerTicked',$event)">

                </checkbox-ticker>
            </div>

        </div>


    </div>
</template>

<script>
import CheckboxTicker from "@/Pages/AnswerBasicSurvey/CheckboxTicker";

export default {
    name: "AnswerCheckboxQuestion",
    components: {CheckboxTicker},
    props: ['question', 'answer'],
    emits: ['CheckboxAnswerTicked'],
}
</script>

<style scoped>

</style>
