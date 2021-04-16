<template>
    Live Question
</template>

<script>
export default {
    name: "LiveQuestionDisplayer",
    props:['Key','currentQuestionNumber'],
    methods:{
        doStuff(){
            this.$emit('update:currentQuestionNumber', this.currentQuestionNumber );
        },
        fetchQuestionInfo(){
            axios.get('/live/question',{
                params: {
                    Key: this.Key,
                    lastKnownQuestion: this.currentQuestion,
                },
                data: {
                    Key: this.Key,
                    lastKnownQuestion: this.currentQuestion,
                }
            }).then( response => {
                if (response.status === 200){
                    if (response.data.newQuestion === true){
                        this.intervalTimeOut = 5000;
                        this.question = response.data.questiom;
                    }
                    else {
                        //Maybe Decrease interval here
                        if (this.intervalTimeOut > 5000 )
                            return;
                        else if (this.intervalTimeOut <= 500)
                            this.intervalTimeOut = 10000;
                        else if (this.intervalTimeOut <= 1000 )
                            this.intervalTimeOut -= 50;
                        else
                            this.intervalTimeOut -= 1000;
                    }
                    this.interval = setInterval(() => this.fetchQuestionInfo(), this.intervalTimeOut);

                }
            })
        }
    },
    data: function (){
        return {
            currentQuestion: 1,
            intervalTimeOut: 5000,
            question: {},
        }
    },
    emits: ['update:currentQuestionNumber'],
    created() {
        this.interval = setInterval(() => this.fetchQuestionInfo(), this.intervalTimeOut);
    }
}
</script>

<style scoped>

</style>
