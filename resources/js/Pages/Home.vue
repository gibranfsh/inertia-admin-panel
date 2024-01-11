<template>
    <Navbar />

    <div class="mt-3">
        <h1>Welcome, {{ name }}!</h1>

        <p>
            This is the home page. Click the button below to view the clients.
        </p>

        <p>Your email: {{ email }}</p>

        <button @click="redirectToClientsPage" class="btn btn-primary">
            View Clients
        </button>
    </div>
</template>

<script setup>
import Navbar from "./Navbar.vue";
import { router } from "@inertiajs/vue3";

defineProps({
    name: String,
    email: String,
});

const redirectToClientsPage = () => {
    router.get("/clients");
};
</script>
