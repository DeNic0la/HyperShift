<template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <span class="ml-2 text-gray-700">
                <div class="fl mb-4 md:mx-10">
                    <div class="mb-2 text-grey-darkest">Maximalwert: {{question.maxValue}}</div>
                    <div class="slidecontainer">
                        <input @input="$emit('ConfidenceValue', question.value)" v-model="question.value" type="range" min="0" :max="question.maxValue" class="slider" id="myRange">
                    </div>
                </div>
            </span>



        </div>
    </div>



</template>

<script>
export default {
    name: "AnswerConfidenceQuestion",
    props: ['question', 'answer'],
    emits: ['ConfidenceValue'],
    methods: {

    },
    beforeCreate() {

    }
}
</script>

<style scoped>

</style>
