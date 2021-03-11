<template>
    <p class="text-2xl font-bold "> {{name}}</p>
    <p v-if="creator" class="text-2xl "> by {{creator}}</p>
</template>

<script>
export default {
    name: "SurveyDisplayer",
    props: ['name','creator'],
}
</script>

<style scoped>

</style>
