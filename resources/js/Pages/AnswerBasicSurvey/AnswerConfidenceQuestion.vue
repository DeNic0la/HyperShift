<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <span class="ml-2 text-gray-700">
                <div class="fl mb-4 md:mx-10">
                    <div class="mb-2 text-grey-darkest">Maximalwert: {{question.maxValue}}</div>
                    <div class="slidecontainer">
                        <input @change="$emit('ConfidenceValue', { value: parseInt(question.value), questionId: parseInt(question.id)})" v-model="question.value" type="range" min="1" :max="question.maxValue" class="slider" id="myRange">
                    </div>
                    <input type="number" v-model="question.value" readonly>
                </div>
            </span>

        </div>
    </div>



</template>

<script>
import Input from "@/Jetstream/Input";
export default {
    name: "AnswerConfidenceQuestion",
    components: {Input},
    props: ['question', 'answer'],
    emits: ['ConfidenceValue'],
    methods: {

    },
    created() {
        this.question.value = 1;
    }
}
</script>

<style scoped>

</style>
