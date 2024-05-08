<template>
    <MainLayout>
        <div class="container h-auto">
            <h2 class="text-center">Kampanya düzenle</h2>
            <div class="row">
                <div class="col-12 text-end">
                    <Link :href="route('user.petitions')" class="btn btn-danger">Geri git</Link>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label for="petition-location">Kampanya kapsamı</label>
                    <select class="form-select" name="petition-location">
                        <option selected>Kampanya kapsamı</option>
                        <option value="1">Ulusal</option>
                        <option value="2">Global</option>
                    </select>
                    <label for="petition-topic">Kampanya konusu</label>
                    <p class="text-danger" v-if="!errors.isTopicSelected">Kampanya konusu seçmek zorunludur !</p>
                    <select class="form-select" name="petition-topic" v-model="petition.petitionTopic">
                        <option :value="0" selected>Kampanya konusu</option>
                        <option :value="t.ID" :selected="petition.topic[0].id == t.id" v-for="t in topics">{{ t.topic }}</option>
                    </select>
                    <label for="petition-header">Kampanya başlığı</label>
                    <p class="text-danger" v-if="errors.isHeaderEmpty">Kampanya başlığı girmek zorunludur !</p>
                    <input type="text" v-model="petition.petition_header" name="petition-header" id="" class="form-control" />
                    <label for="petition-location">Hedef imza sayısı</label>
                    <p class="text-danger" v-if="errors.isTargetSignEmpty">Hedef imza sayısı belirlemek zorunludur !</p>
                    <input type="number" v-model="petition.target_sign" min="10" name="petition-image" id="" class="form-control" />
                    <div class="progress mt-1" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" :style="{ width: progress + '%' }"></div>
                    </div>
                    <span>{{ petition.totalSigned }} kişi imzaladı</span>
                </div>
                <div class="col-6 d-none d-md-block">
                    <label for="petition-location">Kampanya resmi</label>
                    <form :action="route('petition.uploadbanner')" class="dropzone" id="petition-banner">
                      <label id="upload-banner-label" for="petition-banner-upload" class="d-flex justify-content-center flex-column align-items-center"><span><h4>Click here to upload banner</h4></span><span><i class="fa-solid fa-file-arrow-up fa-3x"></i></span></label>
                      <input type="file" name="file" id="petition-banner-upload" class="d-none">
                    </form>
                </div>
            </div>
            <div class="row mt-2">
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
                    <div id="dropzone" class="container border">İmage upload</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="petition-content">Kampanya içeriği</label>
                    <p class="text-danger" v-if="errors.isContentEmpty">Kampanya içeriği girmek zorunludur !</p>
                    <ckeditor :editor="editor" v-model="petition.petition_content" tag-name="petition-content" :config="editorConfig"></ckeditor>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-6 text-center">
                    <button class="btn btn-success" @click="updatePetition">Kaydet</button>
                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-danger" @click="deletePetition">Kampanyayı sil</button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import "@ckeditor/ckeditor5-build-classic/build/translations/tr.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import CKEditor from "@ckeditor/ckeditor5-vue";
import MainLayout from "../../Layouts/MainLayout.vue";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
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
    async mounted() {
      await Dropzone.discover()
        console.log(this.$page.props.csrf_token);
        await Dropzone.options.petitionBanner= {
            // url: route("petition.uploadbanner"),
            headers: {
                "X-CSRF-TOKEN": this.$page.props.csrf_token,
            },
            maxFiles:1,
            // clickable:["#dropzone>*","#dropzone"],
            acceptedFiles:"image/*",
            addRemoveLinks:true,
            withCredentials: true,
        };
    },
    // methods: {
    //     getTopics() {
    //         this.$axios.get("gettopics").then((res) => {
    //             this.topics = res.data.topics;
    //         });
    //     },
    //     getpetition() {
    //         this.$axios.get(`petitions/petitiondetail/${this.$route.params.ID}?type=edit`).then((res) => {
    //             this.petition = res.data.petition[0];
    //         });
    //     },
    //     isTopicSelected() {
    //         if (this.petition.petitionTopic == 0) {
    //             this.errors.isTopicSelected = false;
    //         }
    //     },
    //     isHeaderEmpty() {
    //         if (!/([^\s])/.test(this.petition.petitionHeader)) {
    //             this.errors.isHeaderEmpty = true;
    //         }
    //     },
    //     isContentEmpty() {
    //         if (!/([^\s])/.test(this.petition.petitionContent)) {
    //             this.errors.isContentEmpty = true;
    //         }
    //     },
    //     checkErrors() {
    //         this.errors = {
    //             isTopicSelected: true,
    //             isHeaderEmpty: false,
    //             isContentEmpty: false,
    //         };
    //         this.isContentEmpty();
    //         this.isHeaderEmpty();
    //         this.isTopicSelected();
    //         for (let e in this.errors) {
    //             if (e == "isTopicSelected") {
    //                 if (this.errors[e] == false) {
    //                     return false;
    //                 }
    //             } else {
    //                 if (this.errors[e] == true) {
    //                     return false;
    //                 }
    //             }
    //         }
    //         return true;
    //     },
    // },
    computed: {
        progress() {
            return (this.petition.totalSigned / this.petition.targetSign) * 100;
        },
    },
};
</script>
<style>
#upload-banner-label>*{
  transition: 0.2s;
}
#upload-banner-label:hover > *{
  color:var(--bs-danger);
}
.ck-editor__editable_inline {
    height: 25rem;
}
</style>
