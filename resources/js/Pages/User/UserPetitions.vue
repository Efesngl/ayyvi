<template>
    <UserPage>
        <div class="container h-auto min-vh-100" v-if="petitions.length > 0">
            <JoinedpetitionsCard v-for="p in petitions" :totalSigned="p.total_signed" :targetSign="p.target_sign">
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
                        <div class="col-6 text-center">
                            <Link :href="route('petition.edit', p.id)" class="btn btn-danger">Kampanyayı düzenle</Link>
                        </div>
                        <div class="col-6 text-center">
                            <Link :href="route('petition.show', p.id)" class="btn btn-primary h-100">Kampanyaya git</Link>
                        </div>
                    </div>
                </template>
            </JoinedpetitionsCard>
        </div>
        <div class="container h-auto min-vh-100" v-else>
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="text-danger">Başlattığınız herhangi bir kampanya yoktur !</h3>
                    <Link :href="route('petition.create')" class="btn btn-danger">Hemen bir kampanya başlatın</Link>
                </div>
            </div>
        </div>
    </UserPage>
    <div
    v-if="$page.props.flash.success"
        ref="toast"
        class="toast align-items-center border-0 top-0 end-0 translate m-3 position-absolute"
        :class="{'text-bg-success':$page.props.flash.success,'text-bg-danger':$page.props.flash.error}"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="d-flex">
            <div class="toast-body">{{ $page.props.flash.success }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
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
    mounted() {
        const toastEl = new bootstrap.Toast(this.$refs.toast, {
            autohide: true,
            delay: 3000,
        });
        if(this.$page.props.flash.success){
            toastEl.show()
        }
        this.checkAndModifyBody();
    },
    updated() {
        this.checkAndModifyBody();
    },
    methods: {
        checkAndModifyBody() {
            let body = document.body;
            const modalOpenClass = "modal-open";
            const expectedStyle = "margin-bottom: 8px;";
            const modalBackdropSelector = "div.modal-backdrop.fade.show";

            if (body.classList.contains(modalOpenClass)) {
                body.classList.remove(modalOpenClass);
            }

            if (body.style.cssText !== expectedStyle) {
                body.style.cssText = "margin-bottom: 8px;";
            }

            const modalBackdrop = body.querySelector(modalBackdropSelector);
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
        },
    },
};
</script>
