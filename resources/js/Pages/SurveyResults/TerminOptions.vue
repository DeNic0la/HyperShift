<template>
    <div class="flex flex-col">
        <label class="inline-flex items-center mt-3">
            {{ terminDate.getDate() + '.' + (terminDate.getMonth() + 1) + '.' + terminDate.getFullYear() + '   ' + terminDate.getHours() + ':' + terminDate.getMinutes() + '  Dauer: ' + option.duration + ' minuten' }}
        </label>
    </div>
</template>

<script>
export default {
    name: "TerminOptions",
    props: ['option', 'answer'],
    data: function () {
        return {
            terminDate: new Date(this.option.time),
        }
    },
    beforeCreate() {

    }
}
</script>

<style scoped>

</style>
