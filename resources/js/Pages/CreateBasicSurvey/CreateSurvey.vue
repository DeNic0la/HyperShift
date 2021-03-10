<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Zeitlose Umfrage erstellen
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg p-8 m-4">
                <div class="flex space-x-4 flex-col">
                    <div class="flex flex-col mb-4 md:mx-10" v-if="errors.length">
                        <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg" v-for="error in errors">
                            {{ error }}
                        </div>
                    </div>
                    <div class="flex flex-col mb-4 md:mx-10">
                        <label class="mb-2 font-bold text-lg text-grey-darkest" for="SurveyName">Name der Umfrage:</label>
                        <input type="text" v-model="surveyName" id="SurveyName" class="border py-2 px-3 text-grey-darkest" name="name">
                    </div>
                    <div class="flex flex-col mb-4 md:mx-10">
                        <button @click="createSurvey" class="block mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded object-none object-center">
                            Create a Survey
                        </button>
                    </div>

                </div>
            </div>

        </div>


    </app-layout>

</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import ActionMessage from "../../Jetstream/ActionMessage";
export default {
    name: "CreateSurvey",
    components: {
        ActionMessage,
        AppLayout,
    },
    data: function () {
        return{
            surveyName: "Name der Umfrage",
            errors: [],
            showMessage: true,
        }
    },
    methods:{
        createSurvey(){
            this.errors = [];
            if (this.surveyName === "Name der Umfrage"){
                this.errors.push("Ungültiger Umfragename")
            }
            else{
                axios.post('/createSurvey',{
                    name: this.surveyName,
                }).then( response =>{
                    if (response.status === 201){
                        alert("Everything is Okey")
                    }else{
                        alert("Something went wrong i can feel it.");
                    }
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
