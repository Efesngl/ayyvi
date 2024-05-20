<template>
    <MainLayout>
        <div class="container-fluid h-auto min-vh-100">
        <div class="row" >
            <div class="col-12 d-flex justify-content-start align-items-center flex-column">
                <img v-if="$page.props.status == 'success'" src="/assets/img/svg/undraw_super_thank_you_re_f8bo.svg" class="w-50 h-50" alt="" />
                <img v-else src="/assets/img/svg/undraw_feeling_blue_-4-b7q.svg" class="w-50 h-50" alt="" />
                <h3 v-if="$page.props.status == 'success'">Bağışın için çok teşekkür ederiz projemiz sizin sayenizde devam ediyor. <i class="bi bi-hearts text-danger"></i></h3>
                <h3 v-else>Maalesef bağış işlemin başarısız oldu. Ama daha sonra tekrardan deneyebilirsin <i class="bi bi-hearts text-danger"></i>.</h3>
                <Link :href="route('home')" class="btn btn-danger">Ana sayfaya geri dön</Link>
            </div>
        </div>
    </div>
    </MainLayout>
</template>
<script>
import { Link } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
export default {
    components: {
        Link,
        MainLayout
    },
};
</script>
