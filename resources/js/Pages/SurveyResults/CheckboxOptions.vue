<template>
    <div class="flex flex-col">

        <label class="inline-flex items-center mt-3">
            {{ option.content }}
        </label>

        <div v-if="count != 0">
            <label>
                Diese Option wurde {{count}} gewählt
            </label>
        </div>

    </div>
</template>

<script>
export default {
    name: "CheckboxOptions",
    props: ['option', 'count'],
}
</script>

<style scoped>

</style>
