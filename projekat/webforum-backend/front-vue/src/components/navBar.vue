<template>
  <div class="min-h-full">

    <Disclosure as="nav" class="bg-teal-300" v-slot="{ open }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">

              <img class="h-8 w-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Brilliant_%28website%29_Logo.svg/600px-Brilliant_%28website%29_Logo.svg.png"
                alt="Workflow" />
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">

                <router-link :to="'/HomePage'" v-if="userss"
                  class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Početna
                </router-link>
                <router-link :to="'/ProfileUser'" v-if="userss"
                  class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                  Korisnički profil</router-link>
                <router-link :to="'/dashboardAdmin'" v-if="admin"
                  class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                  Admin panel</router-link>
                <router-link :to="'/Allusers'" v-if="admin"
                  class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                  Svi korisnici
                </router-link>


              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">


              <!-- Profile dropdown -->
              <Menu as="div" class="ml-3 relative">
                <div>
                  <MenuButton
                    class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <img class="h-8 w-8 rounded-full" src="https://avatars.githubusercontent.com/u/154702539?v=4" alt="" />
                  </MenuButton>
                </div>
                <transition enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95">
                  <MenuItems
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <MenuItem v-slot="{ active }">
                    <a @click="logout" :class="['block px-4 py-2 text-sm text-gray-700 cursor-pointer']">
                      Odjavi se</a>
                    </MenuItem>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">

            <!-- Mobile menu button -->
            <DisclosureButton
              class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">Otvori glavni meni</span>
              <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
              <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>

          </div>
        </div>
      </div>

      <!-- Mobilna verzija burger menija -->
      <DisclosurePanel class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
          <router-link :to="'/HomePage'" v-if="userss"
            class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2block px-3 py-2 rounded-md text-base font-medium">
            Početna
          </router-link>
          <router-link :to="'/ProfileUser'" v-if="userss"
            class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 block px-3 py-2 rounded-md text-base font-medium">
            Korisnički profil</router-link> 
          <router-link :to="'/dashboardAdmin'" v-if="admin"
            class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 block px-3 py-2 rounded-md text-base font-medium">
            Admin panel
          </router-link>
          <router-link :to="'/Allusers'" v-if="admin"
            class="text-gray-800 hover:bg-gray-700 hover:text-white px-3 py-2 block px-3 py-2 rounded-md text-base font-medium">
            Svi korisnici
          </router-link>
        </div>


        <div class="pt-4 pb-3 border-t border-gray-700">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" src="https://avatars.githubusercontent.com/u/154702539?v=4" alt="" />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">{{ user.name }}</div>
              <div class="text-sm font-medium leading-none text-gray-400">{{ user.email }}</div>
            </div>
            <button type="button"
              class="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">View notifications</span>
              <BellIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-3 px-2 space-y-1">
            <DisclosureButton as="a" @click="logout"
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:text-white hover:bg-gray-700 cursor-pointer">
              Odjavi se!</DisclosureButton>
          </div>
        </div>

      </DisclosurePanel>
    </Disclosure>


    <router-view></router-view>

  </div>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import { computed } from '@vue/reactivity'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import store from "../store";

export default {
  name: "navBar",
  data() {
    return {
      admin:sessionStorage.getItem("TOKEN_ADMIN"),
      userss:sessionStorage.getItem("TOKEN")

    }
  },
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    MenuIcon,
    XIcon,
  },
  methods: {

    logout() {
      store.commit('logout');
      router.push({
        name: 'Login'
      })
      console.log("ok");

    }
  },
  mounted() {
    console.log( "hada"+this.userss);
    console.log(this.$parent.$options.name);


  },
  setup() {
    const store = useStore();
    const router = useRouter();

    return {

      user: computed(() => store.state.user.data),
    }
  },
}
</script>