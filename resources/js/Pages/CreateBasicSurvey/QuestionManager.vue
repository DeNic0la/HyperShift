<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div v-for="(question, index) in questions">
            <question @deleteQuestion="deleteQuestion($event)" @questionUpdate="$emit('questionUpdate')" :question="question">

            </question>

        </div>

        <div class="inline-flex">
            <button @click="addQuestion"  class=" w-2/3 block mx-auto bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded object-none object-center border-add-border hover:border-add-boarderhover bg-add hover:bg-add-hover">
                + Frage Hinzufügen
            </button>

        </div>
    </div>
</template>

<script>
import Question from "@/Pages/CreateBasicSurvey/Question";
export default {
    name: "QuestionManager",
    components: {Question},
    props: ['questions'],
    emits:['questionUpdate'],
    data: function () {
        return {

        }
    },
    methods: {
        addQuestion(){
            var tmpQuestion = {type: 0, name: ""};
            this.questions.push(tmpQuestion);
            this.$emit('questionUpdate');
        },
        deleteQuestion(questionName){
            for (const key in this.questions){
                if (!this.questions.hasOwnProperty(key))
                    continue;
                if (this.questions[key].name === questionName)
                    this.questions.splice(key,1);
            }
        },
    }
}
</script>

<style scoped>

</style>
