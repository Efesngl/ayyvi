<template>
    <MainLayout>
        <FormLayout>
            <template v-slot:formContent v-if="formStep == 1">
                <FirstStep @incStepOk="incStep"></FirstStep>
            </template>
            <template v-slot:formContent v-if="formStep == 2">
                <SecondStep @incStepOk="incStep"></SecondStep>
            </template>
            <template v-slot:formContent v-if="formStep == 3">
                <ThirdStep @incStepOk="incStep"></ThirdStep>
            </template>
            <template v-slot:formContent v-if="formStep == 4">
                <FourthStep @incStepOk="incStep"></FourthStep>
            </template>
            <template v-slot:formContent v-if="formStep == 5">
                <FifthStep @incStepOk="incStep"></FifthStep>
            </template>
            <template v-slot:formContent v-if="formStep == 6">
                <SixthStep @incStepOk="incStep"></SixthStep>
            </template>
            <template v-slot:formContent v-if="formStep == 7">
                <SeventhStep></SeventhStep>
            </template>
        </FormLayout>
    </MainLayout>
</template>

<script>
import FormLayout from "./FormLayout.vue";
import * as Steps from "./FormStepImports.js";
import { computed } from "vue";
import MainLayout from "../../Layouts/MainLayout.vue";
export default {
    components: {
        FormLayout,
        FirstStep: Steps.FirstStep,
        SecondStep: Steps.SecondStep,
        ThirdStep: Steps.ThirdStep,
        FourthStep: Steps.FourthStep,
        FifthStep: Steps.FifthStep,
        SixthStep: Steps.SixthStep,
        SeventhStep: Steps.SeventhStep,
        MainLayout,
    },
    data() {
        return {
            formStep: 1,
        };
    },
    computed: {
        formProgress() {
            return (this.formStep / 6) * 100;
        },
    },
    methods: {
        incStep() {
            if (this.formStep < 10) this.formStep++;
        },
        decStep() {
            if (this.formStep > 1) this.formStep--;
        },
    },
    provide() {
        return {
            decStep: this.decStep,
            formProgress: computed(() => this.formProgress),
        };
    },
};
</script>
<style>
#start-petition-form {
    /* border: 1px solid black;
  border-radius: 1rem;
  height: max-content; */
    padding: 2rem;
}
.petition-type {
    width: 100%;
    height: 100%;
    border: 1px solid black;
    padding: 1rem;
    border-radius: 1rem;
    transition: 0.2s;
}
.petition-type:hover {
    background-color: rgba(0, 0, 0, 0.1);
    transform: scale(1.1);
}
.selected-petition-type {
    border-color: var(--dark-red);
    color: var(--dark-red) !important;
}
.v-enter-active,
.v-leave-active {
    transition: 0.5s;
}
.v-enter-from,
.v-leave-to {
    opacity: 0;
}
.v-enter-to,
.v-leave-from {
    transform: translateX(100%);
    opacity: 1;
}
</style>
