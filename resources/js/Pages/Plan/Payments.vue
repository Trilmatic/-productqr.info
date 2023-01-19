<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
const props = defineProps({
    invoices: Array,
});

const formatter = ref(
    Intl.NumberFormat("en-GB", {
        style: "currency",
        currency: "EUR",
    })
);
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
                        <p class="h3 text-center">Payments.</p>
                        <div class="max-w-3xl mx-auto text-center mt-6">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6"
                            >
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr class="">
                                            <th class="px-6 py-3">
                                                Transanction
                                            </th>
                                            <th class="px-6 py-3">
                                                Date & Time
                                            </th>
                                            <th class="px-6 py-3">Ammount</th>
                                            <th class="px-6 py-3">
                                                Next payment attempt
                                            </th>
                                            <th class="px-6 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="invoice in invoices"
                                            :key="invoice.id"
                                            class="hover:cursor-pointer border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <td>
                                                <a
                                                    class="block px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                                    :href="
                                                        invoice.hosted_invoice_url
                                                    "
                                                    target="_blank"
                                                    >{{ invoice.number }}</a
                                                >
                                            </td>
                                            <td>
                                                <a
                                                    class="block px-6 py-4"
                                                    :href="
                                                        invoice.hosted_invoice_url
                                                    "
                                                    target="_blank"
                                                >
                                                    <span
                                                        v-if="
                                                            invoice
                                                                .status_transitions
                                                                .paid_at
                                                        "
                                                        >{{
                                                            new Date(
                                                                invoice
                                                                    .status_transitions
                                                                    .paid_at *
                                                                    1000
                                                            ).toLocaleDateString(
                                                                "en-GB"
                                                            )
                                                        }}</span
                                                    >
                                                    <span v-else>-</span></a
                                                >
                                            </td>
                                            <td>
                                                <a
                                                    class="block px-6 py-4"
                                                    :href="
                                                        invoice.hosted_invoice_url
                                                    "
                                                    target="_blank"
                                                >
                                                    {{
                                                        formatter.format(
                                                            invoice.total / 100
                                                        )
                                                    }}
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                    class="block px-6 py-4"
                                                    :href="
                                                        invoice.hosted_invoice_url
                                                    "
                                                    target="_blank"
                                                >
                                                    <span
                                                        v-if="
                                                            invoice.next_payment_attempt
                                                        "
                                                        >{{
                                                            new Date(
                                                                invoice.next_payment_attempt *
                                                                    1000
                                                            ).toLocaleDateString(
                                                                "en-GB"
                                                            )
                                                        }}</span
                                                    >
                                                    <span v-else>-</span></a
                                                >
                                            </td>
                                            <td>
                                                <a
                                                    class="block px-6 py-4"
                                                    :href="
                                                        invoice.hosted_invoice_url
                                                    "
                                                    target="_blank"
                                                >
                                                    <span
                                                        class="p-2 text-white rounded-lg uppercase font-medium"
                                                        :class="{
                                                            'bg-error/70':
                                                                invoice.status ===
                                                                'void',
                                                            'bg-error/70':
                                                                invoice.status ===
                                                                'uncollectible',
                                                            'bg-success/70':
                                                                invoice.status ===
                                                                'paid',
                                                            'bg-primary/70':
                                                                invoice.status ===
                                                                'open',
                                                            'bg-secondary/70':
                                                                invoice.status ===
                                                                'draft',
                                                        }"
                                                        >{{
                                                            invoice.status
                                                        }}</span
                                                    >
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
