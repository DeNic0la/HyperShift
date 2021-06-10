<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo />
            </div>

            <div class="mt-8 text-2xl">
                Willkommen bei HyperShift
            </div>

            <div class="mt-6 text-gray-500">
                HyperShift ist ein Tool um einfach und schnell Umfragen zu erstellen und auszufüllen.
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <SurveyCreator />
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <!--<LiveSurveyJoiner />-->
                <AuthentificationInfo />
            </div>

            <div class="p-6 border-t border-gray-200">
                <ResultViewer />
            </div>

            <div class="p-6 border-t border-gray-200 md:border-l">
                <SurveyJoiner />
            </div>

        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import LiveSurveyJoiner from "@/Pages/Home/LiveSurveyJoiner";
    import SurveyJoiner from "../Pages/Home/SurveyJoiner";
    import ResultViewer from "../Pages/Home/ResultViewer";
    import SurveyCreator from "@/Pages/Home/SurveyCreator";
    import AuthentificationInfo from "@/Pages/Home/AuthentificationInfo";

    export default {
        components: {
            AuthentificationInfo,
            SurveyCreator,
            JetApplicationLogo,
            LiveSurveyJoiner,
            SurveyJoiner,
            ResultViewer,
        },
    }
</script>
