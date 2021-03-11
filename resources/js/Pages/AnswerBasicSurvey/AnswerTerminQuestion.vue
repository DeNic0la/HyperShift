<template>

        <div class="flex flex-col mb-4 md:mx-10">
            <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        </div>
    {{question}}

    <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
        <div v-for="(option,index) in question.termins">
            <termin-ticker :option="option" :answer="answer">

            </termin-ticker>
        </div>

    </div>
</template>

<script>
import TerminTicker from "./TerminTicker";
export default {
    name: "AnswerTerminQuestion",
    components: {TerminTicker},
    props: ['question', 'answer'],
    methods: {

    },
    beforeCreate() {

    }
}
</script>

<style scoped>

</style>
