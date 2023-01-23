<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
const props = defineProps({
    subscription: Object,
    products_count: Number,
    invoices: Array,
    is_over_product_limit: Boolean,
    is_over_api_limit: Boolean,
    api_calls_count: Number,
    products: Array,
});
const formatter = ref(
    Intl.NumberFormat("en-GB", {
        style: "currency",
        currency: "EUR",
    })
);

const fields = ref([
    {
        label: "Hash",
        key: "hash",
        sortable: true,
    },
    {
        label: "Name",
        key: "name",
        sortable: true,
    },
    {
        label: "Identification code",
        key: "identification_code",
        sortable: true,
    },
]);

function deleteRecord(hash) {
    if (confirm("Are you sure you want to delete?")) {
        router.delete("/product/" + hash + "/delete");
    }
}
</script>

<template>
    <AppLayout title="Dashboard">
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
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <section>
                    <div
                        class="rounded-lg bg-error-focus font-bold text-white p-4 mb-4"
                        v-if="is_over_product_limit"
                    >
                        <p>
                            You are over your product limit so some of the
                            products are not visible to public. Please subscribe
                            to higher plan.
                        </p>
                    </div>
                    <div
                        class="rounded-lg bg-error-focus font-bold text-white p-4 mb-4"
                        v-if="is_over_api_limit"
                    >
                        <p>
                            You are over your monthly API calls limit. If you
                            need higher API calls limit please contact us at
                            <a
                                class="text-warning hover:text-warning-focus"
                                href="mailo:hello@productqr.info"
                                >hello@productqr.info</a
                            >.
                        </p>
                    </div>
                    <div
                        class="grid sm:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4"
                    >
                        <div
                            class="rounded-lg p-4 sm:p-6 relative overflow-hidden"
                            :class="
                                is_over_product_limit
                                    ? 'bg-error'
                                    : 'bg-white dark:bg-gray-800'
                            "
                        >
                            <p class="h5">Products</p>
                            <p class="h4">{{ products_count }}</p>
                            <div class="flex mt-4">
                                <Link
                                    class="btn bg-primary hover:bg-primary-focus"
                                    href="/product"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-qrcode"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            stroke="none"
                                            d="M0 0h24v24H0z"
                                            fill="none"
                                        ></path>
                                        <rect
                                            x="4"
                                            y="4"
                                            width="6"
                                            height="6"
                                            rx="1"
                                        ></rect>
                                        <line
                                            x1="7"
                                            y1="17"
                                            x2="7"
                                            y2="17.01"
                                        ></line>
                                        <rect
                                            x="14"
                                            y="4"
                                            width="6"
                                            height="6"
                                            rx="1"
                                        ></rect>
                                        <line
                                            x1="7"
                                            y1="7"
                                            x2="7"
                                            y2="7.01"
                                        ></line>
                                        <rect
                                            x="4"
                                            y="14"
                                            width="6"
                                            height="6"
                                            rx="1"
                                        ></rect>
                                        <line
                                            x1="17"
                                            y1="7"
                                            x2="17"
                                            y2="7.01"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="14"
                                            x2="17"
                                            y2="14"
                                        ></line>
                                        <line
                                            x1="20"
                                            y1="14"
                                            x2="20"
                                            y2="14.01"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="14"
                                            x2="14"
                                            y2="17"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="20"
                                            x2="17"
                                            y2="20"
                                        ></line>
                                        <line
                                            x1="17"
                                            y1="17"
                                            x2="20"
                                            y2="17"
                                        ></line>
                                        <line
                                            x1="20"
                                            y1="17"
                                            x2="20"
                                            y2="20"
                                        ></line>
                                    </svg>
                                    See all
                                </Link>
                            </div>
                            <div class="absolute -right-5 -top-5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-barcode opacity-25"
                                    width="125"
                                    height="125"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    ></path>
                                    <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                    <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                    <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                    <rect
                                        x="5"
                                        y="11"
                                        width="1"
                                        height="2"
                                    ></rect>
                                    <line
                                        x1="10"
                                        y1="11"
                                        x2="10"
                                        y2="13"
                                    ></line>
                                    <rect
                                        x="14"
                                        y="11"
                                        width="1"
                                        height="2"
                                    ></rect>
                                    <line
                                        x1="19"
                                        y1="11"
                                        x2="19"
                                        y2="13"
                                    ></line>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6 relative overflow-hidden"
                        >
                            <p class="h5">Subscription</p>
                            <div v-if="subscription">
                                <p class="h4">{{ __(subscription.name) }}</p>
                                <div class="flex mt-4">
                                    <Link
                                        class="btn bg-secondary hover:bg-secondary-focus"
                                        href="/user/subscribtion/change"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrows-exchange"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path
                                                stroke="none"
                                                d="M0 0h24v24H0z"
                                                fill="none"
                                            ></path>
                                            <path d="M7 10h14l-4 -4"></path>
                                            <path d="M17 14h-14l4 4"></path>
                                        </svg>
                                        Change plan
                                    </Link>
                                </div>
                            </div>
                            <div v-else>
                                <p class="h4">Free</p>
                                <div class="flex mt-4">
                                    <Link
                                        class="btn bg-secondary hover:bg-secondary-focus"
                                        href="/subscriptions"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrows-exchange"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path
                                                stroke="none"
                                                d="M0 0h24v24H0z"
                                                fill="none"
                                            ></path>
                                            <path d="M7 10h14l-4 -4"></path>
                                            <path d="M17 14h-14l4 4"></path>
                                        </svg>
                                        Subscribe
                                    </Link>
                                </div>
                            </div>
                            <div class="absolute -right-5 -top-5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-discount-check opacity-25"
                                    width="125"
                                    height="125"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    ></path>
                                    <path
                                        d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"
                                    ></path>
                                    <path d="M9 12l2 2l4 -4"></path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="rounded-lg p-4 sm:p-6 relative overflow-hidden"
                            :class="
                                is_over_api_limit
                                    ? 'bg-error'
                                    : 'bg-white dark:bg-gray-800'
                            "
                        >
                            <p class="h5">API calls</p>
                            <p class="h4">{{ api_calls_count }}</p>
                            <div class="flex mt-4">
                                <Link
                                    class="btn bg-warning hover:bg-warning-focus"
                                    href="/user/api-tokens"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-settings-2"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            stroke="none"
                                            d="M0 0h24v24H0z"
                                            fill="none"
                                        ></path>
                                        <path
                                            d="M19 6.873a2 2 0 0 1 1 1.747v6.536a2 2 0 0 1 -1.029 1.748l-6 3.833a2 2 0 0 1 -1.942 0l-6 -3.833a2 2 0 0 1 -1.029 -1.747v-6.537a2 2 0 0 1 1.029 -1.748l6 -3.572a2.056 2.056 0 0 1 2 0l6 3.573h-.029z"
                                        ></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    Manage tokens
                                </Link>
                            </div>
                            <div class="absolute -right-5 -top-5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-api-app opacity-25"
                                    width="125"
                                    height="125"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    ></path>
                                    <path
                                        d="M12 15h-6.5a2.5 2.5 0 1 1 0 -5h.5"
                                    ></path>
                                    <path
                                        d="M15 12v6.5a2.5 2.5 0 1 1 -5 0v-.5"
                                    ></path>
                                    <path
                                        d="M12 9h6.5a2.5 2.5 0 1 1 0 5h-.5"
                                    ></path>
                                    <path
                                        d="M9 12v-6.5a2.5 2.5 0 0 1 5 0v.5"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="flex flex-wrap mt-4">
                        <div class="lg:pr-1 w-full lg:w-7/12">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg overflow-x-auto"
                            >
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-lg"
                                >
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr class="">
                                            <th class="px-6 py-3">Hash</th>
                                            <th class="px-6 py-3">Name</th>
                                            <th class="px-6 py-3">
                                                Identification code
                                            </th>
                                            <th class="px-6 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        v-if="products && products.length > 0"
                                    >
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-slate-800 group"
                                            v-for="p in products"
                                            :key="p.id"
                                        >
                                            <td
                                                class="px-4 py-2"
                                                v-for="(field, i) in fields"
                                                :key="i"
                                            >
                                                <span
                                                    v-if="field.key === 'hash'"
                                                    ><Link
                                                        class="text-primary hover:text-primary-focus"
                                                        :href="
                                                            '/product/' +
                                                            p.hash +
                                                            '/info'
                                                        "
                                                        >{{
                                                            p[field.key]
                                                        }}</Link
                                                    ></span
                                                >
                                                <span v-else>{{
                                                    p[field.key]
                                                }}</span>
                                            </td>
                                            <td>
                                                <div
                                                    class="flex space-x-2 items-center"
                                                >
                                                    <Link
                                                        class="hover:bg-primary rounded-full p-2 m-1 transition-all duration-100 hover:text-white"
                                                        :href="
                                                            '/product/' +
                                                            p.hash +
                                                            '/info'
                                                        "
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        >
                                                            <path
                                                                stroke="none"
                                                                d="M0 0h24v24H0z"
                                                                fill="none"
                                                            ></path>
                                                            <circle
                                                                cx="12"
                                                                cy="12"
                                                                r="9"
                                                            ></circle>
                                                            <line
                                                                x1="12"
                                                                y1="8"
                                                                x2="12.01"
                                                                y2="8"
                                                            ></line>
                                                            <polyline
                                                                points="11 12 12 12 12 16 13 16"
                                                            ></polyline>
                                                        </svg>
                                                    </Link>
                                                    <a
                                                        type="button"
                                                        class="hover:bg-secondary rounded-full p-2 m-1 transition-all duration-100 hover:text-white"
                                                        :href="p.qr_code"
                                                        download
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-download"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        >
                                                            <path
                                                                stroke="none"
                                                                d="M0 0h24v24H0z"
                                                                fill="none"
                                                            ></path>
                                                            <path
                                                                d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"
                                                            ></path>
                                                            <polyline
                                                                points="7 11 12 16 17 11"
                                                            ></polyline>
                                                            <line
                                                                x1="12"
                                                                y1="4"
                                                                x2="12"
                                                                y2="16"
                                                            ></line>
                                                        </svg>
                                                    </a>
                                                    <button
                                                        type="button"
                                                        class="hover:bg-error rounded-full p-2 m-1 transition-all duration-100 hover:text-white"
                                                        @click="
                                                            deleteRecord(p.hash)
                                                        "
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-trash"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        >
                                                            <path
                                                                stroke="none"
                                                                d="M0 0h24v24H0z"
                                                                fill="none"
                                                            ></path>
                                                            <line
                                                                x1="4"
                                                                y1="7"
                                                                x2="20"
                                                                y2="7"
                                                            ></line>
                                                            <line
                                                                x1="10"
                                                                y1="11"
                                                                x2="10"
                                                                y2="17"
                                                            ></line>
                                                            <line
                                                                x1="14"
                                                                y1="11"
                                                                x2="14"
                                                                y2="17"
                                                            ></line>
                                                            <path
                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                                            ></path>
                                                            <path
                                                                d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr
                                            class="border-b dark:border-gray-700 text-center"
                                        >
                                            <td colspan="4" class="p-8">
                                                No products yet.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="lg:pl-3 w-full lg:w-5/12 mt-4 lg:mt-0">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg overflow-x-auto"
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
                                            <th class="px-6 py-3">Date</th>
                                            <th class="px-6 py-3">Ammount</th>
                                            <th class="px-6 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="invoices.length > 0">
                                        <tr
                                            v-for="invoice in invoices"
                                            :key="invoice.id"
                                            class="hover:cursor-pointer border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-slate-800"
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
                                                            ).toLocaleString(
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
                                    <tbody v-else>
                                        <tr
                                            class="border-b dark:border-gray-700 text-center"
                                        >
                                            <td colspan="4" class="p-8">
                                                No payments yet.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AppLayout>
</template>
