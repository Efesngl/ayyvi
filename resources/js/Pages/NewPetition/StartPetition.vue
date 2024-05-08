<template>
    <MainLayout>
        <FormLayout>
            <template v-slot:formContent v-if="formStep == 1">
                <SelectPetitionType @incStepOk="incStep"></SelectPetitionType>
            </template>
            <template v-slot:formContent v-if="formStep == 2">
                <SelectPetitionTopic @incStepOk="incStep"></SelectPetitionTopic>
            </template>
            <template v-slot:formContent v-if="formStep == 3">
                <PetitionHeader @incStepOk="incStep"></PetitionHeader>
            </template>
            <template v-slot:formContent v-if="formStep == 4">
                <PetitionContent @incStepOk="incStep"></PetitionContent>
            </template>
            <template v-slot:formContent v-if="formStep == 5">
                <PetitionTargetSign @incStepOk="incStep"></PetitionTargetSign>
            </template>
            <template v-slot:formContent v-if="formStep == 6">
                <CreatePetition @incStepOk="incStep"></CreatePetition>
            </template>
        </FormLayout>
    </MainLayout>
</template>

<script>
import FormLayout from "./FormLayout.vue";
import * as Steps from "./FormStepImports.js";
import { computed } from "vue";
import MainLayout from "../../Layouts/MainLayout.vue";
import { router } from "@inertiajs/vue3";
export default {
    props: {
        petition: Object,
        topics: Object,
        _token:String
    },
    components: {
        FormLayout,
        SelectPetitionType:Steps.SelectPetitionType,
        SelectPetitionTopic:Steps.SelectPetitionTopic,
        PetitionHeader:Steps.PetitionHeader,
        PetitionContent:Steps.PetitionContent,
        PetitionTargetSign:Steps.PetitionTargetSign,
        CreatePetition:Steps.CreatePetition,
        MainLayout,
    },
    data() {
        return {
            formStep: 1,
            handleRouteLeave: null,
        };
    },
    mounted() {
            this.handeRouteLeave = router.on("before", (event) => {
                return (this.formStep==1)? true: confirm("Do you want to leave this page ? \n All changes will be lost !!!");
            });
    },
    beforeUnmount() {
        if(this.handeRouteLeave!=null){
            this.handeRouteLeave();
        }
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
            petition: computed(() => this.petition),
            routeLeave:computed(()=>this.handeRouteLeave),
            topics: this.topics,
            _token:this._token
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
