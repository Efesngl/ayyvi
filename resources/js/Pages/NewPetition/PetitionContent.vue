<template>
  <div class="mt-5 container w-75 h-100 d-flex flex-column justify-content-between" id="start-petition-form">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="fs-1">Kampanyanın içeriğinden bahsedin</h2>
      </div>
    </div>
    <div class="row" v-if="ispetitionContentEmpty">
      <div class="col-12">
        <span class="text-danger">{{ errors[0] }}</span>
      </div>
    </div>
    <div class="row flex-fill mb-5">
      <div class="col-12 h-100">
        <ckeditor :editor="editor" v-model="petition.petitionContent" :config="editorConfig"></ckeditor>
      </div>
    </div>
    <div class="row mt-3 justify-content-betwee mb-5">
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
import '@ckeditor/ckeditor5-build-classic/build/translations/tr.js';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue"
export default {
  inject: ["decStep","petition"],
  components: {
    ckeditor:CKEditor.component
  },
  data() {
    return {
      errors: [],
      editor:ClassicEditor,
      editorConfig:{
        toolbar:{
          items:[
          'undo', 'redo',
          '|', 'heading',
          '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
          '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
          ]
        },
        language:"tr"
      }
    };
  },
  methods: {
    ispetitionContentEmpty() {
      return false;
    },
    incStep() {
      if (!this.ispetitionContentEmpty()) {
        this.$emit("incStepOk");
      }
    },
  },
};
</script>

<style>
  .ck-editor__editable{
    height: 15rem;
  }
</style>