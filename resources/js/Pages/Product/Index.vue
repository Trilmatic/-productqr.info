<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
  products: Object,
});
function deleteRecord(hash) {
  if (
    confirm(
      "Are you sure you want to delete? It can be restored later if needed."
    )
  ) {
    Inertia.delete("/product/" + hash + "/delete");
  }
}
</script>
<template>
  <AppLayout title="Dashboard">
    <table
      class="
        w-full
        text-sm text-left text-gray-500
        dark:text-gray-400
        overflow-x-auto
      "
    >
      <thead
        class="
          text-xs text-gray-700
          uppercase
          bg-gray-50
          dark:bg-gray-700 dark:text-gray-400
          sticky
          top-0
          z-2
        "
      >
        <tr>
          <th class="px-4 py-2">Hash</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Identification code</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="
            bg-white
            border-b
            dark:bg-gray-800 dark:border-gray-700
            hover:bg-gray-100
            dark:hover:bg-slate-800
            group
          "
          v-for="p in products.data"
          :key="p.id"
        >
          <td class="px-4 py-2">{{ p.hash }}</td>
          <td class="px-4 py-2">{{ p.name }}</td>
          <td class="px-4 py-2">{{ p.identification_code }}</td>
          <td>
            <div class="flex space-x-2 items-center">
              <button type="button">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    icon icon-tabler icon-tabler-info-circle
                    hover:stroke-sky-600
                  "
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <circle cx="12" cy="12" r="9"></circle>
                  <line x1="12" y1="8" x2="12.01" y2="8"></line>
                  <polyline points="11 12 12 12 12 16 13 16"></polyline>
                </svg>
              </button>
              <button type="button">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    icon icon-tabler icon-tabler-edit-circle
                    hover:stroke-amber-600
                  "
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z"
                  ></path>
                  <path d="M16 5l3 3"></path>
                  <path
                    d="M9 7.07a7.002 7.002 0 0 0 1 13.93a7.002 7.002 0 0 0 6.929 -5.999"
                  ></path>
                </svg>
              </button>
              <button type="button" class="" @click="deleteRecord(p.hash)">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    icon icon-tabler icon-tabler-trash
                    hover:stroke-red-600
                  "
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <line x1="4" y1="7" x2="20" y2="7"></line>
                  <line x1="10" y1="11" x2="10" y2="17"></line>
                  <line x1="14" y1="11" x2="14" y2="17"></line>
                  <path
                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                  ></path>
                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
      <tfoot></tfoot>
    </table>
  </AppLayout>
</template> 