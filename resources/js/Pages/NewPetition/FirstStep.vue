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
    <div class="row" v-if="errors.petitionNotSelected">
      <div class="col-12">
        <span class="text-danger">Lütfen bir kampanya türü seçiniz !</span>
      </div>
    </div>
    <div class="row gap-2 gap-md-0 mt-3">
      <div class="col-md-4 col-12" v-for="pt in petitionTypes">
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
    <div class="row mt-3" v-if="petitionInfo.petition.petitionType == 1">
      <div class="col-12">
        <label for="location"><small>Kampanyanın etkileyeceği yer</small></label>
        <div class="row" v-if="errors.petitionLocationNotSelected">
          <div class="col-12">
            <span class="text-danger"> Lütfen kampanyayın etkileyeceği alanı giriniz ! </span>
          </div>
        </div>
        <input type="text" class="form-control" name="location" v-model="petitionInfo.petition.petitionLocation" id="petitionLocation" />
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
  data() {
    return {
      petitionTypes: [
        {
          typeID: 1,
          type: "Yerel",
          icon: '<i class="bi bi-house-heart-fill"></i>',
          selected: false,
        },
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
        petitionNotSelected: false,
        petitionLocationNotSelected: false,
      },
    };
  },
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