<script setup>

const isVisible = defineModel('isVisible')
const emit = defineEmits(['confirm'])
const confirmAction = () => {
    emit('confirm')
}

</script>

<template>
    <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h2 class="text-lg font-semibold mb-4">Подтвердите удаление</h2>
            <p class="mb-4">Вы уверены, что хотите удалить этот элемент?</p>
            <div class="flex justify-end space-x-4">
                <button @click="isVisible = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">Отмена</button>
                <button @click="confirmAction" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600 text-white">Удалить</button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
