<template>
    <div class="mt-5 container w-75 h-100 d-flex flex-column justify-content-between" id="start-petition-form" v-if="userStore.isLogged">
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
                <button class="btn btn-danger" @click="startThePetition">Kampanyayı yayınla</button>
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
                <RouterLink to="/giris" class="btn btn-danger h-100">Giriş yap</RouterLink>
                <!-- <button class="btn btn-danger" @click="startThePetition">Giriş Yap</button> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
        };
    },
    inject: ["decStep"],
    methods: {
    },
};
</script>