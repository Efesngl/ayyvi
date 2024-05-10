<template>
        <MainLayout>
        <div class="container-fluid" style="height: 90dvh">
            <div class="row h-100">
                <div class="col-3 pt-3 d-none d-lg-block px-3 bg-danger text-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-12"><h3>Filtrele</h3></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <small>Kampanya ara</small>
                                <div class="input-group mb-3">
                                    <input
                                        @keyup="getPetitions(1, false)"
                                        v-model="filter.search"
                                        type="text"
                                        name="petition-search"
                                        placeholder="Kampanya ara"
                                        id="petition-search"
                                        class="form-control"
                                    />
                                    <button class="btn btn-outline-danger text-white border-white align-bottom">Ara</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <small>Kampanya türü</small>
                                <select @change="getPetitions(1, false)" name="petition-type" v-model="filter.type" id="petition-type" class="form-select">
                                    <option :value="0" selected>Bütün kampanyalar</option>
                                    <option :value="1">Popüler kampanyalar</option>
                                    <option :value="2">Yeni kampanyalar</option>
                                    <option :value="3">Başarılı kampanyalar</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center" style="height: 100%">
                            <div class="col-12">
                                <small>Konu başlığı</small>
                                <ul class="list-group h-50 topic-list overflow-scroll">
                                    <li class="list-group-item" v-for="(t, i) in topics">
                                        <input class="form-check-input me-1" type="checkbox" value="" :id="'topic_' + i" />
                                        <label @click="setTopicFilter(t.ID, false)" class="form-check-label stretched-link" :for="'topic_' + i">{{ t.topic }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 h-100">
                    <div class="container-fluid h-100 overflow-scroll">
                        <div class="row mt-2 text-center">
                            <div class="col" v-if="filter.search.trim() == ''"><h3>Kampanyalar</h3></div>
                            <div class="col" v-else>
                                <h3>Adında {{ filter.search }} bulunan Kampanyalar</h3>
                            </div>
                        </div>
                        <!-- offcanvas filter -->
                        <div class="row d-block d-lg-none">
                            <div class="col-12">
                                <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                    <i class="bi bi-sliders2"></i> Filtrele
                                </button>

                                <div
                                    ref="of"
                                    class="offcanvas offcanvas-start bg-danger text-white"
                                    data-bs-scroll="false"
                                    tabindex="-1"
                                    id="offcanvasExample"
                                    aria-labelledby="offcanvasExampleLabel"
                                >
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtrele</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <small>Kampanya ara</small>
                                                <div class="input-group mb-3">
                                                    <input
                                                        v-model="filter.search"
                                                        type="text"
                                                        name="petition-search-of"
                                                        placeholder="Kampanya ara"
                                                        id="petition-search-of"
                                                        class="form-control"
                                                    />
                                                    <button class="btn btn-outline-danger text-white border-white align-bottom">Ara</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <small>Kampanya türü</small>
                                                <select name="petition-type-of" v-model="filter.type" id="petition-type-of" class="form-select">
                                                    <option :value="0" selected>Bütün kampanyalar</option>
                                                    <option :value="1">Popüler kampanyalar</option>
                                                    <option :value="2">Yeni kampanyalar</option>
                                                    <option :value="3">Başarılı kampanyalar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" style="height: 100%">
                                            <div class="col-12">
                                                <small>Konu başlığı</small>
                                                <ul class="list-group h-50 topic-list overflow-scroll">
                                                    <li class="list-group-item" v-for="(t, i) in topics">
                                                        <input class="form-check-input me-1" type="checkbox" value="" :id="'of-topic_' + i" />
                                                        <label @click="setTopicFilter(t.ID, true)" class="form-check-label stretched-link" :for="'of-topic_' + i">{{
                                                            t.topic
                                                        }}</label>
                                                    </li>
                                                </ul>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-danger border-white text-white w-100 mt-3" @click="getPetitions(1, true)">Filtrele</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <BrowsepetitionCard v-for="petition in petitions.data" :petition="petition" v-if="petitions.total>0">
                            <template v-slot:browsepetitionCardImage>
                                <img :src="'/'+petition.petition_banner" class="w-100 h-100 rounded-start" style="object-fit: fill" alt="..." />
                            </template>
                            <template v-slot:browsepetitionCardHeader>
                                <h5 class="card-title">{{ petition.petition_header }}</h5>
                            </template>
                            <template v-slot:browsepetitionCardContent>
                                <p class="card-text">{{ petition.petition_content }}</p>
                            </template>
                            <template v-slot:browsepetitionCardButton>
                                <div class="row mt-2">
                                    <div class="col-12 text-center">
                                        <Link :href="route('petition.show',petition.id)" class="btn btn-danger text-decoration-none"
                                            >Kampanyaya git</Link
                                        >
                                    </div>
                                </div>
                            </template>
                        </BrowsepetitionCard>
                        <div class="row" v-else>
                            <div class="col-12">
                                <h3 >
                                    There isn't any petition yet !
                                </h3>
                            </div>
                        </div>
                        <div class="row" v-if="petitions.total!=0">
                            <div class="col-12">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item" :class="{ disabled: petitions.current_page == 1 }">
                                        <button class="page-link"><i class="bi bi-arrow-left"></i></button>
                                    </li>
                                    <li class="page-item" :class="{ active: p == petitions.current_page }" v-for="p in petitions.total/petitions.per_page">
                                        <button class="page-link">{{ p }}</button>
                                    </li>
                                    <li class="page-item">
                                        <button class="page-link" :class="{ disabled: petitions.current_page == petitions.last_page}">
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";
import BrowsepetitionCard from "../../Components/BrowsePetitionCard.vue";
import * as bootstrap from "bootstrap";
import { Link } from "@inertiajs/vue3";
export default {
    components: {
        BrowsepetitionCard,
        MainLayout,
        Link
    },
    computed: {
        paginator() {
            return Math.ceil(this.totalPetitions / this.offset);
        },
    },
    props:{
        petitions:Object,
        topics:Object
    },
    data() {
        return {
            page:1,
            of: null,
            filter: {
                search: "",
                topics: [],
                type: 0,
            },
            offset:5,
            totalPetitions:100
        };
    },
};
</script>

<style>
#sections .active {
    color: var(--dark-red) !important;
}
#sections .browse-link {
    color: black;
}
.topic-list {
    border-radius: 0.375rem;
}
.topic-list::-webkit-scrollbar {
    display: none;
}
</style>
