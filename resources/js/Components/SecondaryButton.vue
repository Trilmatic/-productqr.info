<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center btn bg-secondary text-white hover:bg-secondary-focus text-white">
        <slot />
    </button>
</template>
