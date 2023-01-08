<script setup>
import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    tokens: Array,
    availablePermissions: Array,
    defaultPermissions: Array,
});
</script>

<template>
    <AppLayout title="API Tokens">
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
            <div class="max-w-7xl mx-auto py-10 px-2 sm:px-6 lg:px-8">
                <ApiTokenManager
                    :tokens="tokens"
                    :available-permissions="availablePermissions"
                    :default-permissions="defaultPermissions"
                />
            </div>
        </div>
    </AppLayout>
</template>
