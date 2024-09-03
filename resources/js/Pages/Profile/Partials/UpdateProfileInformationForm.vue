<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Информация профиля</h2>
        </header>

        <InputLabel>{{'Имя: '+user.name}}</InputLabel>
        <InputLabel>{{'Почта: '+user.email}}</InputLabel>

        <div v-if="mustVerifyEmail && user.email_verified_at === null">
            <p class="text-sm mt-2 text-gray-800">
                Ваш адрес электронной почты не подтвержден.
                <Link
                    :href="route('verification.send')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Нажмите здесь, чтобы повторно отправить электронное письмо с подтверждением.
                </Link>
            </p>

            <div
                v-show="status === 'verification-link-sent'"
                class="mt-2 font-medium text-sm text-green-600"
            >
                На адрес электронной почты, который вы указали при регистрации, была отправлена новая ссылка для подтверждения.
            </div>
        </div>

    </section>
</template>
