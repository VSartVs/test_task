<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    links: {
        type: Object,
        required: true
    }
})
const changePage = (url) => {
    if (url) {
        this.$inertia.visit(url);
    }
}

</script>

<template>
    <div class="pagination flex justify-center space-x-2 py-4">
        <Link :href="links.prev"
              as="button" type="button" :disabled="!links.prev"
              class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition duration-200">
            Предыдущая
        </Link>

        <Link :href="links.next" :class="{ 'active': !links.next }"
              as="button" type="button" :disabled="!links.next"
              class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition duration-200">
            Следующая
        </Link>
    </div>

</template>

<style scoped>

</style>
