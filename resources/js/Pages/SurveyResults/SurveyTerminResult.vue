<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.termins">

                <TerminOptions :option="option" :count="doCount(option.id)">

                </TerminOptions>

            </div>
        </div>
    </div>
</template>

<script>
import TerminOptions from "@/Pages/SurveyResults/TerminOptions";
export default {
    name: "SurveyTerminResult",
    components: {TerminOptions},
    props: ['question', 'answers'],
    methods: {
        doCount(id){
            let count = 0;
            console.log(id);
            console.log(this.answers);
            this.answers.forEach(answer => {
                console.log(answer);
                answer.terminanswers.forEach(terminanswer => {
                    console.log(terminanswer);
                        console.log(terminanswer.termin);
                        if(terminanswer.termin.id === id){
                            count++;
                        }
                        else{
                            console.log(terminanswer.termin.id);
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
