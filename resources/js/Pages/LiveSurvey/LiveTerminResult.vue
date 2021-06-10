<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question?.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.termins">

                <TerminOptions :option="option" :count="answers[option.id]">

                </TerminOptions>

            </div>
        </div>
    </div>
</template>

<script>
import TerminOptions from "../SurveyResults/TerminOptions";
export default {
    name: "LiveTerminResult",
    props:['question','answers'],
    components:{TerminOptions},
}
</script>

<style scoped>

</style>
