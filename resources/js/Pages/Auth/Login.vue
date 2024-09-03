<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import FormDefault from "@/Components/FormDefault.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

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
    <GuestLayout>
        <Head title="Авторизация"/>
        <FormDefault form-type="login">
            <template v-slot:header>Авторизация</template>
            <template v-slot:description>Добро пожаловать</template>
            <form @submit.prevent="submit" class="space-y-4">
                <InputLabel for="email" value="Email"/>
                <div class="relative">
                    <TextInput type="email"
                               placeholder="Email"
                               v-model="form.email"
                               id="email"/>
                    <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>
                <InputLabel for="password" value="Email"/>
                <div class="relative">
                    <TextInput type="password"
                               placeholder="Пароль"
                               v-model="form.password"
                               id="password"/>
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>
                <PrimaryButton :disabled="form.processing">
                    Авторизоваться
                </PrimaryButton>
            </form>
        </FormDefault>
    </GuestLayout>
</template>
