<script setup>
import { ref } from "vue";
const opened = ref(false);
</script>
<template>
    <div>
        <p>
            <button
                type="button"
                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                @click="opened = !opened"
            >
                <span><slot name="title"></slot></span>
                <svg
                    data-accordion-icon
                    class="w-6 h-6 shrink-0"
                    :class="{ 'rotate-180': opened }"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </button>
        </p>
        <div>
            <div
                class="p-5 font-light border border-gray-200 dark:border-gray-700"
                v-show="opened"
            >
                <slot></slot>
            </div>
        </div>
    </div>
</template>
