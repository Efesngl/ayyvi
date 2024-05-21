<template>
    <UserPage>
        <div class="container h-100 w-100 p-0 d-flex justify-content-center align-items-center">
            <div class="row h-100">
                <div class="col-12 h-100 p-0">
                    <div class="card h-100 mb-3" style="max-width: 50rem">
                        <div class="row g-0">
                            <div class="d-none d-md-block col-md-6 p-5">
                                <img src="/assets/img/svg/undraw_update_re_swkp.svg" class="h-100 w-100" alt="..." />
                            </div>
                            <div class="col-md-6 col-12 text-white rounded" style="background-color: var(--bs-red)">
                                <div class="card-body p-5">
                                    <h5 class="card-title text-center">Hesap detayları</h5>
                                    <label for="name">İsim</label>
                                    <div class="row" v-if="form.errors.name">
                                        <div class="col-12">
                                            <span>İsim kısmı boş olamaz !</span>
                                        </div>
                                    </div>
                                    <input type="text" v-model="form.name" name="name" class="form-control" id="name" />
                                    <label for="email">Eposta</label>
                                    <div class="row" v-if="form.errors.email">
                                        <div class="col-12">
                                            <span>{{form.errors.email}}</span>
                                        </div>
                                    </div>
                                    <input type="text" v-model="form.email" name="email" class="form-control" id="email" />
                                    <label for="password">Şifre</label>
                                    <div class="input-group mb-3">
                                        <input :type="input.inputType" v-model="form.password" name="password" class="form-control" id="password" />
                                        <button class="btn btn-light border" :class="{ active: input.isPassShowing }" @click="showPassword">
                                            <i class="bi bi-eye-slash" v-if="!input.isPassShowing"></i>
                                            <i class="bi bi-eye" v-else></i>
                                        </button>
                                    </div>
                                    <label for="profile-photo-upload">Upload a profile photo</label>
                                    <div class="row">
                                        <div class="col-9 d-flex align-items-center">
                                            <input type="file" @input="form.pp = $event.target.files[0]" class="form-control" accept="image/*" name="profile-photo" id="profile-photo-upload">
                                        </div>
                                        <div class="col-3">
                                            <span><img :src="user.profile_photo" class="w-100 h-100 rounded"t=""></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger border w-100 mt-2" id="login-button" @click="submitForm">Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserPage>
    <div ref="toast" class="toast align-items-center text-bg-success border-0 top-0 end-0 translate m-3 position-absolute" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">Your profile is updated.</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</template>

<script>
import UserPage from "../../Layouts/UserPage.vue";
import { Link, router, useForm } from "@inertiajs/vue3";
export default {
    components: {
        UserPage,
        Link,
    },
    props: {
        user: Object,
        // errors: Object,
    },
    data() {
        return {
            input: {
                inputType: "password",
                isPassShowing: false,
            },
            form: useForm({
                _method:"patch",
                name: this.user.name,
                email: this.user.email,
                password: null,
                pp:null
            }),
        };
    },
    methods: {
        submitForm() {
            this.form.post(route("profile.update"), {
                onSuccess: () => {
                    const toastEl = new bootstrap.Toast(this.$refs.toast, {
                        autohide: true,
                        delay: 3000,
                    });
                    toastEl.show();
                },
            });
        },
    },
};
</script>
