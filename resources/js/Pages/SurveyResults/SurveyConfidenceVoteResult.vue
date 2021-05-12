<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

                <ConfidenceVoteOptions :average="average">

                </ConfidenceVoteOptions>

            </div>
        </div>

</template>

<script>
import ConfidenceVoteOptions from "@/Pages/SurveyResults/ConfidenceVoteOptions";
export default {
    name: "SurveyConfidenceVoteResult",
    components: {ConfidenceVoteOptions},
    props: ['question', 'answer'],
    methods: {
    },
    mounted() {
        console.log(this.answer);
    },
    computed: {
        average: function (){
            let answerCount = 0;
            let totalValue = 0;
            let average = 0;
             for( let [key, value] of Object.entries(this.answer)){
                 answerCount += value;
                 totalValue += (key * value);
             }
             return (totalValue / answerCount).toFixed(3) ;
        }
    }
}
</script>

<style scoped>

</style>
