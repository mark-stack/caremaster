<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head,useForm} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import NavLink from "@/Components/NavLink.vue";

const form = useForm({})
const props = defineProps(
    {
        companies: Object,
        title: String
    }
)

function destroy(id) {
    if (confirm("Are you sure you want to delete")) {
        form.delete(route("companies.destroy", id),{
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
                    <NavLink :href="route('companies.create')" :active="true">
                        Create Company
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
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Website
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
                                <tr
                                    v-for="company in companies.data"
                                    :key="company.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ company.id }}
                                    </th>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ company.name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ company.website }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a :href="route('companies.edit',company.id)" class="px-4 py-2 text-white bg-blue-600 rounded-lg">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <PrimaryButton
                                            class="bg-red-700"
                                            @click="destroy(company.id)"
                                        >
                                            Delete
                                        </PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :data="companies" class="mb-5"/>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
