<template>
    <div class="flex flex-col">

        <label class="inline-flex items-center mt-3">

        </label>


            Durchschnitt: {{average}}

    </div>
</template>

<script>
export default {
    name: "ConfidenceVoteOptions",
    props: ['option', 'average',],
    data() {
        return {

        }
    },
}
</script>

<style scoped>

</style>
