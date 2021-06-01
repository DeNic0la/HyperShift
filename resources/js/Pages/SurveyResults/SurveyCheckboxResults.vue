<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.selections">

                <checkbox-options :option="option" :count="doCount(option.id)">

                </checkbox-options>

            </div>
        </div>
    </div>
</template>

<script>
import CheckboxOptions from "@/Pages/SurveyResults/CheckboxOptions";

export default {
    name: "SurveyCheckboxResults",
    components: {CheckboxOptions},
    props: ['question', 'answers'],
    methods: {
        doCount(id){
            let count = 0;
            this.answers.forEach(answer => {
                answer.checkboxanswers.forEach(checkboxanswer => {
                    if(checkboxanswer.selection.id === id){
                        count++;
                    }
                    else{

                    }
                })
            })
            return count;
        }
    },
}
</script>

<style scoped>

</style>
