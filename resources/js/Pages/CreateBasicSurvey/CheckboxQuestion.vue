<template>
    <label>
        <div class="flex flex-col mb-4 md:mx-10">
            <div class="mb-2 text-grey-darkest">Checkbox-Frage:</div>
            <input @blur="$emit('questionUpdate')" type="text" v-model="question.name" class="border py-2 px-3 text-grey-darkest">
        </div>
    </label>
    <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
        <div v-for="(option,index) in question.options">
        <checkbox-option @questionUpdate="$emit('questionUpdate')" :SelectionDetails="option">

        </checkbox-option>
        </div>
        <button @click="addOption" class=" w-2/3 block mx-auto bg-indigo-600 hover:g-green-700 text-white font-bold py-2 px-4 rounded object-none object-center">
            + Antwort Option hinzufügen
        </button>
    </div>
</template>

<script>

import CheckboxOption from "@/Pages/CreateBasicSurvey/CheckboxOption";
export default {
    name: "CheckboxQuestion",
    components: {CheckboxOption},
    emits:['questionUpdate'],
    props: ['question'],
    data: function (){
        return {

        }
    },
    created() {
        this.question.options = [];
        var toPush = {content: null};
        this.question.options.push(toPush);
        this.$emit('questionUpdate');
    },
    methods: {
        addOption(){
            var toPush = {content: ""};
            this.question.options.push(toPush);
        }
    }
}
</script>

<style scoped>

</style>
