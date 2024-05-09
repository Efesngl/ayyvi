<template>
    <MainLayout>
        <div class="container h-auto">
            <h2 class="text-center">Kampanya düzenle</h2>
            {{ $page.props.errors }}
            <div class="row">
                <div class="col-12 text-end">
                    <Link :href="route('user.petitions')" class="btn btn-danger">Geri git</Link>
                </div>
            </div>
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col">
                                <label for="petition-location">Kampanya kapsamı</label>
                                <select class="form-select mb-3" name="petition-location">
                                    <option selected>Kampanya kapsamı</option>
                                    <option value="1">Ulusal</option>
                                    <option value="2">Global</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="petition-topic">Kampanya konusu</label>
                                <!-- <p class="text-danger" v-if="!errors.isTopicSelected">Kampanya konusu seçmek zorunludur !</p> -->
                                <select class="form-select mb-3" name="petition-topic" v-model="petition.topic[0].topic_id">
                                    <option>Kampanya konusu</option>
                                    <option :value="t.id" v-for="t in topics">{{ t.topic }}</option>
                                </select>
                            </div>
                        </div>
                        <label for="petition-header">Kampanya başlığı</label>
                        <!-- <p class="text-danger" v-if="errors.isHeaderEmpty">Kampanya başlığı girmek zorunludur !</p> -->
                        <input type="text" v-model="petition.petition_header" name="petition-header" id="" class="form-control" />
                        <label for="petition-location">Hedef imza sayısı</label>
                        <!-- <p class="text-danger" v-if="errors.isTargetSignEmpty">Hedef imza sayısı belirlemek zorunludur !</p> -->
                        <input type="number" v-model="petition.target_sign" min="10" name="petition-image" id="" class="form-control mb-3" />
                        <div class="progress mt-1" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" :style="{ width: progress + '%' }"></div>
                        </div>
                        <span>{{ petition.totalSigned }} kişi imzaladı</span>
                        <div class="row mt-2 mb-3">
                            <div class="col-6" v-if="petition.status != 3">
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        :true-value="2"
                                        :false-value="1"
                                        id="flexSwitchCheckChecked"
                                        v-model="petition.statusChanged"
                                    />
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Kampanya başarılı</label>
                                </div>
                            </div>
                            <div :class="{ 'col-6': petition.success != 3, 'col-12': petition.success == 3 }" v-if="petition.status != 1">
                                <p v-if="petition.status == 2" class="text-primary">Kampanya başarı durumu inceleniyor !</p>
                                <p v-if="petition.status == 3" class="text-success">Kampanya başarısı onaylandı !</p>
                                <p v-if="petition.status == 4" class="text-danger">Kampanya başarısı onaylanmadı !</p>
                            </div>
                        </div>
                        <div class="row d-block d-md-none">
                            <div class="col-12">
                                <label for="petition-location">Kampanya resmi</label>
                                <input type="file" @input="petition.Bpetition_banner = $event.target.files[0]" name="file" id="petition-banner" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <div class="row">
                            <div class="col-9">
                                <label for="petition-location ">Kampanya resmi</label><br />
                                <input type="file" name="file" @input="petition.petition_banner = $event.target.files[0]" id="petition-banner" accept="image/*" />
                            </div>
                            <div class="col-3">
                                <img :src="petition.petition_banner" alt="" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="petition-content">Kampanya içeriği</label>
                                <!-- <p class="text-danger" v-if="errors.isContentEmpty">Kampanya içeriği girmek zorunludur !</p> -->
                                <ckeditor :editor="editor" v-model="petition.petition_content" tag-name="petition-content" :config="editorConfig"></ckeditor>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6 text-center">
                        <button class="btn btn-success" type="submit">Kaydet</button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete-petition">Kampanyayı sil</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="delete-petition" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete-petition" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-petition-modal-label">This proccess cant be revert !</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Do you want to delete this petition ?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" @click="deletePetition">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
    <div class="toast-container p-3 top-0 end-0" id="toastPlacement" data-original-class="toast-container p-3">
        <div ref="toast" class="text-bg-success toast fade hide">
            <div class="d-flex">
                <div class="toast-body">Your petition is updated !</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</template>

<script>
import "@ckeditor/ckeditor5-build-classic/build/translations/tr.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import CKEditor from "@ckeditor/ckeditor5-vue";
import MainLayout from "../../Layouts/MainLayout.vue";
import { computed } from "vue";
import { Link, useForm, router } from "@inertiajs/vue3";
import Dropzone from "dropzone";
export default {
    components: {
        Link,
        MainLayout: MainLayout,
        ckeditor: CKEditor.component,
    },
    props: {
        petition: Object,
        topics: Object,
        errors: Object,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: ["undo", "redo", "|", "heading", "|", "bold", "italic", "|", "bulletedList", "numberedList", "outdent", "indent"],
                },
                language: "tr",
            },
        };
    },
    methods: {
        submitForm() {
            this.petition._method = "put";
            router.post(route("petition.update", this.petition.id), this.petition, {
                onFinish: (event) => {
                    const toastEl = new bootstrap.Toast(this.$refs.toast, {
                        autohide: true,
                        delay: 3000,
                    });
                    toastEl.show();
                },
            });
        },
        deletePetition() {
            router.delete(route("petition.destroy", this.petition.id), {
                onSuccess: async(event) => {
                    const myModal = await new bootstrap.Modal("#delete-petition");
                    document.body.classList.remove("modal-open")
                    await myModal.hide();
                },
            });
        },
    },
    mounted() {
        Dropzone.options.petitionBanner = {
            // url: route("petition.uploadbanner"),
            headers: {
                "X-CSRF-TOKEN": this.$page.props.csrf_token,
            },
            maxFiles: 1,
            // clickable:["#dropzone>*","#dropzone"],
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            withCredentials: true,
        };
        Dropzone.discover();
    },
    beforeUnmount() {
        console.log("exiting");
    },
    computed: {
        progress() {
            return (this.petition.totalSigned / this.petition.targetSign) * 100;
        },
    },
};
</script>
<style>
#upload-banner-label > * {
    transition: 0.2s;
}
#upload-banner-label:hover > * {
    color: var(--bs-danger);
}
.ck-editor__editable_inline {
    height: 25rem;
}
</style>
