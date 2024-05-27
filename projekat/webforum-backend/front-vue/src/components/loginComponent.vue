<template>
    <!-- Administratorski i korisnicki login login -->
    <div>
        <img class="mx-auto h-24 w-24" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Brilliant_%28website%29_Logo.svg/600px-Brilliant_%28website%29_Logo.svg.png"
            alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Prijavi se na svoj nalog za ulogu: {{ role }}</h2>
        <!-- if petlja za odlucivanje izmedju User i Admin -->
        <p class="mt-2 text-center text-sm text-gray-600" v-if="this.$parent.$options.name == 'SignInForm'">
            ili
            <router-link :to="{ name: 'Register' }"> <a href="#"
                    class="font-medium text-indigo-600 hover:text-indigo-500">
                    Registruj se na platformi... </a></router-link>
                    <br>ili 
            <router-link :to="{ name: 'LoginAdmin' }"> <a href="#"
                    class="font-medium text-indigo-600 hover:text-indigo-500">
                    Prijavi se kao administrator... </a></router-link>
        </p>
    </div>
    <div v-if="error" class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
        E-mail adresa ili lozinka nisu ispravne! Pokušaj ponovo.
    </div>

    <form class="mt-8 space-y-6" @submit="login">
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
            <!-- if petlja za odlucivanje izmedju User i Admin -->
            <div class="mb-3 space-y-2 w-full text-xs" v-if="this.$parent.$options.name == 'SignInForm'">
                <label class="font-semibold text-gray-600 py-2">E-mail <abbr title="required">*</abbr></label>
                <input placeholder="E-mail... " v-model="user.email"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                    required="required" type="email" name="integration[shop_name]" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje</p>
            </div>
            <div class="mb-3 space-y-2 w-full text-xs" v-else>
                <label class="font-semibold text-gray-600 py-2">Administratorska referenca (e-mail) <abbr title="required">*</abbr></label>
                <input placeholder="Referenca... " v-model="user.email"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                    required="required" type="text" name="integration[shop_name]" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje</p>
            </div>
            <!-- kraj if petlje -->

            <div class="mb-3 space-y-2 w-full text-xs">
                <label class="font-semibold text-gray-600 py-2">Password <abbr title="required">*</abbr></label>
                <input placeholder="Password" v-model="user.pass"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                    required="required" type="password" name="integration[shop_name]" id="integration_shop_name">
                <p class="text-red text-xs hidden">Obavezno polje</p>
            </div>
        </div>

        <div class="mb-3 space-y-2 w-full text-xs" v-if="this.$parent.$options.name == 'SignInForm'">
            <router-link :to="{ name: 'Register' }"> <a href="#"
                    class="font-medium text-indigo-600 hover:text-indigo-500">
                    Kreiraj nalog </a></router-link>
            </div>

        <div>
            <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                </span>
                Prijavi se
            </button>
        </div>
    </form>
</template>
<script >
import { mapActions } from "vuex";
import useValidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
import { LockClosedIcon } from '@heroicons/vue/solid'
import { useRouter } from 'vue-router';
import store from "../store";
export default {
    name: "loginComponent",

    data() {
        return {
            testt: sessionStorage.getItem("TOKEN"),
            reff: "",
            error: false,
            router: useRouter(),
            user: {
                "email": "",
                "pass": "",
            },
            admin: {
                "reff_admin": "",
                "pass": ""
            }
        };
    },
    components: {
        LockClosedIcon
    },
    props: {
        role: String
    },
    methods: {
        ...mapActions(["redirectTo"]),

        login(ev) {

            ev.preventDefault();

            console.log(this.$parent.$options.name)
            
            // normalan login
            if (this.$parent.$options.name == 'SignInForm') {

                store
                    .dispatch('login', this.user)
                    .then((response) => {


                        console.log(response);
                        if (response.data.message != "success") {
                            this.error = true
                        }
                        this.redirectTo({ val: "HomePage" });
                    })

            // admin login  
            } else if (this.$parent.$options.name == 'LoginAdmin') {

                this.admin.reff_admin = this.user.email;
                this.admin.pass = this.user.pass;

                store
                    .dispatch('loginAdmin', this.admin)
                    .then((response) => {


                        console.log(response);
                        if (response.message != "success") {
                            this.error = true

                        } else if (response.message == "success") {

                            this.redirectTo({ val: "dashboardAdmin" });

                        }
                    })

            }

        },
        loginAdmin(ev) {

            ev.preventDefault();

        },
    }
}
</script>