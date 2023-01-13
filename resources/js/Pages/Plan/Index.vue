<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PricingTables from "@/Components/PricingTables.vue";
const props = defineProps({
    plans: Array,
});
</script>

<template>
    <Head title="About us" />
    <AppLayout>
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
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <section class="md:pb-20">
                        <div
                            class="max-w-6xl mx-auto px-4 sm:px-6"
                            id="subscriptions"
                        >
                            <div class="pt-12">
                                <!-- Section header -->
                                <div class="max-w-3xl mx-auto text-center pb-8">
                                    <h2 class="h2 font-cabinet-grotesk">
                                        Find a plan that fits your business best
                                    </h2>
                                </div>

                                <!-- Pricing tables -->
                                <PricingTables :plans="plans" />
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
