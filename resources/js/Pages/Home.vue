<template>
    <MainLayout>
        <!-- slogan -->
        <div class="container-fluid vh-100 mb-5" id="slogan">
            <div class="row h-100">
                <div class="col-12 col-md-5 p-5 text-white d-flex justify-content-center flex-column" style="background: var(--dark-red)">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="fs-1">Değişim için AYYVİ</h2>
                            <span class="fs-3">Toplam {{ petitionCount }} kampanya ile dünya çapında değişim </span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <Link :href="route('petition.create')" class="btn btn-outline-danger text-white border btn-lg" id="start-petition-button">Kampanya başlat</Link>
                        </div>
                    </div>
                </div>
                <div class="col-7 d-none d-md-block">
                    <img src="/assets/img/svg/start_love.svg" class="w-100 h-100" alt="" />
                </div>
            </div>
        </div>
        <!-- successed petitions -->
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Başarılı kampanyalar</h2>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-5 g-4 mt-2" id="succeded-petitions" v-if="succededPetitions.length > 0">
                <SuccededPetitions v-for="sp in succededPetitions" :sp="sp"></SuccededPetitions>
            </div>
            <div class="row" v-else>
                <div class="col-12 text-center">
                    <h4 class="text-danger">Başarılı bir kampanya bulunmamaktadır !</h4>
                </div>
            </div>
        </div>
        <hr class="border-3 mt-5" />
        <!-- kampanyalar -->
        <div class="container-fluid">
            <div class="petitions text-center mt-5 mb-5">
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h2>Öne çıkan kampanyalar</h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-4 g-4 p-1 p-md-5" v-if="popularPetitions.length > 0">
                    <HomePagePetitions v-for="(pt, i) in popularPetitions" :petition="pt"></HomePagePetitions>
                </div>
                <div class="row" v-else>
                    <div class="col-12 text-center">
                        <h4 class="text-danger">Öne çıkan bir kampanya bulunmamaktadır !</h4>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <Link :href="route('petition.index')" class="btn btn-danger">Daha fazla kampanyaya göz gezdir</Link>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import HomePagePetitions from "../Components/HomePagePetitions.vue";
import SuccededPetitions from "../Components/SuccededPetitions.vue";
import MainLayout from "../Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
export default {
    components: {
        HomePagePetitions,
        SuccededPetitions,
        MainLayout,
        Link
    },
    props: {
        succededPetitions: Array,
        popularPetitions: Array,
        petitionCount:Number,
        // socials:Array
    },
};
</script>

<style>
#start-petition-button:hover {
    color: var(--bs-black) !important;
    --bs-btn-hover-bg: var(--bs-white);
}
#slogan {
    /* background-image: url("../assets/img/svg/love.svg");
    background-position: left;
    background-size: contain;
    background-repeat: no-repeat; */
}
</style>
