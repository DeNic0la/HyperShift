<template>
    <div class="flex justify-around">
        <label>
            <div class="flex flex-col mb-4 md:mx-10">
                <div class="mb-2 text-grey-darkest">Maximalwert:</div>
                <input placeholder="5" type="number" min="0" v-model="Details.maxValue">
            </div>
        </label>
    </div>
</template>

<script>
export default {
    name: "ConfidenceVoteOption",
    props: ['Details'],
    mounted() {
        console.log(this.Details);
    }
}
</script>

<style scoped>

</style>
