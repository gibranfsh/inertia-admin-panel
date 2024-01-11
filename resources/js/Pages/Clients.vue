<template>
    <Navbar />

    <div class="mt-3">
        <h1>Clients Table</h1>

        <!-- Edit Client Form -->
        <form v-if="showEditForm" @submit.prevent="saveEditedClient">
            <div class="mb-3">
                <label for="editName" class="form-label">Name</label>
                <input
                    v-model="editedClient.name"
                    type="text"
                    class="form-control"
                    id="editName"
                    placeholder="Enter name"
                />
            </div>
            <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input
                    v-model="editedClient.email"
                    type="email"
                    class="form-control"
                    id="editEmail"
                    placeholder="Enter email"
                />
            </div>
            <div class="mb-3">
                <label for="editPhone" class="form-label">Phone</label>
                <input
                    v-model="editedClient.phone"
                    type="text"
                    class="form-control"
                    id="editPhone"
                    placeholder="Enter phone"
                />
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Client ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="client in clients"
                    :key="client.id"
                >
                    <th scope="row">{{ client.id }}</th>
                    <td>{{ client.name }}</td>
                    <td>{{ client.email }}</td>
                    <td>{{ client.phone }}</td>
                    <td>{{ client.created_at }}</td>
                    <td class="d-flex gap-1">
                        <button
                            @click="handleEdit(client)"
                            class="btn btn-primary"
                        >
                            Edit
                        </button>
                        <button
                            @click="handleDelete(client)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                        <button
                            @click="redirectToProjects(client.id)"
                            class="btn btn-success"
                        >
                            View Projects
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- New Client Form -->
        <div class="mt-3">
            <button @click="showNewClientForm" class="btn btn-primary">
                Add New Client
            </button>
            <div v-if="showForm" class="mt-3">
                <form @submit.prevent="addNewClient">
                    <div class="mb-3">
                        <label for="newName" class="form-label">Name</label>
                        <input
                            v-model="newClient.name"
                            type="text"
                            class="form-control"
                            id="newName"
                            placeholder="Enter name"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Email</label>
                        <input
                            v-model="newClient.email"
                            type="email"
                            class="form-control"
                            id="newEmail"
                            placeholder="Enter email"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="newPhone" class="form-label">Phone</label>
                        <input
                            v-model="newClient.phone"
                            type="text"
                            class="form-control"
                            id="newPhone"
                            placeholder="Enter phone"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from "./Navbar.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    clients: Object,
});

const showForm = ref(false);
const newClient = ref({
    name: "",
    email: "",
    phone: "",
});

const showEditForm = ref(false);
const editingClient = ref(null);
const editedClient = ref({
    id: null,
    name: "",
    email: "",
    phone: "",
});

const showNewClientForm = () => {
    showForm.value = !showForm.value;
};

const addNewClient = () => {
    router.post("/clients", newClient.value);
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};

const handleEdit = (client) => {
    showEditForm.value = !showEditForm.value;
    editingClient.value = client;
    editedClient.value = { ...client };
};

const saveEditedClient = () => {
    router.put(`/clients/${editedClient.value.id}`, editedClient.value);
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};

const handleDelete = (client) => {
    router.delete(`/clients/${client.id}`);
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};

const redirectToProjects = (id) => {
    router.get(`/clients/${id}/projects`);
};
</script>
