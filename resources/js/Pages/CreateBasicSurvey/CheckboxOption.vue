<template>
    <div class="flex justify-around">
        <label>
            <div class="flex flex-col mb-4 md:mx-10">
                <div class="mb-2 text-grey-darkest">Antwort-Möglichkeit: </div>
                <input type="text" @blur="$emit('questionUpdate')" v-model="SelectionDetails.content">
            </div>
        </label>
    </div>
</template>

<script>
export default {
    name: "CheckboxOption",
    emits:['questionUpdate'],
    props: ['SelectionDetails'],
}
</script>

<style scoped>

</style>
