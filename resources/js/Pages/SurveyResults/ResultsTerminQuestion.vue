<template>

    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>

        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.termins">
                <div :option="option" :answer="answer">
                    {{ terminDate.getDate() + '.' + (terminDate.getMonth() + 1) + '.' + terminDate.getFullYear() + '   ' + terminDate.getHours() + ':' + terminDate.getMinutes() + '  Dauer: ' + option.duration + ' minuten' }}
                </div>
            </div>

        </div>


    </div>

</template>

<script>
export default {
    name: "ResultsTerminQuestion",
    props: ['question', 'answer', 'option'],
    data: function () {
        return {
            terminDate: new Date(this.option.time),
        }
    }
}
</script>

<style scoped>

</style>
