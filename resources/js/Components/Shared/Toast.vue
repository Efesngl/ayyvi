<template>
    <div ref="toast" class="toast align-items-center border-0 top-0 end-0 translate m-3 position-absolute" role="alert" :class="class" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ text }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            class:String,
            text:String
        }
    }
</script>
