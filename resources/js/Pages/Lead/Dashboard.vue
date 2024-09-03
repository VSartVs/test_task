<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import {router} from '@inertiajs/vue3'
import {usePage} from '@inertiajs/vue3'
import DeleteDialog from "@/Modals/DeleteModal.vue";
import {ref} from "vue";

const props = defineProps({
    leads: {
        type: Object,
        required: true
    },
    countByStatuses: {
        type: Object,
        required: true
    }
})

const tableCols = ['ID Лида', 'Имя', 'Фамилия', 'Email', 'Номер телефона', 'Дата создания', 'Статус', 'Действия']
const page = usePage()
const selectedLead = ref(null)
const isModalVisible = ref(false)

const changeLeadStatus = (lead) => {
    router.put(route('lead.update.status', lead.id), {
        status: lead.status,
    })
    page.props.flash.message = null
}

const deleteItem = () =>{
    router.delete(route('lead.destroy', selectedLead.value))
    page.props.flash.message = null
    selectedLead.value = null
    isModalVisible.value = false
}

const selectLead = (id) => {
    selectedLead.value = id
    isModalVisible.value = true
}

</script>

<template>
    <Head title="Главная панель"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Главная панель</h2>
        </template>
        <div class="pt-6">
            <h3 class="flex justify-center font-bold text-2xl text-center pb-3">Количество лидов по статусам</h3>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow"
                         v-for="(count, status) in countByStatuses">
                        <div class="text-sm font-medium text-gray-500">
                            <b>{{ status === 'всего'
                                ? status.charAt(0).toUpperCase() + status.slice(1)
                                : ' Статус: '+status }}</b>
                        </div>
                        <div class="mt-2 text-2xl font-semibold text-gray-800">
                            {{ count }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-6">
            <h3 class="flex justify-center font-bold text-2xl text-center pb-3">Лиды</h3>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="w-2/12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    v-for="col in tableCols">
                                    {{ col }}
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50" v-for="lead in leads.data">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.firstName }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.lastName }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.email }}
                                </td>
                                <td class="px-2 py-4 text-sm text-gray-700">
                                    {{ lead.phone }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.date }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="w-auto max-w-xs mx-auto">
                                        <label for="status" class="block text-sm font-medium text-gray-700">Выберите
                                            статус</label>
                                        <select id="status" name="status" class="mt-1 block w-auto pl-3 pr-10 py-2 text-base border-gray-300
                                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                v-model="lead.status" @change="changeLeadStatus(lead)">
                                            <option value="новый">Новый</option>
                                            <option value="в работе">В работе</option>
                                            <option value="завершен">Завершен</option>
                                        </select>
                                    </div>

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex space-x-2">
                                        <Link  :href="route('lead.edit', lead.id)"
                                            class="flex items-center justify-center w-10 h-10 rounded-full bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                            <i class="fas fa-edit"></i>
                                        </Link>
                                        <button class="flex items-center justify-center w-10 h-10 rounded-full
                                        bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                                data-ripple-light="true" data-dialog-target="animated-dialog" @click="selectLead(lead.id, true)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <pagination :links="leads.links"/>
                </div>
            </div>
        </div>
        <flash-message
            v-if="page.props.flash.message"
            :message="page.props.flash.message"
            type="success"
        />
        <DeleteDialog @confirm="deleteItem" v-model:is-visible="isModalVisible"/>

    </AuthenticatedLayout>
</template>
