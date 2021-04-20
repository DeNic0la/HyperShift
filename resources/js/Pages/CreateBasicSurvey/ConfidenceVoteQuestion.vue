<template>
    <label>
        <div class="flex flex-col mb-4 md:mx-10">
            <div class="mb-2 text-grey-darkest">Fragesatz:</div>
            <input type="text" v-model="question.name" class="border py-2 px-3 text-grey-darkest">
        </div>
    </label>
    <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
        <div v-for="(option,index) in question.options">
            <ConfidenceVoteOption :Details="option">

            </ConfidenceVoteOption>
        </div>
    </div>



</template>

<script>
import TerminOption from "./TerminOption";
import ConfidenceVoteOption from "@/Pages/CreateBasicSurvey/ConfidenceVoteOption";
export default {
    name: "ConfidenceVoteQuestion",
    components: {ConfidenceVoteOption},
    props: ['question'],
    data: function (){
        return {
        }
    },
    created() {
        this.question.options = [];
        var toPush = {maxValue: 5};
        this.question.options.push(toPush);

    },
    methods: {
    }
}
</script>

<style scoped>

</style>
