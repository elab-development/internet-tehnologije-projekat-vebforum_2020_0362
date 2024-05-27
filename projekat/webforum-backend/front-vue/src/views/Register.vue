<template>

<!-- Registracioni login -->

    <div>
        <img class="mx-auto h-24 w-24" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Brilliant_%28website%29_Logo.svg/600px-Brilliant_%28website%29_Logo.svg.png"
            alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Besplatna registracija</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            ili
            <router-link :to="{ name: 'Login' }"> <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Prijavi se svojim nalogom... </a> </router-link>

        </p>
    </div>

    <form class="mt-8 space-y-6" @submit="register">
        <input type="hidden" name="remember" value="true" />

        <div class="md:flex flex-row md:space-x-4 w-full text-xs">
            <div class="mb-3 space-y-2 w-full text-xs">
                <label class="font-semibold text-gray-600 py-2">Ime <abbr title="required">*</abbr></label>
                <input placeholder="Ime..." v-model="user.nom"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                    required="required" type="text" name="nom" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje.</p>
            </div>
            <div class="mb-2 space-y-2 w-full text-xs">
                <label class="font-semibold text-gray-600 py-2">Prezime <abbr title="required">*</abbr></label>
                <input placeholder="Prezime..." v-model="user.prenom"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                    required="required" type="text" name="integration[shop_name]" id="integration_shop_name">
                    <p class="text-red text-xs hidden">Obavezno polje.</p>
            </div>

        </div>
        <div class="mb-3 space-y-2 w-full text-xs">
            <label class="font-semibold text-gray-600 py-2">E-mail adresa <abbr title="required">*</abbr></label>
            <input placeholder="E-mail adresa... " v-model="user.email"
                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                required="required" type="email" name="integration[shop_name]" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje</p>
        </div>
        <div class="mb-3 space-y-2 w-full text-xs">
            <label class="font-semibold text-gray-600 py-2">Datum rođenja <abbr title="required">*</abbr></label>
            <input placeholder="Datum rodjenja..." v-model="user.date_naissance"
                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                required="required" type="date" name="integration[shop_name]" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje</p>
        </div>
        <div class="mb-3 space-y-2 w-full text-xs">
            <label class="font-semibold text-gray-600 py-2">Password naloga <abbr title="required">*</abbr></label>
            <input placeholder="Password..." v-model="user.pass"
                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                required="required" type="password" name="integration[shop_name]" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje</p>
        </div>
        <div class="flex items-center justify-between">
            

            
        </div>

        <div>
            <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                </span>
                Napravi nalog!
            </button>
        </div>
    </form>

</template>

<script >
import { mapActions } from "vuex";

import { LockClosedIcon } from '@heroicons/vue/solid'
import { useRouter } from 'vue-router';
import store from "../store";
import axios from "axios";
import { computed } from '@vue/reactivity';
export default {
    name: "SignUpForm",

    data() {
        return {

            reff: "",
            error: false,
            router: useRouter(),
            user: {
                "nom": "",
                "prenom": "",
                "date_naissance": "",
                "email": "",
                "pass": "",
            }
        };

    },
    methods: {
        ...mapActions(["redirectTo"]),

        register(ev) {
            ev.preventDefault();
            store
                .dispatch('register', this.user)
                .then((response) => {
                    this.redirectTo({ val: "HomePage" });
                })

        }
    },
    components: {
        LockClosedIcon
    },
    mounted() {
        let e = sessionStorage.getItem("TOKEN");

        if (e) {
            this.redirectTo({ val: "HomePage" });

        }
    },


}


</script>