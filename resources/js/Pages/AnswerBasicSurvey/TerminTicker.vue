<template>
    <div class="flex flex-col">
        <label class="inline-flex items-center mt-3">
            <input type="checkbox"  v-model="answer[option.id]" class="form-checkbox h-5 w-5 text-blue-600"><span class="ml-2 text-gray-700">
            {{terminDate.getDate() + '.' +(terminDate.getMonth() +1) + '.' + terminDate.getFullYear()+ '   '+terminDate.getHours()+':'+terminDate.getMinutes()+'  Dauer: ' +  option.duration +' minuten'}}
        </span>
        </label>
    </div>
</template>

<script>
export default {
    name: "TerminTicker",
    props: ['option','answer'],
    data: function (){
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
