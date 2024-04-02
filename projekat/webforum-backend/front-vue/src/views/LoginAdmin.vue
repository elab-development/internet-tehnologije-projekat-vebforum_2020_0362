<template>
  
    <loginComponent role="Admin" />

</template>

<script >
import { mapActions } from "vuex";
import useValidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
import { LockClosedIcon } from '@heroicons/vue/solid'
import { useRouter } from 'vue-router';
import store from "../store";
import loginComponent from '../components/loginComponent.vue'

export default {
    name: "LoginAdmin",

    data() {
        return {
            v$: useValidate(),

            reff: "",
            error: false,
            router: useRouter(),
            user: {
                "email": "",
                "pass": "",
            }
        };
    },
    components: {
        LockClosedIcon,
        loginComponent
    },
    methods: {
        ...mapActions(["redirectTo"]),
       
    }
}
</script>