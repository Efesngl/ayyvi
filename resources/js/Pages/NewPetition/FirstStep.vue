<template>
  <div class="container-fluid w-75" id="start-petition-form">
    <div class="row">
      <div class="col-12">
        <h2 class="fs-1">Değişim için birlikte adım atalım</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <small class="fs-5">Bir kampanya türü seçin</small>
      </div>
    </div>
    <div class="row" v-if="errors.petitionTypeNotSelected">
      <div class="col-12">
        <span class="text-danger">Lütfen bir kampanya türü seçiniz !</span>
      </div>
    </div>
    <div class="row gap-2 gap-md-0 mt-3">
      <div class="col-md-6 col-12" v-for="pt in petitionTypes">
        <div class="petition-type text-center" :class="{ 'selected-petition-type': pt.selected }" @click="selectpetitionType(pt)">
          <div class="row">
            <div class="col-12">
              <span v-html="pt.icon"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <span>{{ pt.type }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3 justify-content-center">
      <div class="col-6 text-center">
        <button class="btn btn-danger" @click="incStep">Sonraki adım</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  inject:["petition"],
  data() {
    return {
      petitionTypes: [
        {
          typeID: 2,
          type: "Ulusal",
          icon: '<i class="bi bi-flag-fill"></i>',
          selected: false,
        },
        {
          typeID: 3,
          type: "Global",
          icon: '<i class="bi bi-globe"></i>',
          selected: false,
        },
      ],
      errors: {
        petitionTypeNotSelected: false,
      },
    };
  },
  methods: {
    checkErrors() {
      this.errors.petitionTypeNotSelected=false
      if(this.petition.petitionType==0){
        this.errors.petitionTypeNotSelected=true
        return false
      }
      return true;
    },
    selectpetitionType(pt){
      for (const pt of this.petitionTypes) {
        pt.selected=false
      }
      this.petition.petitionType=pt.typeID
      pt.selected=true
    },  
    incStep() {
      if (this.checkErrors()) {
        this.$emit("incStepOk");
      }
    },
  },
};
</script>