<template>
    <div class="mt-5 container w-75 h-100 d-flex flex-column justify-content-between" id="start-petition-form" v-if="$page.props.user!=null">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="fs-1">Herşey hazır hadi kampanyanı yayınlayalım !</h2>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-6 text-center">
                <button class="btn btn-danger" @click="decStep">Önceki adım</button>
            </div>
            <div class="col-6 text-center">
                <button class="btn btn-danger" @click="createPetition">Kampanyayı yayınla</button>
            </div>
        </div>
    </div>
    <div class="mt-5 container w-75 h-100 d-flex flex-column justify-content-between" id="start-petition-form" v-else>
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="fs-1">Kampanyanı yayınlamadan önce lütfen giriş yap !</h2>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-6 text-center">
                <button class="btn btn-danger h-100" @click="decStep">Önceki adım</button>
            </div>
            <div class="col-6 text-center">
                <Link :href="route('login')" class="btn btn-danger h-100">Giriş yap</Link>
                <!-- <button class="btn btn-danger" @click="startThePetition">Giriş Yap</button> -->
            </div>
        </div>
    </div>
</template>

<script>
import { Link,router } from '@inertiajs/vue3';
export default {
    inject: ["decStep","user","petition"],
    components:{
        Link
    },
    methods:{
        createPetition(){
            router.post(route("petition.store"),petition)
        }
    }
};
</script>