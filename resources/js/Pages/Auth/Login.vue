<template>
    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center container-fluid" style="background-color: var(--bs-gray-200)">
        <div class="row rounded">
            <div class="col-12 d-flex justify-content-center align-content-center">
                <div class="card mb-3" style="max-width: 50rem">
                    <div class="row g-0">
                        <div class="d-none d-md-block col-md-6 p-5">
                            <img src="/assets/img/svg/undraw_sign_in_re_o58h (1).svg" class="h-100 w-100" alt="..." />
                        </div>
                        <div
                            class="col-md-6 col-12 text-white"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius); background-color: var(--bs-red)"
                        >
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <a href="/"><img src="/assets/img/logo/png/lw.png" class="w-25 h-25" style="object-fit: contain" alt="" /></a>
                                </div>
                                <form @submit.prevent="submit">
                                    <h5 class="card-title text-center">Hesabınıza giriş yapın</h5>
                                    <label for="email">Eposta</label>
                                    <div class="row" v-if="errors.email">
                                        <div class="col-12">
                                            <span>Lütfen eposta giriniz !</span>
                                        </div>
                                    </div>
                                    <input type="text" v-model="form.email" name="email" class="form-control" id="email" @keydown.space.prevent />
                                    <label for="password">Şifre</label>
                                    <div class="row" v-if="errors.password">
                                        <div class="col-12">
                                            <span>Lütfen şifre giriniz !</span>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input :type="input.inputType" v-model="form.password" name="password" class="form-control" id="password" @keydown.space.prevent />
                                        <button class="btn btn-light border" :class="{ active: input.isPassShowing }" @click="showPassword">
                                            <i class="bi bi-eye-slash" v-if="!input.isPassShowing"></i>
                                            <i class="bi bi-eye" v-else></i>
                                        </button>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <input type="checkbox" v-model="form.remember" class="form-check-input me-2" name="remember" id="remember" />
                                            <label for="remember" class="form-check-label">Beni Hatırla</label>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="/" class="text-white text-decoration-none form-link">Şifremi unuttum</a>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger border w-100 mt-2" id="login-button" @click="login">Giriş Yap</button>
                                </form>
                                <div class="row mt-2">
                                    <div class="col-12 text-center">
                                        <a :href="route('register')" class="text-white text-decoration-none form-link">Hesabınız yok mu? Hemen bir hesap oluşturun</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        v-if="errors.user"
        ref="toast"
        class="toast align-items-center text-bg-danger border-0 top-0 end-0 translate m-3 position-absolute"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="d-flex">
            <div class="toast-body">{{ errors.user }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</template>

<script>
import { router, useForm, useRemember } from "@inertiajs/vue3";
export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            form: useForm({
                email: null,
                password: null,
                remember: false,
            }),
            input: {
                isPassShowing: false,
                inputType: "password",
            },
        };
    },
    methods: {
        submit() {
            this.form.post(route("login"), {
                onError: (errors) => {
                    if (this.errors.user) {
                        const toastEl = new bootstrap.Toast(this.$refs.toast, {
                            autohide: true,
                            delay: 3000,
                        });
                        toastEl.show();
                    }
                },
            });
        },
    },
};
</script>

<style>
.form-link {
    transition: 0.2s;
}
.form-link:hover {
    opacity: 0.5;
}
#login-button:hover {
    color: var(--bs-black) !important;
    --bs-btn-hover-bg: var(--bs-white);
}
</style>
