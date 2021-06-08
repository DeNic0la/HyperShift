<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.selections">

                <checkbox-options :option="option" :count="amountOfVotes[option.id]">

                </checkbox-options>

            </div>

            <CheckboxChart :options="checkboxOptions" :count="amountOfVotes">

            </CheckboxChart>

        </div>
    </div>
</template>

<script>
import CheckboxOptions from "@/Pages/SurveyResults/CheckboxOptions";
import CheckboxChart from "@/Pages/Charts/CheckboxChart";

export default {
    name: "SurveyCheckboxResults",
    components: {CheckboxChart, CheckboxOptions},
    props: ['question', 'answers'],
    data: function () {
        return {
        }
    },
    computed: {
        checkboxOptions(){
            let options = [];
            this.question.selections.forEach(selection => {
                options.push(selection.content);
            })
            return options;
        },
        amountOfVotes(){
            let count = {};
            this.answers.forEach(answer => {
                answer.checkboxanswers.forEach(checkboxanswer => {
                    count[checkboxanswer.selection.id] = (count[checkboxanswer.selection.id] ?? 0) + 1;
                })
            })
            return count;
        },
    },
}
</script>

<style scoped>

</style>
