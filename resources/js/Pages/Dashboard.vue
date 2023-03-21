<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $page.props.auth.user.isAdmin ? 'Admin' : '' }} Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div v-if="$page.props.auth.user.isAdmin" class="p-6 bg-[#12375c] text-gray-200 dark:text-gray-100">
                        <table>
                            <tr>
                                <td>
                                    <span class="text-lg font-bold mr-2">Companies:</span>
                                </td>
                                <td>
                                    <NavLink :href="route('companies.index')" :active="true">
                                        View All
                                    </NavLink> |
                                    <NavLink :href="route('companies.create')" :active="true">
                                        Create
                                    </NavLink>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-lg font-bold mr-2">Employees:</span>
                                </td>
                                <td>
                                    <NavLink :href="route('employees.index')" :active="true">
                                        View All
                                    </NavLink> |
                                    <NavLink :href="route('employees.create')" :active="true">
                                        Create
                                    </NavLink>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div v-else class="p-6 text-gray-900 dark:text-gray-100">
                        User things
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
