<template>
    <MainLayout>
        <div class="container min-vh-100">
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <h2>{{ petition.petition_header }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8" id="petitionContent">
                    <div class="row">
                        <div class="col-12">
                            <img :src="petition.petition_banner" class="w-100 h-100" style="object-fit: fill" alt="" />
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 fs-5">
                            <span v-html="content"></span>
                        </div>
                    </div>
                </div>
                <!-- sign petition desktop -->
                <div class="col-4 d-none d-md-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <!-- <img :src="petition.userPP" class="petition-creator-logo" alt="" /> -->
                            </div>
                            <div class="col-10 fs-5 d-flex align-items-center">
                                <span>{{ petition.user.name }}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <small
                                    ><span>Created at : {{ petition.created_at }}</span></small
                                >
                            </div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" :style="{ width: SignProgress + '%' }"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <small> {{ petition.reason_count }} people signed this petition</small>
                            </div>
                            <div class="col-6 text-end">
                                <small>Target sign: {{ petition.target_sign }} </small>
                            </div>
                        </div>
                        <div v-if="petition.status != 3">
                            <div v-if="$page.props.user">
                                <div v-if="petition.creator != $page.props.user.id">
                                    <div class="row mt-5" v-if="!is_signed">
                                        <div class="col-12">
                                            <h6>Sign Reason (not required if show reason isn't checked)</h6>
                                            <textarea
                                                name="reason"
                                                v-model="signReason.reason"
                                                id="reason"
                                                style="resize: vertical"
                                                class="form-control w-100"
                                                maxlength="100"
                                            ></textarea>
                                            <div class="row">
                                                <div class="col text-end">{{ signReasonReaminingWord }} reamining words</div>
                                            </div>
                                            <input type="checkbox" v-model="signReason.willShown" name="will_show" id="will_show" class="form-check-input me-1" />
                                            <label for="will_show" class="form-check-label">Show my sign reason in this petition</label>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12" v-auto-animate>
                                            <button class="btn btn-danger w-100" @click.prevent="signPetition" v-if="!is_signed">Sign petition</button>
                                            <button class="btn btn-outline-danger w-100" @click="unsignPetition" v-else>
                                                Petition signed <i class="bi bi-check2-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <Link :href="route('petition.edit', petition.id)" class="btn btn-danger text-white w-100">Edit petition</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="row">
                                    <div class="col-12 text-center fs-3 text-danger">İmza atmak için giriş yapmalısınız !</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2" v-else>
                            <div class="col-12 text-center">
                                <span class="text-danger rounded fs-3">Bu kampanya başarıya ulaştı <i class="bi bi-balloon-heart-fill"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- petition sign mobile -->
            <div class="row d-block d-md-none">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <!-- <img :src="this.apiURL + petition.userPP" class="petition-creator-logo" alt="" /> -->
                            </div>
                            <div class="col-10 fs-5 d-flex align-items-center">
                                <span>{{ petition.user.id }}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <small
                                    ><span>Oluşturulma tarihi : {{ petition.created_at }}</span></small
                                >
                            </div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" :style="{ width: SignProgress + '%' }"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <small> {{ petition.reason_count }} kişi bu kampanyaya katıldı</small>
                            </div>
                            <div class="col-6 text-end">
                                <small>Toplam hedef {{ petition.target_sign }} imza</small>
                            </div>
                        </div>
                        <div v-if="petition.status != 3">
                            <div v-if="$page.props.user">
                                <div v-if="petition.creator != $page.props.user.id">
                                    <div class="row mt-5" v-if="!is_signed">
                                        <div class="col-12">
                                            <h6>Kampanyaya katılma nedeni (zorunlu değil)</h6>
                                            <small v-if="signReason.isReasonEmpty" class="text-danger"
                                                >Katılım nedeninizin görünmesini istiyorsanız bu alanı doldurmak zorunludur*</small
                                            >
                                            <textarea
                                                name="reason"
                                                v-model="signReason.reason"
                                                id="reason"
                                                style="resize: vertical"
                                                class="form-control w-100"
                                                maxlength="100"
                                            ></textarea>
                                            <div class="row">
                                                <div class="col text-end">{{ signReasonReaminingWord }} kelime</div>
                                            </div>
                                            <input type="checkbox" v-model="signReason.willShown" name="will_show" id="will_show" class="form-check-input me-1" />
                                            <label for="will_show" class="form-check-label">Kampanyaya katılma sebebimi bu kampanyada göster</label>
                                        </div>
                                    </div>
                                    <div class="row mt-2" v-if="petition.status != 3">
                                        <div class="col-12" v-auto-animate>
                                            <button class="btn btn-danger w-100" @click.prevent="signPetition" v-if="!is_signed">Kampanyaya katıl</button>
                                            <button class="btn btn-outline-danger w-100" @click="unsignPetition" v-else>
                                                Kampanyaya katılındı <i class="bi bi-check2-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <Link :href="route('petition.edit', petition.id)" class="btn btn-danger text-white w-100">Kampanyayı düzenle</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="row">
                                    <div class="col-12 text-center fs-3 text-danger">Kampanyayı imzalamak için giriş yapmalısınız !</div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col-12 text-center">
                                <span class="text-danger rounded fs-3">Bu kampanya başarıya ulaştı <i class="bi bi-balloon-heart-fill"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div id="comments" v-if="reasons.length > 0">
                <div class="row mt-3">
                    <div class="col-12">
                        <h2>Katılma nedenleri</h2>
                    </div>
                </div>
                <petitionCommentsCard v-for="r in reasons" :comment="r"></petitionCommentsCard>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-danger w-50" @click="seeMoreComment">Daha fazla neden göster</button>
                    </div>
                </div>
            </div>
            <div id="comments" v-else>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <h2>Bu kampanya için gösterilebilecek bir katılma nedeni yoktur</h2>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
    <div
        v-if="errors.reason"
        ref="toast"
        class="toast align-items-center text-bg-danger border-0 top-0 end-0 translate m-3 position-absolute"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="d-flex">
            <div class="toast-body">{{ errors.reason }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</template>

<script>
import { Link, router } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import petitionCommentsCard from "../../Components/PetitionCommentsCard.vue";
export default {
    components: {
        MainLayout,
        Link,
        petitionCommentsCard
    },
    props: {
        petition: Object,
        reasons: Object,
        errors:Object,
        is_signed: Boolean,
        content:String,
        reasons:Object
    },
    data() {
        return {
            signReason: {
                reason: "",
                willShown: false,
                isReasonEmpty: false,
                reaminingWord: 100,
            },
        };
    },
    computed: {
        SignProgress() {
            return (this.petition.reason_count / this.petition.target_sign) * 100;
        },
        signReasonReaminingWord() {
            return 100 - this.signReason.reason.length;
        },
    },
    methods: {
        signPetition() {
            router.post(route("petition.sign", this.petition.id), this.signReason,{
                onError:error=>{
                    const toastEl = new bootstrap.Toast(this.$refs.toast, {
                            autohide: true,
                            delay: 3000,
                        });
                        toastEl.show();
                }
            });
        },
        unsignPetition(){
            router.delete(route("petition.unsign", this.petition.id),{
                onError:error=>{
                    const toastEl = new bootstrap.Toast(this.$refs.toast, {
                            autohide: true,
                            delay: 3000,
                        });
                        toastEl.show();
                }
            });
        }
    },
};
</script>
<style>
.petition-comment-user-logo {
    max-width: 2rem;
    max-height: 2rem;
    border-radius: 50%;
}
.petition-creator-logo {
    max-width: 3rem;
    max-height: 3rem;
    border-radius: 50%;
}
</style>
