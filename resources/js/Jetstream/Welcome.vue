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
                <div class="flex items-center">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laracasts.com">Live-Surveys</a></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        HyperShift also gives you the option to create live surveys. You can start a session and invite people to participate. This way, all participants see the same question and can fill it out live. The host can always switch to the next question.
                    </div>

                    <a href="">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>Create a live-survey</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </a>
                </div>
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
    import SurveyJoiner from "../Pages/Home/SurveyJoiner";
    import ResultViewer from "../Pages/Home/ResultViewer";
    import SurveyCreator from "@/Pages/Home/SurveyCreator";

    export default {
        components: {
            SurveyCreator,
            JetApplicationLogo,
            SurveyJoiner,
            ResultViewer,
        },
    }
</script>
