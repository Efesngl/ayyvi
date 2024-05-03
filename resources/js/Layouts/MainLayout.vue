
<template>
    <Navbar></Navbar>
    <slot/>
    <Footer></Footer>
</template>

<script>
    import Navbar from '../Components/Shared/Navbar.vue';
    import Footer from '../Components/Shared/Footer.vue';
    export default {
        components:{
            Navbar,
            Footer
        }
    }
</script>