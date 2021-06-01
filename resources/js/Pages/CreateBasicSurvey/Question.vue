<template>
    <div class="inline-flex w-full">
        <div class="w-3/12">
            <label>
                <div class="flex flex-col mb-4 md:mx-10">
                    <div class="mb-2 text-grey-darkest">Typ der Frage:</div>
                    <select v-model="question.type">
                        <option hidden value="0" disabled>Wählen Sie eine Option aus</option>
                        <option value="1">Terminfrage</option>
                        <option value="2">Confidence-Vote Frage</option>
                        <option value="3">Checkbox-Frage</option>
                    </select>
                </div>
            </label>
        </div>
        <div class="w-8/12">
            <div v-if="question.type === '1'">
                <termin-question @questionUpdate="$emit('questionUpdate')" :question="question">

                </termin-question>
            </div>
            <div v-if="question.type === '2'">
                <confidence-vote-question @questionUpdate="$emit('questionUpdate')" :question="question">

                </confidence-vote-question>
            </div>
            <div v-if="question.type === '3'">
                <checkbox-question @questionUpdate="$emit('questionUpdate')" :question="question">

                </checkbox-question>
            </div>
        </div>
        <div class="w-1/12 pt-5">
            <button @click="$emit('deleteQuestion',question.name)">
                <XIcon class="text-gray-300 w-8 h-8 hover:text-red-700 cursor-pointer"></XIcon>
            </button>
        </div>
    </div>
</template>

<script>
import TerminQuestion from "./TerminQuestion";
import ConfidenceVoteQuestion from "@/Pages/CreateBasicSurvey/ConfidenceVoteQuestion";
import DialogModal from "@/Jetstream/DialogModal";
import {XIcon} from "@heroicons/vue/outline";
import CheckboxQuestion from "@/Pages/CreateBasicSurvey/CheckboxQuestion";
export default {
    name: "Question",
    emits:['questionUpdate','deleteQuestion'],
    components: {CheckboxQuestion, DialogModal, ConfidenceVoteQuestion, TerminQuestion, XIcon},
    props: ['question'],
}
</script>

<style scoped>

</style>
