<script setup>
import {Head, Link} from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue'
import FormDefault from '@/Components/FormDefault.vue'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <Head title="Главная страница"/>
    <GuestLayout>
        <FormDefault form-type="lead">
            <template v-slot:header>Подача заявки</template>
            <template v-slot:description>Заполните форму, чтобы мы могли связаться с вами</template>
        </FormDefault>
    </GuestLayout>

</template>
