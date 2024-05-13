<template>
  <MainLayout>
        <!-- donate -->
        <div class="container-fluid p-5 h-auto" id="donate">
      <!-- <FirstStep v-if="formStep==1" @incStepOk="incStep"></FirstStep> -->
      <SecondStep></SecondStep>
    </div>
  </MainLayout>
</template>

<script>
import FirstStep from "./FirstStep.vue";
import SecondStep from "./SecondStep.vue";
import { computed } from "vue";
import MainLayout from "../../Layouts/MainLayout.vue";
export default {
    components: {
        MainLayout,
        FirstStep,
        SecondStep
    },
    provide(){
      return {
        formStep:computed(()=>this.formStep),
        donationInfo:computed(()=>this.donationInfo),
        decStep:this.decStep
      }
    },
    data() {
        return {
            donationInfo:{
              user:{
                firstname:"",
                lastname:"",
                email:"",
                phone:""
              },
              card:{
                cardHolder:"",
                cardNumber:"",
                cardExp:{
                  m:0,
                  y:0
                },
                cardCvv:""
              },
              amount:0
            },
            formStep: 1,
        };
    },
    methods: {
        incStep() {
            this.formStep++;
        },
        decStep(){
          this.formStep--
        }
    },
};
</script>

<style>
#donate {
    width: 100vw;
    height: 100vh;
}
@media (min-width: 768px) {
    #donate {
        background-image: url("/assets/img/donate.webp");
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
}
#donate-form {
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 10px;
}
</style>
