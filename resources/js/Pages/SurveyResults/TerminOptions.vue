<template> terminDate:
    <div class="flex flex-col">

        <label class="inline-flex items-center mt-3">
            {{ terminDate.getDate() + '.' + (terminDate.getMonth() + 1) + '.' + terminDate.getFullYear() + '   ' + terminDate.getHours() + ':' + terminDate.getMinutes() + '  Dauer: ' + option.duration + ' minuten' }}
        </label>

        <label>
            Anzahl Zusagen: {{count}}
        </label>

    </div>
</template>

<script>
export default {
    name: "TerminOptions",
    props: ['option', 'count'],
    data() {
        return {
            terminDate: new Date(this.option.time),
        }
    },
}
</script>

<style scoped>

</style>
