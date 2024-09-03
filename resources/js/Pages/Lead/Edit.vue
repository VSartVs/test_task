<script setup>

import {Head, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormDefault from "@/Components/FormDefault.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {vMaska} from "maska";
import {onMounted, ref} from "vue";

const props = defineProps({
    lead: {
        type: Object,
        required: true
    }
})

const hasChanges = ref(false)
const firstChangeMaska = ref(false)

const form = useForm({
    firstName: '',
    lastName: '',
    phone: '',
    email: '',
    message: '',
    status: '',
})


onMounted(() => {
    Object.assign(form, props.lead.data)
})

const submit = () => {
    form.put(route('lead.update', props.lead.data.id))
};

const changeValue = (field) => {
    if (field === 'phone' && !firstChangeMaska.value)
        return

    form.clearErrors(field)
    if(props.lead[field] !== form[field])
        hasChanges.value = true
}

const onMaska = (event) => {
    if (!firstChangeMaska.value)
        firstChangeMaska.value = true

    console.log({
        masked: event.detail.masked,
        unmasked: event.detail.unmasked,
        completed: event.detail.completed
    })
}
</script>

<template>
    <Head title="Редактирование лида"/>
    <AuthenticatedLayout>
        <div class=" sm:justify-center items-center w-full sm:rounded-lg">
            <FormDefault form-type="lead" :has-auth-buttons="false">
                <template v-slot:header>Редактирование лида № {{ lead.data.id }}</template>
                <form @submit.prevent="submit" class="space-y-4">
                    <InputLabel for="firstName" value="Имя"/>
                    <div class="relative">
                        <TextInput type="text"
                                   placeholder="Имя"
                                   v-model="form.firstName"
                                   id="firstName"
                                   @input="changeValue('firstName')"
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
                                   @input="changeValue('lastName')"
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
                                   @input="changeValue('phone')"
                                   @maska="onMaska"
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
                                   @input="changeValue('email')"
                        />
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>
                    <InputLabel for="message" value="Текст обращения"/>
                    <div class="relative">
                   <textarea id="message" v-model="form.message" placeholder="Текст обращения"
                             class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                             @input="changeValue('message')"
                   />
                        <InputError class="mt-2" :message="form.errors.message"/>
                    </div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Выберите
                        статус</label>
                    <select id="status" name="status"
                            class="w-full block px-4 py-2 focus:outline-none focus:ring-2
                                   focus:ring-blue-500 sm:text-sm rounded-md"
                            v-model="form.status">
                        <option value="новый">Новый</option>
                        <option value="в работе">В работе</option>
                        <option value="завершен">Завершен</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.status"/>
                    <PrimaryButton class="disabled:opacity-50" type="submit" :disabled="!hasChanges">
                        Обновить
                    </PrimaryButton>
                </form>
            </FormDefault>
        </div>
        <flash-message
            v-if="form.recentlySuccessful"
            :message="$page.props.flash.message"
            type="success"
        />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
