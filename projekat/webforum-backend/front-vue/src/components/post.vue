<template>
   
    <div v-if="showModal"
        class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto w-full max-w-3xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        modifier post
                    </h3>
                    <button
                        class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none">
                        <span
                            class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                            ×
                        </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto w-full">
                    <div class="whitespace-pre-wrap mt-7"> <textarea v-model="this.postData.sjt_post"
                            placeholder="prenom" class="bg-purple-white shadow rounded border-0 p-3 w-full"
                            required="required" name="integration[shop_name]" id="integration_shop_name"></textarea>
                    </div>
                </div>
                <div class=" flex-1 px-2 pt-2 mx-10 m-2">
                    <select v-model="this.categEdit" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <!-- <option>{{ this.categEdit }}</option> -->

                        <option v-for="elem in $store.state.categorie.data" :value="elem.id" :key="elem.id"
                            :selected="elem.nom_categorie == this.categEdit">
                            <div>{{
                                    elem.nom_categorie
                            }} </div>
                        </option>
                        <option disabled value="">....</option>


                    </select>

                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                    <button
                        class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" v-on:click="toggleModal()">
                        Close
                    </button>
                    <button
                        class="text-green-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="updatePost()">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal edit pot -->
    <div>


        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
    <div class="border     mx-auto max-w-screen-md bg-white mt-10 rounded-2xl p-4"
        v-for="elem in $store.state.post.data.posts" :key="elem.id">


        <div class="flex items-center	justify-between">
            <div class="gap-3.5	flex items-center ">
                <img src="https://images.unsplash.com/photo-1617077644557-64be144aa306?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"
                    class="object-cover bg-yellow-500 rounded-full w-10 h-10" />
                <div class="flex flex-col">
                    <b class="mb-2 capitalize"> {{ elem.utilisateur.prenom }} {{ elem.utilisateur.nom }}</b>
                    <time datetime={{elem.created_at}} class="text-gray-400 text-xs">{{ elem.created_at }}
                    {{ elem.categorie.nom_categorie}}
                    </time>
                </div> 

            </div>
            <div class="rounded-full h-3.5 flex	items-center justify-center">

                <FIcons v-if="this.$parent.$options.name == 'profile' || this.$parent.$options.name=='dashboardAdmin'" id="delete" :icon="['fas', 'trash']"
                    class="h-5 w-5 mt-6" @click="deletePost(elem.id)" />
                <FIcons v-if="this.$parent.$options.name == 'profile'" id="delete" :icon="['fas', 'edit']"
                    class="h-5 w-5 mt-6 mx-2" v-on:click="toggleModal(elem)" />
            </div>
        </div>
        <div ata-modal-toggle="defaultModal" class="whitespace-pre-wrap mt-7">{{ elem.sjt_post }}</div>
        
        <!-- reaction -->
        <div class=" h-16 border-b  flex items-center justify-around	" v-if="this.$parent.$options.name!='dashboardAdmin'">
            <div class="flex items-center	gap-3	">

                <PencilAltIcon class="h-6 w-6" />


                <div class="text-sm	"> {{ elem.comments.length }} Comments</div>
            </div>
            <div class="flex items-center	gap-3">

                <!-- like -->

                <div id="likes" class="flex items-center	gap-3" @click="setLike(elem)">
                    <FIcons v-if="isLiked(elem)" :icon="['fas', 'heart']" class="h-5 w-5" />
                    <FIcons v-else :icon="['far', 'heart']" class="h-5 w-5" />
                    <div class="text-sm"> {{ elem.likes.length }} Likes</div>
                </div>
                <div>

                </div>
            </div>
            <div id="dislike" class="flex items-center	gap-3" @click="setDislikeLike(elem)">

                <FIcons v-if="isDisLiked(elem)" :icon="['fas', 'thumbs-down']" class="h-5 w-5" />
                <FIcons v-else :icon="['far', 'thumbs-down']" class="h-5 w-5" />

                <div class="text-sm">{{ elem.dislikes.length }} Dislikes</div>
            </div>

        </div>

        <!-- comment -->
        <!-- post a comment -->
        <div  v-if="this.$parent.$options.name!='dashboardAdmin'"
            class="relative flex items-center self-center w-full max-w-xxl p-4 overflow-hidden text-gray-600 focus-within:text-gray-400">
            <img class='w-10 h-10 object-cover rounded-full shadow mr-2 cursor-pointer' alt='User avatar'
                src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
            <span class="absolute inset-y-0 right-0 flex items-center pr-6">

            </span>

            <input type="search"
                class="w-full py-2 pl-4 pr-10 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400 focus:bg-white focus:outline-none focus:border-blue-500 focus:text-gray-900 focus:shadow-outline-blue"
                style="border-radius: 25px" placeholder="Post a comment..." autocomplete="off"
                v-model="comment.sjt_comments">
            <div class="-mr-1">
                <input type='submit'
                    class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100"
                    value='Post Comment' @click="setComment(elem)">
            </div>
        </div>

        <!-- comments recent -->
        <div class="flex  bg-white dark:bg-gray-800" v-for="ele in elem.comments" :key="ele.id">
            <div class="bg-white dark:bg-gray-800 text-black  dark:text-gray-200 p-4 antialiased flex max-w-lg">
                <img class="rounded-full h-8 w-8  mt-1 " src="https://picsum.photos/id/1027/200/200" />
                <div>
                    <div class="bg-gray-100   dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                        <div class="font-semibold text-sm leading-relaxed">{{ ele.user.prenom }} {{ ele.user.nom }}
                        </div>
                        <div class="text-normal leading-snug md:leading-normal"> {{ ele.sjt_comments }}</div>
                    </div>
                    <div class="text-sm ml-4 mt-0.5 text-gray-500 dark:text-gray-400">14 w</div>

                </div>
            </div>


            <FIcons v-if="this.$parent.$options.name == 'profile' || this.$parent.$options.name=='dashboardAdmin'" id="delete" :icon="['fas', 'trash']"
                class="h-5 w-5 mt-6" @click="deleteComment(ele.id_comment)" />
        </div>

    </div>


