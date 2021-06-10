<template>
    <div class="flex flex-col">

        <label class="inline-flex items-center mt-3">
            {{ option.content }}
        </label>
            <label>
                Diese Option wurde {{count ?? 0}}-mal gewählt
            </label>
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
