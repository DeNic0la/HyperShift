<template>
    <p class="text-2xl font-bold "> {{survey_name}}</p>

    <div class="relative text-gray-600 focus-within:text-gray-400">
        <input type="text" :id="'copyValue'+id" :value="toCopy" class="py-2 text-sm rounded-md w-2/3 pl-2 focus:outline-none focus:bg-white focus:text-gray-900">
        <button @click="copyCode" :class="buttonStyles" class="font-semibold py-2 px-4 ml-5 border rounded">
            {{copyButtonText}}
        </button>

        <button @click="goToResults(resultsLocation)" class="font-semibold py-2 px-4 ml-5 border rounded">
            {{resultButtonText}}
        </button>
    </div>


</template>

<script>
import CopyLink from "@/Pages/CopyLink";
export default {
    name: "MySurveysDisplayer",
    components: {CopyLink},
    props: ['survey_name', 'url_string', 'id'],
    data: function () {
        return {
            buttonStyles: {
                'bg-transparent': true,
                'hover:bg-blue-500': true,
                'text-blue-700': true,
                'hover:text-white': true,
                'border-blue-500': true,
                'hover:border-transparent': true,
                'bg-opacity-75': false,
                'bg-green-700': false,
                'text-gray-800': false,
            },
            copyButtonText: "Kopieren",
            resultButtonText: "Resultate",
            toCopy: this.toCopy = document.getElementById("baseURL").getAttribute('content') + '/survey/fill/'+this.url_string,
            resultsLocation: document.getElementById("baseURL").getAttribute('content') + '/survey/results/'+this.url_string,
        }
    },
    methods: {
        goToResults(resultsLocation){
            window.location.assign(resultsLocation);
        },
        copyCode(){
            //this.toCopy  =
            let testingCodeToCopy = document.querySelector('#copyValue'+ this.id)
            testingCodeToCopy.select()
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';

                this.buttonStyles = this.negateAllValues(this.buttonStyles);
                this.buttonText = "Text Kopiert";
                setTimeout(() => {
                    this.buttonStyles = this.negateAllValues(this.buttonStyles);
                    this.buttonText = "Kopieren";
                }, 3*1000)

            } catch (err) {
                alert('Oops, unable to copy');
            }

            /* unselect the range */
            window.getSelection().removeAllRanges()
        },negateAllValues(obj){
        Object.keys(obj).forEach(function(key){ obj[key] = !obj[key] });
        return obj;
        }
    }
}

</script>

<style scoped>

</style>
