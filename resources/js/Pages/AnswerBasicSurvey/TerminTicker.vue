<template>
    <div class="mb-2 text-grey-darkest">{{option.time + '   Dauer:' +  option.duration}}</div>
    <input type="checkbox" v-model="answer[option.id]" class="form-checkbox">
</template>

<script>
export default {
    name: "TerminTicker",
    props: ['option','answer'],
    data: function (){
        return {

        }
    },
    beforeCreate() {

    }
}
</script>

<style scoped>

</style>
