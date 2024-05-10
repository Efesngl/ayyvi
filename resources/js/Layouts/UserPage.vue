<template>
    <MainLayout>
        <div class="container-fluid h-auto">
            <div class="row" id="sections">
                <div class="col-12">
                    <ul class="nav nav-tabs justify-content-center">
                        <li class="nav-item">
                            <Link :href="route('profile.show')" :class="{ active: route().current() == 'profile.show' }" class="nav-link browse-link" active-class="active">
                                Hesap detayları
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('user.petitions')" :class="{ active: route().current() == 'user.petitions' }" class="nav-link browse-link" active-class="active"> Başlattığım kampanyalar </Link>
                        </li>
                        <li class="nav-item">
                            <Link href="/hesabim/katildigimkampanyalar" class="nav-link browse-link" active-class="active"> Katıldığım kampanyalar </Link>
                        </li>
                        <li class="nav-item">
                            <Link href="/hesabim/yaptigimbagislar" class="nav-link browse-link" active-class="active"> Yaptığım bağışlar </Link>
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
