<template>
    <div class="container-fluid vw-100 vh-100 d-flex align-items-center justify-content-center" style="background-color: var(--bs-gray-200)">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-content-center">
                <div class="card mb-3" style="max-width: 50rem">
                    <div class="row g-0">
                        <div class="col-md-6 d-none d-md-block p-5">
                            <img src="/assets/img/svg/undraw_sign_up_n6im (1).svg" class="h-100 w-100" alt="..." />
                        </div>
                        <div
                            class="col-md-6 col-12 text-white"
                            style="background: var(--bs-red); border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius)"
                        >
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <a href="/"><img src="/assets/img/logo/png/lw.png" class="w-25 h-25" style="object-fit: contain" alt="" /></a>
                                </div>
                                <h5 class="card-title text-center">Hemen yeni bir hesap oluşturun</h5>
                                <label for="firstname">İsim</label>
                                <input type="text" v-model="user.name" name="firstname" class="form-control" id="firstname" />
                                <div class="row" v-if="errors.name">
                                    <div class="col-12">
                                        <span>Bu alanı doldurmak zorunludur !</span>
                                    </div>
                                </div>
                                <label for="email">Eposta</label>
                                <input type="text" name="email" v-model="user.email" class="form-control" id="email" @keydown.space.prevent />
                                <div class="row" v-if="errors.email">
                                    <div class="col-12">
                                        <span>Bu alanı doldurmak zorunludur !</span>
                                    </div>
                                </div>
                                <label for="password">Şifre</label>
                                <div class="input-group">
                                    <input :type="input.inputType" @keydown.space.prevent v-model="user.password" name="password" class="form-control" id="password" />
                                    <button class="btn btn-light border" :class="{ active: input.isPassShowing }" @click="showPassword">
                                        <i class="bi bi-eye-slash" v-if="!input.isPassShowing"></i>
                                        <i class="bi bi-eye" v-else></i>
                                    </button>
                                </div>
                                <div class="row" v-if="errors.password">
                                    <div class="col-12">
                                        <span>Bu alanı doldurmak zorunludur !</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input type="checkbox" class="form-check-input me-2" v-model="user.termsAndPrivacy" name="terms-and-privacy" id="terms-and-privacy" />
                                        <label for="terms-and-privacy" class="form-check-label">Şartları Okudum ve kabul ediyorun</label>
                                    </div>
                                </div>
                                <div class="row" v-if="errors.termsAndPrivacy">
                                  <div class="col-12">
                                    <span>Bu alanı doldurmak zorunludur !</span>
                                  </div>
                                </div>
                                <button class="btn btn-danger border w-100 mt-2" id="register-button" @click="register">Üye ol</button>
                                <div class="row mt-2">
                                    <div class="col-12 text-center">
                                        <a :href="route('login')" class="text-white text-decoration-none form-link">Zaten bir hesabınız var mı? Hemen giriş yapın</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            input: {
                isPassShowing: false,
                inputType: "password",
            },
            user: {
                name: "",
                email: "",
                password: "",
                termsAndPrivacy: false,
            },
        };
    },
    methods: {
        register() {
            router.post(route("user.store"), this.user,{
                onSuccess: (page) => {
                    console.log(page);
                },
            });
        },
    },
};
</script>
<style>
#register-button:hover {
    color: var(--bs-black) !important;
    --bs-btn-hover-bg: var(--bs-white);
}
p {
    margin: 0;
}
</style>
