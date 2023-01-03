<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center btn bg-primary hover:bg-primary-focus text-white">
        <slot />
    </button>
</template>
