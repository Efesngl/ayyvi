<template>
  <div class="container w-75" id="start-petition-form">
    <div class="row">
      <div class="col-12">
        <h2 class="fs-1">Lütfen kampanyanıza en uygun konu başlığını seçiniz</h2>
      </div>
    </div>
    <div class="row" v-if="errors.petitionTypeNotSelected">
      <div class="col-12">
        <span class="text-danger">Lütfen bir konu başlığı seçiniz</span>
      </div>
    </div>
    <div class="row mt-3 g-1 justify-content-between">
      <div class="col" v-for="(t, index) in topics">
        <input @click="setTopic(t.id)" type="radio" class="btn-check" name="topics" :id="'topic' + index" autocomplete="off" :checked="petition.petitionTopic==t.id" />
        <label class="btn btn-outline-danger w-100 h-100" :for="'topic' + index">{{ t.topic }}</label>
      </div>
    </div>
    <div class="row mt-3 justify-content-between">
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
export default {
  inject: ["decStep","topics","petition"],
  data(){
    return{
      errors:{
        petitionTypeNotSelected:null
      }
    }
  },
  methods:{
    setTopic(t){
      this.petition.petitionTopic=t
    },
    checkErrors(){
      this.errors.petitionTypeNotSelected=false
      if(this.petition.petitionTopic==0){
        this.errors.petitionTypeNotSelected=true
        return false
      }
      return true
    },  
    incStep(){
      if(this.checkErrors()){
        this.$emit("incStepOk")
      }
    },
  }
};
</script>