<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue'
import FormDefault from '@/Components/FormDefault.vue'
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {vMaska} from "maska";

const form = useForm({
    firstName: '',
    lastName: '',
    phone: '',
    email: '',
    message: '',
});

const submit = () => {
    form.post(route('lead.store'), {
        onSuccess: () => form.reset(),
    });
};

const clearError = (field) => {
    form.clearErrors(field)
}
</script>

<template>
    <Head title="Главная страница"/>
    <GuestLayout>
        <FormDefault form-type="lead">
            <template v-slot:header>Подача заявки</template>
            <template v-slot:description>Заполните форму, чтобы мы могли связаться с вами</template>
            <form @submit.prevent="submit" class="space-y-4">
                <InputLabel for="firstName" value="Имя"/>
                <div class="relative">
                    <TextInput type="text"
                               placeholder="Имя"
                               v-model="form.firstName"
                               id="firstName"
                               @input="clearError('firstName')"
                    />
                    <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    <InputError class="mt-2" :message="form.errors.firstName"/>
                </div>
                <InputLabel for="lastName" value="Фамилия"/>
                <div class="relative">
                    <TextInput type="text"
                               placeholder="Фамилия"
                               v-model="form.lastName"
                               id="lastName"
                               @input="clearError('lastName')"
                    />
                    <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    <InputError class="mt-2" :message="form.errors.lastName"/>
                </div>
                <InputLabel for="phone" value="Телефон"/>
                <div class="relative">
                    <TextInput type="text"
                               placeholder="Телефон"
                               v-model="form.phone"
                               v-maska data-maska="+7 (###) ###-##-##"
                               id="phone"
                               @input="clearError('phone')"
                    />
                    <i class="fas fa-phone absolute left-3 top-3 text-gray-400"></i>
                    <InputError class="mt-2" :message="form.errors.phone"/>
                </div>
                <InputLabel for="email" value="Email"/>
                <div class="relative">
                    <TextInput type="email"
                               placeholder="Email"
                               v-model="form.email"
                               id="email"
                               @input="clearError('email')"
                    />
                    <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>
                <InputLabel for="message" value="Текст обращения"/>
                <div class="relative">
                   <textarea id="message" v-model="form.message" placeholder="Текст обращения"
                             class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                             @input="clearError('message')"
                   />
                    <InputError class="mt-2" :message="form.errors.message"/>
                </div>
                <PrimaryButton type="submit" :disabled="form.processing">
                    Отправить
                </PrimaryButton>
            </form>
        </FormDefault>
        <flash-message
            v-if="form.recentlySuccessful"
            message="Ваша заявка принята в обработку!"
            type="success"
        />
    </GuestLayout>

</template>
