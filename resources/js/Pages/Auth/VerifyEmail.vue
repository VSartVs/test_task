<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import FormDefault from "@/Components/FormDefault.vue";

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />
        <FormDefault form-type="verify" :has-auth-buttons="false">
            <template v-slot:header>Спасибо, что зарегистрировались!</template>

            <div class="mb-4 text-sm text-gray-600">
                Прежде чем приступить к работе, не могли бы вы подтвердить свой адрес электронной почты, перейдя по ссылке, которую мы только что отправили вам по электронной почте?
                Если вы не получили это письмо, мы с радостью отправим вам другое.
            </div>

            <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
                На адрес электронной почты, который вы указали при регистрации, была отправлена новая ссылка для подтверждения.
            </div>

            <form @submit.prevent="submit">
                <div class="mt-4 flex items-center justify-between">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Отправить письмо еще раз
                    </PrimaryButton>
                </div>
            </form>
        </FormDefault>
    </GuestLayout>
</template>
