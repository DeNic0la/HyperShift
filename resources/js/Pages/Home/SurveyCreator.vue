<template>
    <div class="flex items-center">
        <PlusCircleIcon class="h-6 w-6"></PlusCircleIcon>
        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Umfrage erstellen</div>
    </div>

    <div class="md:ml-12">
        <div class="mt-2">
            <div class="mt-2 text-sm text-gray-500">
                Erstellen Sie eine Umfrage, welche von anderen Beantwortet werden kann.
            </div>
            <div class="mt-3 flex flex-row justify-center">
                <button @click="goToCreate()" class="ml-10 px-4 rounded bg-create text-gray-800 font-bold p-2 uppercase border-create-border hover:bg-create-hover hover:border-create-borderhover border-t border-b border-r">Erstellen</button>
            </div>
        </div>
    </div>
</template>

<script>
import {PlusCircleIcon} from "@heroicons/vue/outline";
import ActionSection from "@/Jetstream/ActionSection";
import ActionMessage from "@/Jetstream/ActionMessage";
export default {
    name: "SurveyCreator",
    methods: {
        goToCreate() {
            window.location.href = '/create'
        }
    },
    components: {
        ActionSection,
        ActionMessage,
        PlusCircleIcon
    },
}
</script>

<style scoped>

</style>
