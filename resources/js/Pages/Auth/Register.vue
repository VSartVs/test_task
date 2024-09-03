<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import FormDefault from "@/Components/FormDefault.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Регистрация" />
       <FormDefault form-type="register">
           <template v-slot:header>Регистрация</template>
           <template v-slot:description>Добро пожаловать</template>
           <form @submit.prevent="submit" class="space-y-4">
               <InputLabel for="name" value="Имя"/>
               <div class="relative">
                   <TextInput type="text"
                              placeholder="Имя"
                              v-model="form.name"
                              id="name"
                   />
                   <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                   <InputError class="mt-2" :message="form.errors.name"/>
               </div>
               <InputLabel for="email" value="Email"/>
               <div class="relative">
                   <TextInput type="email"
                              placeholder="Email"
                              v-model="form.email"
                              id="email"
                   />
                   <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                   <InputError class="mt-2" :message="form.errors.email"/>
               </div>
               <InputLabel for="password" value="Пароль"/>
               <div class="relative">
                   <TextInput type="password"
                              placeholder="Пароль"
                              v-model="form.password"
                              id="password"
                   />
                   <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                   <InputError class="mt-2" :message="form.errors.password"/>
               </div>
               <InputLabel for="confirm_password" value="Подтверждение пароля"/>
               <div class="relative">
                   <TextInput type="password"
                              placeholder="Подтверждение пароля"
                              v-model="form.password_confirmation"
                              id="confirm_password"
                   />
                   <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                   <InputError class="mt-2" :message="form.errors.password_confirmation"/>
               </div>
               <PrimaryButton type="submit" :disabled="form.processing">
                   Зарегистрироваться
               </PrimaryButton>
           </form>
       </FormDefault>
    </GuestLayout>
</template>
