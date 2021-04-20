<template>
    <div class="inline-flex" style="width: 100%">
        <div style="width: 25%">
            <label>
                <div class="flex flex-col mb-4 md:mx-10">
                    <div class="mb-2 text-grey-darkest">Typ der Frage:</div>
                    <select v-model="question.type">
                        <option hidden value="0" disabled>Wählen Sie eine Option aus</option>
                        <option value="1">Terminfrage</option>
                        <option value="2">Confidence-Vote Frage</option>
                    </select>
                </div>
            </label>
        </div>
        <div style="width: 75%">
            <div v-if="question.type === '1'">
                <termin-question :question="question">

                </termin-question>
            </div>
            <div v-if="question.type === '2'">
                <confidence-vote-question :question="question">

                </confidence-vote-question>
            </div>
        </div>
    </div>
</template>

<script>
import TerminQuestion from "./TerminQuestion";
import ConfidenceVoteQuestion from "@/Pages/CreateBasicSurvey/ConfidenceVoteQuestion";
import DialogModal from "@/Jetstream/DialogModal";
export default {
    name: "Question",
    components: {DialogModal, ConfidenceVoteQuestion, TerminQuestion},
    props: ['question'],
}
</script>

<style scoped>

</style>
