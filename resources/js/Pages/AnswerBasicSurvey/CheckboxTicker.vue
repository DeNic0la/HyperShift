<template>
    <div class="flex flex-col">
        <label class="inline-flex items-center mt-3">
            <input type="checkbox" @input="$emit('CheckboxAnswerTicked', option.id)" :value="option.id"
                   class="form-checkbox h-5 w-5 text-blue-600"><span class="ml-2 text-gray-700">
            {{ option.content }}
        </span>
        </label>
    </div>
</template>

<script>
export default {
    name: "CheckboxTicker",
    props: ['option', 'answer'],
    emits: ['CheckboxAnswerTicked'],
}
</script>

<style scoped>

</style>
