<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-50">
    <body class="h-full">
    ```
  -->

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