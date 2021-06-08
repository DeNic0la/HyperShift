<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Resultate Ansehen
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg p-8 m-4">
                <div class="flex space-x-4 flex-col">

                    <div class="flex flex-col mb-4 md:mx-10">
                        <h2 class="pb-10">Resultate</h2>

                        <ResultViewer />


                    </div>


                </div>
            </div>
        </div>


    </app-layout>
</template>


<script>
import AppLayout from "../../Layouts/AppLayout";
import ResultViewer from "../Home/ResultViewer"
export default {
    name: "Container",
    components: {
        AppLayout,
        ResultViewer
    },
    data()  {
        return {

        }
    },
    methods:{

    },
    created() {

    }

}
</script>

<style scoped>

</style>
