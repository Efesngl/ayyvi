<template>
    <UserPage>
        <div class="container h-auto min-vh-100" v-if="petitions.length > 0">
            <JoinedpetitionsCard v-for="p in petitions" :totalSigned="p.total_signed" :targetSign="p.target_sign">
                <template v-slot:browsepetitionCardImage>
                    <img :src="p.petition_image" class="w-100 h-100 rounded-start" style="object-fit: fill" alt="..." />
                </template>
                <template v-slot:browsepetitionCardHeader>
                    <h5 class="card-title">{{ p.petition_header }}</h5>
                </template>
                <template v-slot:browsepetitionCardContent>
                    <p class="card-text">
                        <span v-html="p.petition_content"></span>
                    </p>
                </template>
                <template v-slot:browsepetitionCardButton>
                    <div class="row mt-2">
                        <div class="col-6 text-center">
                            <Link :href="route('petition.edit',p.id)" class="btn btn-danger">Kampanyayı düzenle</Link>
                        </div>
                        <div class="col-6 text-center">
                            <Link :href="route('petition.show',p.id)" class="btn btn-primary h-100">Kampanyaya git</Link>
                        </div>
                    </div>
                </template>
            </JoinedpetitionsCard>
        </div>
        <div class="container h-auto min-vh-100" v-else>
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="text-danger">Başlattığınız herhangi bir kampanya yoktur !</h3>
                    <Link :href="route('petitions.create')" class="btn btn-danger">Hemen bir kampanya başlatın</Link>
                </div>
            </div>
        </div>
    </UserPage>
</template>

<script>
import UserPage from "../../Layouts/UserPage.vue";
import JoinedpetitionsCard from "../../Components/JoinedPetitionsCard.vue";
import { Link } from "@inertiajs/vue3";
export default {
    props: {
        petitions: Object,
    },
    components: {
        Link,
        UserPage,
        JoinedpetitionsCard,
    },
    methods: {},
};
</script>
