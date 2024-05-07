<template>
    <div class="mt-5 container w-75 h-100 d-flex flex-column justify-content-between" id="start-petition-form">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="fs-1">Kampanya için bir görsel ekleyin</h2>
            </div>
        </div>
        <div class="row" v-if="errors.length > 0">
            <div class="col-12 text-center">
                <span class="text-danger">
                    {{ errors[0] }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12 flex-fill h-100">
                <!-- <ImageUpload :maxSize=5 ref="imageUploader" buttontxt="Görsel ekle"></ImageUpload> -->
                <div id="dropzone" class="border d-flex justify-content-center flex-column align-items-center p-5 rounded border-danger" ref="dropzoneDiv">
                  <h1 class="mb-5">Upload petition banner</h1>
                  <i class="fa-solid fa-file-arrow-up fa-5x"></i>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-6">
                <button class="btn btn-danger" @click="decStep">Önceki adım</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-danger" @click="incStep">Sonraki adım</button>
            </div>
        </div>
    </div>
</template>

<script>
import ImageUpload from "../../Components/ImageUpload.vue";
import Dropzone from "dropzone"
export default {
    components: {
        ImageUpload,
    },
    data() {
        return {
            errors: [],
            dropzone: null,
        };
    },
    mounted() {
        this.dropzone=new Dropzone(this.$refs.dropzoneDiv, { url: route("petition.uploadBanner"),headers:{
          "X-CSRF-TOKEN":this._token
        } });
    },
    inject: ["decStep","_token"],
    methods: {
        checkErrors() {
            return true;
        },
        incStep() {
            if (this.checkErrors()) {
                this.$emit("incStepOk");
            }
        },
    },
};
</script>
