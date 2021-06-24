<template>
    <div class="flex items-center">
        <UserIcon class="h-6 w-6"></UserIcon>
        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Registrierung</div>
    </div>

    <div class="md:ml-12">
        <div class="mt-2">
            <div class="mt-2 text-sm text-gray-500">
               Unsere Applikation bieten Ihnen die Möglichkeit sich zu Registrieren. Somit können Sie jederzeit auf ihre bereits erstellten Umfragen zugreifen und diese wiederverwenden.
            </div>
        </div>
    </div>
</template>

<script>
import {UserIcon} from "@heroicons/vue/outline";
export default {
    name: "AuthentificationInfo",
    components:{
        UserIcon
    },
}
</script>

<style scoped>

</style>
