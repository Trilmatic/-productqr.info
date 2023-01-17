<script setup>
import SectionTitle from "./SectionTitle.vue";
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6">
        <SectionTitle>
            <template #title>
                <div
                    class="mb-4 pb-4 border-b border-gray-300 dark:border-gray-700 w-full"
                >
                    <slot name="title" />
                </div>
            </template>
            <template #description>
                <div class="text-gray-700 dark:text-gray-300">
                    <slot name="description" />
                </div>
            </template>
        </SectionTitle>

        <div class="">
            <div class="sm:rounded-lg">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
