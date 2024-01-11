<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Admin Panel</a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a
                            class="nav-link cursor-pointer"
                            @click="redirectToClients"
                            >Clients</a
                        >
                    </li>
                    <li class="nav-item cursor-pointer">
                        <a class="nav-link" @click="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
    methods: {
        logout() {
            router.get("/logout");
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        },
        redirectToClients() {
            router.get("/clients");
        },
    },
};
</script>

<style scoped>
.cursor-pointer {
    cursor: pointer;
}
</style>
