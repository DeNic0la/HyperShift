<template>

    <ActionMessage :on="alert.show" class="z-50 static">
        <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300 absolute left-0 top-20">
            <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-red-500">
					<svg fill="currentColor"
                         viewBox="0 0 20 20"
                         class="h-6 w-6">
						<path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
					</svg>
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
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
        </svg>
        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Live Umfrage Beitreten</div>
    </div>

    <div class="md:ml-12">
        <div class="mt-2">
            <div class="mt-2 text-sm text-gray-500">
                Treten sie einer Live-Umfrage bei. //TODO (TEXT)
            </div>
            <div class="mt-3 flex">
                <input @keyup="keyUp" @keydown="keyPressed" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" v-model="Key" placeholder="Key Eingeben"/>
                <button @click="joinLiveSurvey" class="px-4 rounded-r-lg bg-green-400  text-gray-800 font-bold p-2 uppercase border-green-500 hover:bg-green-500 hover:border-green-600 border-t border-b border-r">Join</button>
            </div>
        </div>
    </div>
</template>

<script>
import ActionSection from "../../Jetstream/ActionSection";
import ActionMessage from "../../Jetstream/ActionMessage";

export default {
    name: "LiveSurveyJoiner",
    data: function () {
        return {
            Key: "",
            ctrlOrAltPressed: false,
            alert: {
                show: false,
            },
        }
    },
    components:{
        ActionSection,
        ActionMessage,
    },
    methods:{
        joinLiveSurvey(){
            if (this.validateJoinKeyFormat()){
                this.Key = this.Key.replace(/([ -])/g,'');
                axios.get('/validateKey',{
                    params: {
                        Key: this.Key,
                    }
                }).then( response => {
                    if (response.status === 200){
                        if (response.data !== 1){
                            this.alert.titel = 'Umfrage nicht Gefunden';
                            this.alert.text = 'Es Wurde keine Umfrage mit diesem Key gefunden.';
                            this.displayAlertToUser();
                        }
                        else {
                            //Redirect
                            window.location.href = '/join/'+this.Key;
                        }
                    }
                })
            }
            else {
                this.alert.titel = 'Ungültiges Format';
                this.alert.text = 'Der Eingegebene Key hat ein ungültiges Format. Gefordertes Format: 123456 oder 12 34 56 oder 12-34-56';
                this.displayAlertToUser();
            }

        },
        validateJoinKeyFormat(){
            // REGEX STRING: /^([0-9]{2})+[- ]?([0-9]{2})+[- ]?([0-9]{2})$/g
            return this.Key.match(/^([0-9]{2})+[- ]?([0-9]{2})+[- ]?([0-9]{2})$/g);
        },
        keyPressed(e){
            if (e.keyCode === 13){
                this.joinLiveSurvey();
                e.preventDefault();
            }
            else if (e.ctrlKey || e.altKey){
                this.ctrlOrAltPressed = true;
            }
            else if ((!e.key.match(/[0-9 -]/)) && this.ctrlOrAltPressed === false && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39){
                e.preventDefault();
            }
        },
        keyUp(e){
            if (e.ctrlKey || e.altKey){
                this.ctrlOrAltPressed = false;
            }
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
