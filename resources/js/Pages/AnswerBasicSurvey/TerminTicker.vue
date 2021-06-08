<template>
    <div class="flex flex-col">
        <label class="inline-flex items-center mt-3">
            <input type="checkbox" @input="$emit('CheckboxTicked', option.id)" :value="option.id" :disabled="isDisabled"
                   class="form-checkbox h-5 w-5 text-blue-600"><span class="ml-2 text-gray-700" :v-model="isChecked">
            {{ terminDate.getDate() + '.' + (terminDate.getMonth() + 1) + '.' + terminDate.getFullYear() + '   ' + terminDate.getHours() + ':' + terminDate.getMinutes() + '  Dauer: ' + option.duration + ' minuten' }}
        </span>
        </label>
    </div>
</template>

<script>
export default {
    name: "TerminTicker",
    props: ['option','isDisabled','answers'],
    emits: ['CheckboxTicked'],
    data: function () {
        return {
            terminDate: new Date(this.option.time),
            isChecked: false,
        }
    },
    beforeUpdate() {
        this.isChecked = this.answers.includes(this.option.id);
    }
}
</script>

<style scoped>

</style>
