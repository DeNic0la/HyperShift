<template>

    <ActionMessage :on="alert.show" class="z-50 static">
        <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300 absolute left-0 top-20">
            <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-red-500">

				</span>
            </div>
            <div class="alert-content ml-4">
                <div class="alert-title font-semibold text-lg text-red-800">
                    {{alert.titel ?? 'Error'}}
                </div>
                <div class="alert-description text-sm text-red-600">
                    {{alert.text ?? 'Etwas ist falsch gelaufen'}}
                </div>
            </div>
        </div>
    </ActionMessage>
    <div class="flex items-center">
        <EyeIcon class="h-6 w-6"></EyeIcon>
        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Resultate Ansehen</div>
    </div>

    <div class="md:ml-12">
        <div class="mt-2">
            <div class="mt-2 text-sm text-gray-500">
                Resultate ansehen und Umfrage auswerten.
            </div>
            <div class="mt-3 flex">
                <input class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" v-model="Key" placeholder="Code Eingeben"/>
                <button @click="joinLiveSurvey" class="px-4 rounded-r-lg bg-result  text-gray-800 font-bold p-2 uppercase border-result-border hover:bg-result-hover hover:border-result-borderhover border-t border-b border-r">Resultate</button>
            </div>
        </div>
    </div>
</template>

<script>
import ActionSection from "../../Jetstream/ActionSection";
import ActionMessage from "../../Jetstream/ActionMessage";
import {EyeIcon} from "@heroicons/vue/outline";

export default {
    name: "SurveyJoiner",
    data: function () {
        return {
            Key: "",
            alert: {
                show: false,
            },
        }
    },
    components:{
        ActionSection,
        ActionMessage,
        EyeIcon
    },
    methods:{
        joinLiveSurvey(){
                this.Key = this.Key.trim();
                axios.get('/validateSurvey',{
                    params: {
                        Key: this.Key,
                    }
                }).then( response => {
                    if (response.status === 200){
                        if (response.data !== 1){
                            this.alert.titel = 'Umfrage nicht Gefunden';
                            this.alert.text = 'Es Wurde keine Umfrage mit diesem Survey-Code gefunden.';
                            this.displayAlertToUser();
                        }
                        else {
                            window.location.href = '/survey/results/'+this.Key;
                        }
                    }
                })


        },
        displayAlertToUser(){
            this.alert.show = true;
            setTimeout(() => {
                this.alert.show = false;
            },5000 )
        }
    },
}
</script>

<style scoped>

</style>
