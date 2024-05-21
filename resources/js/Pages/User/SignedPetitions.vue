<template>
    <UserPage>
        <div class="container h-auto min-vh-100" v-if="petitions.length > 0">
            <JoinedPetitionsCard v-for="p in petitions" :totalSigned="p.reason_count" :targetSign="p.target_sign">
                <template v-slot:browsepetitionCardImage>
                    <img :src="p.petition_banner" class="w-100 h-100 rounded-start" style="object-fit: fill" alt="..." />
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
                        <div class="col-12 text-center">
                            <Link :href="route('petition.show', p.id)" class="btn btn-danger">Kampanyaya git</Link>
                        </div>
                    </div>
                </template>
            </JoinedPetitionsCard>
        </div>
        <div class="container h-auto min-vh-100" v-else>
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="text-danger">Katıldığınız bir kampanya yoktur!</h3>
                    <Link to="/gozat" class="btn btn-danger">Hemen katılmak için kampanyalara göz atın</Link>
                </div>
            </div>
        </div>
    </UserPage>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import UserPage from "../../Layouts/UserPage.vue";
import JoinedPetitionsCard from "../../Components/JoinedPetitionsCard.vue";
export default {
    props: {
        petitions: Object,
    },
    components: {
        JoinedPetitionsCard,
        Link,
        UserPage,
    },
};
</script>
