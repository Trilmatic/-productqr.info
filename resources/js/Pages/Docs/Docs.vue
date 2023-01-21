<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import WhatIsProductqr from "@/Pages/Docs/Partials/WhatIsProductqr.vue";
import Basics from "@/Pages/Docs/Partials/Basics.vue";
import { isSticky } from "@/sticky.js";

const tab = ref("what-is-productqr");

onMounted(() => {
    if (window.location.hash) tab.value = window.location.hash.substring(1);
    var options = {
        direction: "top",
        offset: 20,
        viewport: 768,
    };
    isSticky("sticky", options);
});
</script>

<template>
    <AppLayout title="Profile">
        <section class="relative overflow-hidden p-8">
            <!-- Bg -->
            <div
                class="absolute inset-0 bg-blue-600 pointer-events-none -z-10"
                aria-hidden="true"
            ></div>

            <!-- Illustration -->
            <div
                class="absolute top-0 left-1/2 -translate-y-1/8 -translate-x-1/3 md:-translate-x-1/2 pointer-events-none -z-10"
                aria-hidden="true"
            >
                <object
                    type="image/svg+xml"
                    data="/images/hero-illustration.svg"
                    width="1440"
                    height="1214"
                ></object>
            </div>
        </section>
        <div>
            <div class="max-w-7xl mx-auto py-10 px-2 sm:px-6 lg:px-8 space-y-5">
                <div class="flex flex-wrap md:flex-nowrap mt-8">
                    <aside class="w-full md:w-64 pb-8">
                        <div
                            class="px-3 py-4 overflow-y-auto rounded-lg bg-gray-50 dark:bg-gray-800"
                            id="sticky"
                        >
                            <ul class="space-y-2 list-none pl-0">
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'what-is-productqr'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#what-is-productqr"
                                        @click="tab = 'what-is-productqr'"
                                    >
                                        <span>What is ProductQR</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'basics'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#basics"
                                        @click="tab = 'basics'"
                                    >
                                        <span>Basics</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'api-setup'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#api-setup"
                                        @click="tab = 'api-setup'"
                                    >
                                        <span>API setup</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'api-basics'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#api-basics"
                                        @click="tab = 'api-basics'"
                                    >
                                        <span>API basics</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'api-reference'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#api-reference"
                                        @click="tab = 'api-reference'"
                                    >
                                        <span>API reference</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <article class="md:pl-4 w-full">
                        <div v-show="tab === 'what-is-productqr'">
                            <WhatIsProductqr />
                        </div>
                        <div v-show="tab === 'basics'">
                            <Basics />
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
