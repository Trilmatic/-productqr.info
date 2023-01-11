<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <Head title="About us" />
    <AppLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden">
            <!-- Bg -->
            <div
                class="absolute inset-0 bg-blue-600 pointer-events-none -z-10"
                aria-hidden="true"
            ></div>

            <!-- Illustration -->
            <div
                class="absolute left-1/2 -translate-x-1/3 md:-translate-x-1/2 pointer-events-none -z-10"
                aria-hidden="true"
            >
                <object
                    type="image/svg+xml"
                    data="/images/hero-illustration.svg"
                    width="1440"
                    height="1214"
                ></object>
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="pt-28 pb-16 md:pt-40 md:pb-20">
                    <!-- Hero content -->
                    <div class="max-w-3xl mx-auto text-center">
                        <h1
                            class="h1 font-cabinet-grotesk text-white mb-2"
                            data-aos="fade-up"
                        >
                            About us
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <div
                        class="max-w-3xl mx-auto text-center pb-6 md:pb-8 mb-6 border-b border-gray-200 dark:border-gray-800"
                    >
                        <h2
                            class="h4 font-cabinet-grotesk"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            Not everybody can read the small format product
                            information or guides, but everybody should have
                            access to it.
                        </h2>
                    </div>
                    <p
                        class="text-lg md:text-xl text-white text-left text-opacity-80 mb-8"
                    >
                        We want to make products more accessible and
                        understandable for customers all around the world. The
                        goal of our services is to be easily setup, simple, but
                        very effective. We are auto generating thousands of QR
                        codes to just make customer care better.
                    </p>
                    <div
                        class="max-w-3xl mx-auto text-center pb-6 md:pb-8 mb-6 border-b border-gray-200 dark:border-gray-800"
                    >
                        <h2 class="text-xl font-cabinet-grotesk">
                            But why would you need to use productqr when you
                            already have a company website?
                        </h2>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
