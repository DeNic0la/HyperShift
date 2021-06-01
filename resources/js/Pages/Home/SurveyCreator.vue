<template>
    <div class="flex items-center">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
        </svg>
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
export default {
    name: "SurveyCreator",
    methods: {
        goToCreate() {
            window.location.href = '/create'
        }
    }
}
</script>

<style scoped>

</style>
