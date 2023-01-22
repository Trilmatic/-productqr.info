<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <div class="w-full bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6">
        <h2 class="h3 mb-2">What is ProductQR?</h2>
        <p>
            ProductQR is a lightweight app that helps to add technology into
            your physical products. You can create a product records and each of
            theese records can be localized into any ISO language.
        </p>
        <p class="mt-2">
            When product is created it has a generated QR code that you can
            download at any time. When your customers access this QR code it
            will detect language of their device and show inforamtion in that
            language if available. If not it will select the most used language
            of those localized.
        </p>
        <p class="h4 mt-4">
            Our goal is to allow customers with disadvantages access necessary
            information, while improving the customers expirience of your
            products.
        </p>
        <div class="w-full bg-gray-600 h-96 my-4"></div>
        <p class="mt-2">
            You can use our services for free, or select from a variety of
            <Link
                class="text-primary hover:text-primary-focus"
                href="/subscriptions"
                >subscriptions</Link
            >
            to fit your higher needs.
        </p>
        <p class="mt-2">
            Both light and dark mode are available and it is detected from users
            device.
        </p>
    </div>
</template>
