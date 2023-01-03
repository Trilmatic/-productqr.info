<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center btn bg-warning hover:bg-warning-focus text-white">
        <slot />
    </button>
</template>
