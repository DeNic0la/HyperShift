<template>
    <div class="flex justify-around">
        <label>
            <div class="flex flex-col mb-4 md:mx-10">
                <div class="mb-2 text-grey-darkest">Terminstart: </div>
                <input type="datetime-local" @blur="$emit('questionUpdate')" v-model="TerminDetails.datetime">

            </div>
        </label>
        <label>
            <div class="flex flex-col mb-4 md:mx-10">
                <div class="mb-2 text-grey-darkest">Termindauer (Minuten): </div>
                <input @blur="$emit('questionUpdate')" type="number" step="10" min="0" v-model="TerminDetails.duration">

            </div>
        </label>
    </div>
</template>

<script>
export default {
    name: "TerminOption",
    emits:['questionUpdate'],
    props: ['TerminDetails'],
    mounted() {
    }
}
</script>

<style scoped>

</style>
