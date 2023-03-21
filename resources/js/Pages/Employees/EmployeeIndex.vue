<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head,useForm} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import NavLink from "@/Components/NavLink.vue";

const form = useForm({})
const props = defineProps(
    {
        employees: Object,
        employeesQty: Number,
        title: String
    }
)

function destroy(id) {
    if (confirm("Are you sure you want to delete")) {
        form.delete(route("employees.destroy", id),{
            preserveScroll: true
        });
    }
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $page.props.auth.user.isAdmin ? 'Admin' : '' }} Dashboard</h2>
        </template>

        <div class="flex items-center">
            <div class="w-full">
                <h2 class="text-center text-[#12375c] font-bold text-2xl uppercase mb-5 mt-10">
                    {{ title }}
                </h2>
                <div class="text-center mb-5">
                    <NavLink :href="route('employees.create')" :active="true">
                        Create Employee
                    </NavLink>
                </div>

                <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-3/4">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    First Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Last Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Edit
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-if="props.employeesQty == 0">
                                    <td colspan="5" class="text-center m-2 font-bold">No results</td>
                                </tr>
                                <tr
                                    v-for="employee in employees.data"
                                    :key="employee.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ employee.id }}
                                    </th>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ employee.first_name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ employee.last_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a :href="route('employees.edit',employee.id)" class="px-4 py-2 text-white bg-blue-600 rounded-lg">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <PrimaryButton
                                            class="bg-red-700"
                                            @click="destroy(employee.id)"
                                        >
                                            Delete
                                        </PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :data="employees" class="mb-5"/>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
