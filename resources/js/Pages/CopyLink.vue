<template>

    <div class="relative text-gray-600 focus-within:text-gray-400 flex flex-row justify-around">
        <input readonly type="text" :id="'copyValueUrl'+id" :value="toCopyURL"  class="py-2 text-sm rounded-md w-4/12 pl-2 focus:outline-none focus:bg-white focus:text-gray-900">
        <div class="flex justify-end">

            <div class="px-6">
                <div v-if="showCopyUrlBtn === true">
                    <button @click="copy(1)" class="font-semibold py-2 px-2 text-white border rounded w-100% " :class="copyButtonClass">
                        {{copyUrlButtonText}}
                    </button>
                </div>
            </div>

            <div class="px-6">
                <div v-if="showCopyStringBtn === true">
                    <input style="position:absolute;left: -999em;" readonly type="text" :id="'copyValueString'" :value="url_string" class="py-2 text-sm rounded-md w-100% pl-2 focus:outline-none focus:bg-white focus:text-gray-900">
                    <button @click="copy(2)" class="font-semibold py-2 px-2 text-white border rounded w-100% border-code-border hover:border-code-boarderhover bg-code hover:bg-code-hover ">
                        {{copyStringButtonText}}
                    </button>
                </div>
            </div>

            <div class="px-6">
                <div v-if="showResultBtn === true">
                    <button @click="goToResults(resultsLocation)" class="font-semibold text-white py-2 px-2 border rounded w-100% border-result-border hover:border-result-boarderhover bg-result hover:bg-result-hover">
                        {{resultButtonText}}
                    </button>
                </div>
            </div>

        </div>

    </div>


</template>

<script>
export default {
    name: "CopyLink",
    props: {
        url_string: String,
        id: Number,
        showResultBtn: {
            type: Boolean,
            default: true
        },
        showCopyUrlBtn: {
            type: Boolean,
            default: true
        },
        showCopyStringBtn: {
            type: Boolean,
            default: true
        },
        isBluePrint: {
            type: Boolean,
            default: false
        }
    },
    data: function () {
        return {
            copyUrlButtonText: "URL kopieren",
            copyStringButtonText: "Code kopieren",
            resultButtonText: "Resultate",
            baseUrl: "",
        }
    },
    methods: {
        goToResults(resultsLocation){
            window.location.assign(resultsLocation);
        },
        copy(value){
            if(value === 1) {
                let testingCodeToCopy = document.querySelector('#copyValueUrl' + this.id);
                testingCodeToCopy.select();
            }
            if(value === 2){
                let testingCodeToCopy = document.querySelector('#copyValueString');
                testingCodeToCopy.select();
            }
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';

            } catch (err) {
                alert('Oops, unable to copy');
            }

            /* unselect the range */
            window.getSelection().removeAllRanges()
        },negateAllValues(obj){
            Object.keys(obj).forEach(function(key){ obj[key] = !obj[key] });
            return obj;
        }
    },
    mounted() {
        this.baseUrl = document.getElementById("baseURL").getAttribute('content');
    },
    computed: {
        toCopyURL() {
            return this.baseUrl + (this.isBluePrint ? '/host/' : '/survey/fill/') + this.url_string;
        },
        resultsLocation() {
            return this.baseUrl + '/survey/results/' + this.url_string;
        },
        copyButtonClass(){
            return {
                'bg-answer border-answer-border hover:border-answer-boarderhover hover:bg-answer-hover': !this.isBluePrint,
                'bg-host border-host-border hover:border-host-boarderhover hover:bg-host-hover': this.isBluePrint,
            }
        }
    }
}
</script>

<style scoped>

</style>
