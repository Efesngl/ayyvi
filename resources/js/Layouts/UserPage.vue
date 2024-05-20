<template>
    <MainLayout>
        <div class="container-fluid h-auto">
            <div class="row" id="sections">
                <div class="col-12">
                    <ul class="nav nav-tabs justify-content-center">
                        <li class="nav-item">
                            <Link :href="route('profile.show')" :class="{ active: route().current() == 'profile.show' }" class="nav-link browse-link">
                                Hesap detayları
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('user.petitions')" :class="{ active: route().current() == 'user.petitions' }" class="nav-link browse-link"> Başlattığım kampanyalar </Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('user.signedpetitions')" class="nav-link browse-link" :class="{ active: route().current() == 'user.signedpetitions' }"> Katıldığım kampanyalar </Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('user.donations')" :class="{ active: route().current() == 'user.donations' }" class="nav-link browse-link"> Yaptığım bağışlar </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container-fluid flex-column d-flex justify-content-center align-items-center pt-5 h-auto" id="user-page-content-container">
                <slot/>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "./MainLayout.vue";
import { Link } from "@inertiajs/vue3";
export default {
    components: {
        MainLayout,
        Link,
    },
};
</script>
