<template>
    <label>
        <div class="flex flex-col mb-4 md:mx-10">
            <div class="mb-2 text-grey-darkest">Name der Terminfrage:</div>
            <input @blur="$emit('questionUpdate')" type="text" v-model="question.name" class="border py-2 px-3 text-grey-darkest">
        </div>
    </label>
    <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
        <div v-for="(option,index) in question.options">
            <TerminOption @questionUpdate="$emit('questionUpdate')" :TerminDetails="option">

            </TerminOption>
        </div>
        <button @click="addOption" class=" w-2/3 block mx-auto bg-indigo-600 hover:g-green-700 text-white font-bold py-2 px-4 rounded object-none object-center">
            + Termin Option Hinzufügen
        </button>
    </div>



</template>

<script>
import TerminOption from "./TerminOption";
export default {
    name: "TerminQuestion",
    emits:['questionUpdate'],
    components: {TerminOption},
    props: ['question'],
    data: function (){
        return {
            name: Date.now(),
        }
    },
    created() {
        this.question.options = [];
        var toPush = {datetime: null, duration: null};
        this.question.options.push(toPush);
        this.$emit('questionUpdate');

    },
    methods: {
        addOption(){
            var toPush = {datetime: Date.now(), duration: 0};
            this.question.options.push(toPush);
        }
    }
}
</script>

<style scoped>

</style>
