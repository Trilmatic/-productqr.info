<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center btn bg-error text-white hover:bg-error-focus text-white">
        <slot />
    </button>
</template>
