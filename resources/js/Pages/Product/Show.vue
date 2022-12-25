<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
  product: Object,
});
</script>
<template>
  <AppLayout title="Dashboard">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{ product }}
      </div>
    </div>
  </AppLayout>
</template>