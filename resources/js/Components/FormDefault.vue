<script setup>
import {Link} from '@inertiajs/vue3'

const props = defineProps({
    formType: {
        type: String,
        required: true
    },
    hasAuthButtons: {
        type: Boolean,
        default: true
    }
})

</script>

<template>
    <div class="w-auto">
        <div
            class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300">
            <div class="text-center py-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                <h1 class="text-3xl font-bold">
                    <slot name="header"/>
                </h1>
                <p class="mt-2">
                    <slot name="description"/>
                </p>
            </div>
            <div class="p-8">
                <div class="flex justify-center mb-6" v-if="hasAuthButtons">
                    <template v-if="!$page.props.auth.user">
                        <Link
                            :class="{ 'bg-blue-500 text-white': formType === 'register', 'bg-gray-200 text-gray-700': formType !== 'register' }"
                            class="px-4 py-2 rounded-l-md focus:outline-none transition-colors duration-300"
                            :href="route('register')">
                            Регистрация
                        </Link>
                        <Link
                            :class="{ 'bg-blue-500 text-white': formType === 'login', 'bg-gray-200 text-gray-700': formType !== 'login' }"
                            class="px-4 py-2 rounded-r-md focus:outline-none transition-colors duration-300"
                            :href="route('login')">
                            Авторизация
                        </Link>
                    </template>
                    <Link v-else
                        :class="{ 'bg-blue-500 text-white': formType === 'login', 'bg-gray-200 text-gray-700': formType !== 'login' }"
                        class="px-4 py-2 rounded focus:outline-none transition-colors duration-300"
                        :href="route('dashboard')">
                        Профиль
                    </Link>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
