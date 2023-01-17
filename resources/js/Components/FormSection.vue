<script setup>
import { computed, useSlots } from "vue";
import SectionTitle from "./SectionTitle.vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
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
            <form @submit.prevent="$emit('submitted')">
                <div
                    :class="
                        hasActions
                            ? 'sm:rounded-tl-md sm:rounded-tr-md'
                            : 'sm:rounded-md'
                    "
                >
                    <div class="">
                        <slot name="form" />
                    </div>
                </div>

                <div
                    v-if="hasActions"
                    class="flex items-center justify-end py-3 text-right sm:rounded-bl-md sm:rounded-br-md"
                >
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
