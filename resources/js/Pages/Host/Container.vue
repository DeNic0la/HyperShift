<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-5">
                <div class="float-left">Host Survey</div>
                <div class="float-right">Joined People: {{numberOfPeople}}</div>
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg m-4">
                <div class="flex space-x-4 flex-col">

                    <InfoDisplayer :Titel="joinCodeString(join_key)" :Subtitel="'Geben sie diesen Code ein um beizutreten'">
                        <div class="shadow border rounded-lg bg-white">
                            <div class="flex items-center rounded-lg space-x-4 p-4">
                                <a :href="'/join/'+this.join_key" target="_blank" title="Join">
                                    <div class="flex items-center p-4 bg-blue-600 text-white rounded-lg">
                                        <span class="material-icons w-7 h-7">open_in_new</span>
                                    </div>
                                </a>
                                <div class="flex-1 rounded-lg">
                                    <p class="text-gray-500 font-semibold">Beigetreten: {{numberOfPeople}}</p>
                                    <div class="flex items-baseline rounded-lg space-x-4">
                                        <h2 class="text-gray-800 text-2xl font-semibold">
                                            {{joinCodeString(join_key)}}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="block p-3 text-lg rounded-lg font-semibold bg-blue-100 text-blue-800 hover:bg-blue-200 cursor-pointer">
                                Start
                            </a>
                        </div>
                    </InfoDisplayer>



                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import AppLayout from "../../Layouts/AppLayout";
import InfoDisplayer from "./InfoDisplayer";

export default {
    name: "Container",
    components: {
        InfoDisplayer,
        AppLayout
    },
    props: ['join_key'],
    data()  {
        return {
            bluePrintString: "",
            bluePrintData: {},
            numberOfPeople: 0,

        }
    },
    methods:{
        updateLobby() {
            axios.get('/runLobby',{
                params: {
                    bluePrintString: this.bluePrintString,
                }
            }).then( response => {
                if (response.status === 200){
                    this.numberOfPeople = response.data;
                }
            })
        },
        joinCodeString(joinKey){
            let key = joinKey.toString();
            let matchedKey = key.match(/.{1,2}/g);
            return matchedKey.join(' ');
        }
    },
    created() {
        let url = window.location.href;
        this.bluePrintString = url.split('/').pop();
        axios.get('/getBluePrint',{
            params: {
                bluePrintString: this.bluePrintString,
            }
        }).then( response => {
            if (response.status === 200){
                this.bluePrintData = response.data;
            }
        })
        this.interval = setInterval(() => this.updateLobby(), 5000);
    }

}
</script>

