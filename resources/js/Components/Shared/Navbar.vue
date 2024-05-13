<template>
    <!-- navbar -->
    <nav class="d-none d-md-block">
        <div id="navbar">
            <div id="site-links">
                <a href="/"><img src="/assets/img/logo/png/lb.png" id="logo" alt="" /></a>
                <ul>
                    <li>
                        <Link class="nav-links" :class="{'active-navbar':route().current()=='home'}" href="/"> Ana Sayfa</Link>
                    </li>
                    <li>
                        <Link class="nav-links" :href="route('petition.create')" :class="{'active-navbar':route().current()=='petition.create'}"> Kampanya başlat</Link>
                    </li>
                    <li><Link class="nav-links" :href="route('petition.index')" :class="{'active-navbar':route().current()=='petition.index'}"> Göz at</Link></li>
                    <li><Link class="nav-links" :href="route('donate')" :class="{'active-navbar':route().current()=='donate'}"> Bağışçı ol</Link></li>
                </ul>
            </div>
            <div id="user-links" v-if="user==null">
                <div class="dropdown">
                    <i class="bi bi-person-circle" id="user-logo" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu">
                        <li><Link class="dropdown-item" :href="route('login')">Giriş yap</Link></li>
                        <li><Link class="dropdown-item" :href="route('register')">Üye ol</Link></li>
                    </ul>
                </div>
            </div>
            <div id="user-links" v-else>
                <div class="dropdown">
                    <i class="bi bi-person-circle" id="user-logo" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu">
                        <li><Link class="dropdown-item" :href="route('profile.show')">Hesabım</Link></li>
                        <li><Link class="dropdown-item" :href="route('logout')">Çıkış Yap</Link></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- offcanvas navbar -->
    <!-- <nav class="d-block d-md-none">
        <div id="navbar">
            <div id="site-links">
                <Link href="/"><img src="/assets/img/logo/png/lb.png" id="logo" alt="" /></Link>
            </div>
            <div class="user-links d-flex align-items-center">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasmenu" aria-controls="offcanvasmenu">
                    <i class="bi bi-list fs-1"></i>
                </button>
                <div
                    ref="offCanvas"
                    class="offcanvas offcanvas-start bg-danger text-white"
                    tabindex="-1"
                    id="offcanvasmenu"
                    aria-labelledby="offcanvasmenu"
                >
                    <div class="offcanvas-header">
                        <h2 class="offcanvas-title" id="offcanvasExampleLabel">Menü</h2>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr />
                    <div class="offcanvas-body d-flex flex-column justify-content-between">
                        <div id="site-links-offcanvas" class="d-flex flex-column">
                            <a href="/" class="navbar-offcanvas-links text-decoration-none fs-1" active-class="active-navbar-offcanvas">Ana Sayfa</a>
                            <a href="/kampanyabaslat" class="navbar-offcanvas-links text-decoration-none fs-1" active-class="active-navbar-offcanvas">Kampanya başlat</a>
                            <a href="/gozat" class="navbar-offcanvas-links text-decoration-none fs-1" active-class="active-navbar-offcanvas">Kampanyalara göz at</a>
                            <a href="/bagis" class="navbar-offcanvas-links text-decoration-none fs-1" active-class="active-navbar-offcanvas">Bağış</a>
                        </div>
                        <div id="user-links-offcavnas">
                            <div class="row fs-1" v-if="user==null">
                                <div class="col-5"><a :href="route('login')" class="text-decoration-none text-white">Giriş yap</a></div>
                                <div class="col-2 text-center"><span>/</span></div>
                                <div class="col-5 text-end">
                                    <a :href="route('register')" class="text-decoration-none text-white">Kayıt ol</a>
                                </div>
                            </div>

                            <div class="row fs-1" v-else>
                                <div class="col-8">
                                    <a href="/hesabim/hesapdetaylari" class="text-decoration-none text-white"
                                        ><i class="bi bi-person-circle"></i
                                        ><span> {{ user.name }}</span></a
                                    >
                                </div>
                                <div class="col-4 text-end">
                                    <a class="btn btn-outline-danger text-white border" :href="route('logout')">Çıkış yap</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> -->
    <!-- offcanvas navbar end -->
</template>

<script>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
export default {
    components:{
        Link,
    },
    computed:{
        user(){
            return this.page.props.user
        }
    },
    data(){
        return {
            page: usePage()
        }
    }
    // props:{
    //     user:Object
    // }
};
</script>

<style>
.active-navbar {
    color: var(--dark-red) !important;
}
.active-navbar-offcanvas{
  color: var(--bs-dark) !important;
}
.navbar-offcanvas-links{
  color: var(--bs-white);
}
#navbar {
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    padding: 0.5rem 0.5rem;
    display: flex;
    justify-content: space-between;
    width: 100%;
    height: 100%;
}
#site-links {
    width: 80%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}
#site-links ul {
    display: flex;
    align-items: center;
    margin: 0;
    list-style-type: none;
}
#site-links ul li {
    font-size: 1.3rem;
    padding-left: 2rem;
    display: inline-block;
}
.nav-links {
    color: black;
    text-decoration: none;
    transition: 0.2s;
}
.nav-links:hover {
    color: var(--dark-red);
}
#logo {
    width: 100px;
    height: 60px;
    object-fit: contain;
}
#user-links {
    width: 20%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
#user-logo {
    font-size: 1.5rem;
    transition: 0.2s;
}
.dropdown-item {
    --bs-dropdown-link-hover-bg: var(--bs-red);
    --bs-dropdown-link-hover-color: var(--bs-white);
    --bs-dropdown-link-active-bg: var(--bs-red);
}
</style>