</template>
<script>

import { computed } from '@vue/reactivity'
import { BanIcon, HeartIcon, PencilAltIcon } from '@heroicons/vue/outline'

import { useRouter } from 'vue-router';
import store from "../store";
export default {
    name: "post",
    data() {
        return {
            comment: {
                "post_id": "",
                "sjt_comments": "",
                "utilisateur_id": sessionStorage.getItem("idUser")

            },
            dataLikePost: {
                "post_id": "",
                "utilisateur_id": sessionStorage.getItem("idUser"),

            },
            postData: {
                "id": "",
                "categorie_id": "",
                "sjt_post": ""
            },
            likeId: "",
            dislikesId: "",
            testCate: true,
            idComment: this.$options.name,
            showModal: false,
            idCat: "",
            categEdit: "",


        };
    },



    components: {
        BanIcon,
        HeartIcon,
        PencilAltIcon
    },
    post: {},
    methods: {
        testEditCategorie(elm) {
            console.log(elm.categorie)

        },
        toggleModal(elm) {
            this.showModal = !this.showModal;
            if (this.showModal) {

                this.postData.id = elm.id;
                this.postData.sjt_post = elm.sjt_post;
                this.categEdit = elm.categorie.nom_categorie
                this.categEdit = elm.categorie.id
                console.log(this.postData)
            }
        },
      
        // get all posts
        getAllPosts() {
            store
                .dispatch('getAllPosts')
                .then((response) => {
                    console.log(response);
                })


        },
        updatePost() {
            this.postData.categorie_id=this.categEdit

            console.log(this.postData)

            store
                .dispatch('updatePost',this.postData)
                .then((response) => {

                    console.log(response);
                     this.showModal=!this.showModal ;

                    if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                        this.getAllPosts();
                    } else if (this.$parent.$options.name == 'profile') {
                        this.getAllPostsUser()
                    }


                })
        },
        getAllPostsUser() {
            store
                .dispatch('postByUser', sessionStorage.getItem("idUser"))
                .then((response) => {

                });
            // get all categories
        },
        setCategories() {
            store
                .dispatch('getAllCategories')
                .then((response) => {

                })

        },
        // set comment
        setComment(elem) {

            this.comment.utilisateur_id = sessionStorage.getItem("idUser");
            this.comment.post_id = elem.id;
            store
                .dispatch('comments', this.comment)
                .then((response) => {

                    this.comment.sjt_comments = "";
                    if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                        this.getAllPosts();
                    } else if (this.$parent.$options.name == 'profile') {
                        this.getAllPostsUser()
                    } this.getAllPosts();

                })

        },
        // for like

        isLiked(post) {


            for (var elem in post.likes) {
                if (post.likes[elem].utilisateur_id == this.comment.utilisateur_id) {
                    this.likeId = post.likes[elem].id
                    return true

                }

            }

        },
        async setLike(post) {

            console.log(this.postData.categorie_id);
            console.log(this.postData.sjt_post);


            this.dataLikePost.post_id = post.id;

            if (!this.isLiked(post)) {
                store
                    .dispatch('like', this.dataLikePost)
                    .then((response) => {

                        if (this.isDisLiked(post)) {
                            this.setDislikeLike(post)

                        }

                        if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                            this.getAllPosts();
                        } else if (this.$parent.$options.name == 'profile') {
                            this.getAllPostsUser()
                        }

                    })
            }
            else {
                store
                    .dispatch('destroyLike', this.likeId)
                    .then((response) => {

                        // store
                        if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                            this.getAllPosts();
                        } else if (this.$parent.$options.name == 'profile') {
                            this.getAllPostsUser()
                        }

                    })

            }
        },
        // for dislike
        isDisLiked(post) {

            for (var elem in post.dislikes) {

                if (post.dislikes[elem].utilisateur_id == this.comment.utilisateur_id) {
                    this.dislikesId = post.dislikes[elem].id
                    return true

                }

            }

        },

        async setDislikeLike(post) {


            this.dataLikePost.post_id = post.id;

            if (!this.isDisLiked(post)) {
                store
                    .dispatch('dislike', this.dataLikePost)
                    .then((response) => {


                        if (this.isLiked(post)) {
                            this.setLike(post)

                        }

                        if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                            this.getAllPosts();
                        } else if (this.$parent.$options.name == 'profile') {
                            this.getAllPostsUser()
                        }

                    })
            }
            else {
                store
                    .dispatch('destroyDisLike', this.dislikesId)
                    .then((response) => {

                        // store
                        if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                            this.getAllPosts();
                        } else {
                            this.getAllPostsUser()
                        }

                    })

            }
        },


        getAllPostsByCategorie(elem) {
            this.testCate = false;

            store
                .dispatch('getAllPostsByCategorie', elem)
                .then((response) => {
                })
        },

        // delete comment
        deleteComment(id) {

            store
                .dispatch('deleteComment', id)
                .then((response) => {

                    if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                        this.getAllPosts();
                    } else if (this.$parent.$options.name == 'profile') {
                        this.getAllPostsUser()
                    }

                })
        },

        // delete post
        deletePost(id) {
            console.log(id);
            store
                .dispatch('deletePost', id)
                .then((response) => {

                    if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
                        this.getAllPosts();
                    } else if (this.$parent.$options.name == 'profile') {
                        this.getAllPostsUser()
                    }

                })
        },



    },

    mounted() {
        console.log(this.postData);
        if (this.testCate) {
            if (this.$parent.$options.name == 'homePage' || this.$parent.$options.name=="dashboardAdmin") {
                this.getAllPosts();
            } else {
                this.getAllPostsUser()
            }

        }
        if (this.$parent.$options.name == 'homePage'|| this.$parent.$options.name=="dashboardAdmin") {
            this.getAllPosts();
        } else {
            this.getAllPostsUser()
        }
        this.setCategories();
        this.idComment = this.$options.name

    },
    props: {
        nameMethod: String,

    }
}

</script>
<style>
#likes {
    cursor: pointer;

}

#dislike {
    cursor: pointer;

}
</style>