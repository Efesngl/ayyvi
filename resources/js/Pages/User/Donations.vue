<template>
    <UserPage>
        <div class="container h-auto min-vh-100">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>Bağış tutarı</td>
                        <td class="text-end">Bağışın yapıldığı zaman</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="d in donations">
                        <td>{{ d.amount }} TL</td>
                        <td class="text-end">{{ d.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </UserPage>
</template>

<script>
import UserPage from "../../Layouts/UserPage.vue";
export default {
    props: {
        donations: Object,
    },
    components: {
        UserPage,
    },
};
</script>
