<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div v-for="(question, index) in questions">

        </div>
        <button @click="addQuestion" class=" w-2/3 block mx-auto bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded object-none object-center">
            + Frage Hinzufügen
        </button>
    </div>
</template>

<script>
export default {
    name: "QuestionManager",
    props: ['questions'],
    methods: {
        addQuestion(){
            var tmpQuestion = {type: 1, name: "Welcher Termin passt dir am besten ?"};
            this.questions.push(tmpQuestion);
        }
    },
}
</script>

<style scoped>

</style>
