<script setup>
import {ref, onMounted} from 'vue';

const props = defineProps({
    message: String,
    type: String
});

const isVisible = ref(false);

const hideMessage = () => {
    isVisible.value = false;
}

onMounted(() => {
    isVisible.value = true;
});
</script>

<template>
    <div class="flash-message-container"  v-if="isVisible">
        <div :class="['flash-message', `flash-${type}`]">
            <div>{{ message }}</div>
            <button @click="hideMessage">&times;</button>
        </div>
    </div>
</template>

<style scoped>
.flash-message-container {
    position: fixed;
    top: 1rem;
    right: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
}

.flash-message {
    font-size: .95em;
    width: 600px;
    color: #fff;
    padding: 1rem;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 10px;
    align-items: center;
}

.flash-error,
.flash-danger {
    background-color: #ff5252;
}

.flash-success {
    background-color: #4caf50;
}

.flash-warning {
    background-color: #ffab40;
}

</style>
