<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-5">
                <div class="float-left">Live Survey</div>
            </h2>
        </template>

        <div class="container mx-auto pt-5">
            <div class="w-full bg-white rounded shadow-lg m-4">
                <div class="flex space-x-4 flex-col">
                    Great Place for Text
                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import AppLayout from "../../Layouts/AppLayout";


export default {
    name: "Container",
    components: {
        AppLayout
    },
    props: ['Key'],
    data()  {
        return {

        }
    },
    methods:{

    },
    created() {
        /*let url = window.location.href;
        this.bluePrintString = url.split('/').pop();
        axios.get('/getBluePrint',{
            params: {
                bluePrintString: this.bluePrintString,
            }
        }).then( response => {
            if (response.status === 200){
                this.bluePrintData = response.data;
            }
        })*/
        //this.interval = setInterval(() => this.updateLobby(), 5000);
    }

}
</script>

