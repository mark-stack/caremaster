<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

const props = defineProps(
    {
        employee: Object,
        companies: Object,
        title: String,
    }
)

const form = useForm({
    id: props.employee.id,
    first_name: props.employee.first_name,
    last_name: props.employee.last_name,
    company_id: props.employee.company_id,
    email: props.employee.email,
    phone: props.employee.phone,
});

function submit(){
    router.post(route('employees.update',form.id), {
        _method: 'put',
        id: form.id,
        first_name: form.first_name,
        last_name: form.last_name,
        company_id: form.company_id,
        email: form.email,
        phone: form.phone,
    })
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
                <h2 class="text-center text-[#12375c] font-bold text-2xl uppercase mb-10 mt-10">
                    {{ title }}
                </h2>
                <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="first_name" value="First Name *" />
                            <TextInput
                                id="first_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.first_name"
                                placeholder="e.g Mark"
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="last_name" value="Last Name *" />
                            <TextInput
                                id="last_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.last_name"
                                placeholder="e.g Evans"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="company_id" value="Company *" />
                            <select
                                name="company_id"
                                id="company_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                v-model="form.company_id"
                                required
                            >
                                <option v-for="company in companies"
                                        :value="company.id"
                                        :selected="company.id == form.company_id"
                                >
                                    {{company.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                placeholder="e.g mark.laravel.coder@gmail.com"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="phone" value="Phone" />
                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                placeholder="e.g 0426 290 533"
                            />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
