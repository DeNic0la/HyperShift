<template>

        <div class="flex flex-col mb-4 md:mx-10">
            <div class="mb-2 text-grey-darkest">{{question.name}}</div>

            <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
                <div v-for="option in question.termins" v-bind:key="option.id">
                    <termin-ticker :answers="answers" :option="option" @CheckboxTicked="$emit('CheckboxTicked',$event)" :isDisabled="isDisabled">

                    </termin-ticker>
                </div>

            </div>


        </div>


</template>

<script>
import TerminTicker from "./TerminTicker";
export default {
    name: "AnswerTerminQuestion",
    components: {TerminTicker},
    props: ['question','isDisabled','answers'],
    emits: ['CheckboxTicked'],
    methods: {

    },
    beforeCreate() {

    }
}
</script>

<style scoped>

</style>
