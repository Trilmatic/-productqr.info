<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
  products: Object,
});
</script>
<template>
  <AppLayout title="Dashboard">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table>
          <thead>
            <tr>
              <th>Hash</th>
              <th>Name</th>
              <th>Internal Identification</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in products.data" :key="p.id">
              <td>{{ p.hash }}</td>
              <td>{{ p.name }}</td>
              <td>{{ p.internal_identification }}</td>
              <td></td>
            </tr>
          </tbody>
          <tfoot></tfoot>
        </table>
      </div>
    </div>
  </AppLayout>
</template> 