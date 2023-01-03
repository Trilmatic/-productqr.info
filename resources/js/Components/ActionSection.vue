<script setup>
import SectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="bg-white dark:bg-slate-700 rounded-lg p-4 sm:p-6">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="">
            <div class="py-5 bg-white dark:bg-slate-700 shadow sm:rounded-lg">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
