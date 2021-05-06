<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >

                <ConfidenceVoteOptions :average="avarage()">

                </ConfidenceVoteOptions>

            </div>
        </div>

</template>

<script>
import ConfidenceVoteOptions from "@/Pages/SurveyResults/ConfidenceVoteOptions";
export default {
    name: "SurveyConfidenceVoteResult",
    components: {ConfidenceVoteOptions},
    props: ['question', 'answers'],
    methods: {
        avarage(){
            let count = 0;
            let amount = 0;
            console.log(this.answers);
            this.answers.forEach(answer => {
                console.log(answer);
                answer.confidencevoteanswer.forEach(confidencevoteanswer => {
                    console.log(confidencevoteanswer);
                    console.log(confidencevoteanswer.value);
                        count++;
                        amount+= confidencevoteanswer.value;
                })
            })
            let average = amount / count;
            return average;
        }
    },
}
</script>

<style scoped>

</style>
