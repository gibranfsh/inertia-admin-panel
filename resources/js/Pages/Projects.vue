<template>
    <Navbar />

    <div class="mt-3">
        <h1>Projects for : {{ client.name }}</h1>

        <!-- Edit Project Form -->
        <form v-if="showEditForm" @submit.prevent="saveEditedProject">
            <div class="mb-3">
                <label for="editTitle" class="form-label">Title</label>
                <input
                    v-model="editedProject.title"
                    type="text"
                    class="form-control"
                    id="editTitle"
                    placeholder="Enter title"
                />
            </div>
            <div class="mb-3">
                <label for="editDescription" class="form-label"
                    >Description</label
                >
                <input
                    v-model="editedProject.description"
                    type="text"
                    class="form-control"
                    id="editDescription"
                    placeholder="Enter description"
                />
            </div>
            <div class="mb-3">
                <label for="editPlatform" class="form-label">Platform</label>
                <select
                    v-model="editedProject.platform"
                    class="form-select"
                    id="editPlatform"
                >
                    <option value="Website">Website</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Desktop">Desktop</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="editStartDate" class="form-label">Start Date</label>
                <input
                    v-model="formattedStartDate"
                    type="date"
                    class="form-control"
                    id="editStartDate"
                    placeholder="Enter start date"
                />
            </div>
            <div class="mb-3">
                <label for="editEndDate" class="form-label">End Date</label>
                <input
                    v-model="formattedEndDate"
                    type="date"
                    class="form-control"
                    id="editEndDate"
                    placeholder="Enter end date"
                />
            </div>
            <div class="mb-3">
                <label for="editStatus" class="form-label">Status</label>
                <select
                    v-model="editedProject.status"
                    class="form-select"
                    id="editStatus"
                >
                    <option value="ON_PROGRESS">ON PROGRESS</option>
                    <option value="FINISHED">FINISHED</option>
                    <option value="ON_HOLD">ON HOLD</option>
                    <option value="CANCELLED">CANCELLED</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Project ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Platform</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects" :key="project.id">
                    <th scope="row">{{ project.id }}</th>
                    <td>{{ project.title }}</td>
                    <td>{{ project.description }}</td>
                    <td>{{ project.platform }}</td>
                    <td>{{ formatDate(project.start_date) }}</td>
                    <td>{{ formatDate(project.end_date) }}</td>
                    <td>{{ project.status }}</td>
                    <td class="d-flex gap-1">
                        <button
                            @click="handleEdit(project)"
                            class="btn btn-primary"
                        >
                            Edit
                        </button>
                        <button
                            @click="handleDelete(project)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- New Project Form -->
        <div class="mt-3">
            <button @click="showNewProjectForm" class="btn btn-primary">
                Add New Project
            </button>
            <div v-if="showForm" class="mt-3">
                <form @submit.prevent="addNewProject">
                    <div class="mb-3">
                        <label for="newTitle" class="form-label">Title</label>
                        <input
                            v-model="newProject.title"
                            type="text"
                            class="form-control"
                            id="newTitle"
                            placeholder="Enter title"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="newDescription" class="form-label"
                            >Description</label
                        >
                        <input
                            v-model="newProject.description"
                            type="text"
                            class="form-control"
                            id="newDescription"
                            placeholder="Enter description"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="newPlatform" class="form-label"
                            >Platform</label
                        >
                        <select
                            v-model="newProject.platform"
                            class="form-select"
                            id="newPlatform"
                        >
                            <option value="Website">Website</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Desktop">Desktop</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="newStartDate" class="form-label"
                            >Start Date</label
                        >
                        <input
                            v-model="newProject.start_date"
                            type="date"
                            class="form-control"
                            id="newStartDate"
                            placeholder="Enter start date"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="newEndDate" class="form-label"
                            >End Date</label
                        >
                        <input
                            v-model="newProject.end_date"
                            type="date"
                            class="form-control"
                            id="newEndDate"
                            placeholder="Enter end date"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="newStatus" class="form-label">Status</label>
                        <select
                            v-model="newProject.status"
                            class="form-select"
                            id="newStatus"
                        >
                            <option value="ON_PROGRESS">ON PROGRESS</option>
                            <option value="FINISHED">FINISHED</option>
                            <option value="ON_HOLD">ON HOLD</option>
                            <option value="CANCELLED">CANCELLED</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from "./Navbar.vue";
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";

const { client } = defineProps({
    client: Object,
    projects: Object,
});

const showForm = ref(false);
const newProject = ref({
    title: "",
    description: "",
    start_date: "",
    end_date: "",
});

const showEditForm = ref(false);
const editingProject = ref(null);
const editedProject = ref({
    id: null,
    title: "",
    description: "",
    platform: "",
    start_date: "",
    end_date: "",
    status: "",
});

const showNewProjectForm = () => {
    showForm.value = !showForm.value;
};

const addNewProject = () => {
    router.post(`/clients/${client.id}/projects`, newProject.value);
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};

const handleEdit = (project) => {
    showEditForm.value = !showEditForm.value;
    editingProject.value = project;
    editedProject.value = { ...project };
};

const saveEditedProject = () => {
    router.put(
        `/clients/${client.id}/projects/${editedProject.value.id}`,
        editedProject.value
    );
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};

const handleDelete = (project) => {
    router.delete(`/clients/${client.id}/projects/${project.id}`);
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};

const formattedStartDate = computed(() => {
    return formatDate(editedProject.value.start_date);
});

const formattedEndDate = computed(() => {
    return formatDate(editedProject.value.end_date);
});

// Function to format date to "yyyy-MM-dd"
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
};
</script>
