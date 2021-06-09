 <template>
    <div class="flex flex-col mb-4 md:mx-10">
        <div class="mb-2 text-grey-darkest">{{question.name}}</div>
        <div class="flex flex-col mb-4 md:mx-5 space-y-6" >
            <div v-for="(option,index) in question.selections">

                <checkbox-options :option="option" :count="answers[option.id].count">

                </checkbox-options>

            </div>

            <CheckboxChart :options="checkboxOptions" :answers="checkboxAnswers">

            </CheckboxChart>

        </div>
    </div>
</template>

<script>
import CheckboxOptions from "@/Pages/SurveyResults/CheckboxOptions";
import CheckboxChart from "@/Pages/Charts/CheckboxChart";

export default {
    name: "SurveyCheckboxResults",
    components: {CheckboxChart, CheckboxOptions},
    props: ['question', 'answers'],
    data: function () {
        return {
        }
    },
    computed: {
        checkboxAnswers(){
          let toReturn = [];
          this.question.selections.forEach(selection => {
              toReturn.push(this.answers[selection.id]);
          });
          return toReturn;
        },
    },
}
</script>

<style scoped>

</style>
