<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    logo: '',
    website: ''
});

const props = defineProps(
    {
        title: String
    }
)

const submit = () => {
    form.post(route("companies.store"));
};

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
                            <InputLabel for="name" value="Name *" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                placeholder="e.g ABC care"
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                placeholder="e.g mark@abccare.org"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="logo" value="Logo" />
                            <Input
                                id="logo"
                                type="file"
                                class="mt-1 block w-full"
                                @input="form.logo = $event.target.files[0]"
                                placeholder="Minimum 100x100px"
                            />
                            <InputError class="mt-2" :message="form.errors.logo" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="website" value="Website" />
                            <TextInput
                                id="website"
                                type="url"
                                class="mt-1 block w-full"
                                v-model="form.website"
                                placeholder="e.g https://abccare.org"
                            />
                            <InputError class="mt-2" :message="form.errors.website" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
