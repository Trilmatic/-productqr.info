<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, ref, onMounted, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import TomSelect from "tom-select/dist/js/tom-select.complete.min";
import Sidebar from "@/Components/Sidebar.vue";

const props = defineProps({
  products: Object,
  per_page: String,
  sort: String,
  where_any: String,
});

const filters = reactive({
  per_page: props.per_page,
  sort: props.sort,
  search: props.search,
  where_any: props.where_any,
});

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

const sidebarComponent = ref(null);

const sort_split = computed(() => {
  if (!filters.sort) return null;
  return filters.sort.split(",");
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

function orderBy(field) {
  if (!field.sortable) return;
  let order_direction = "asc";
  if (
    sort_split.value &&
    sort_split.value[0] == field.key &&
    sort_split.value[1] == "asc"
  )
    order_direction = "desc";
  filters.sort = field.key + "," + order_direction;
  reload();
}

function changePerPage(e) {
  filters.per_page = e.target.value;
  reload();
}

function search(e) {
  filters.where_any = e.target.value;
  reload();
}

function reload() {
  Inertia.get(window.location.pathname, filters, {
    preserveState: true,
    preserveScroll: true,
  });
}

async function initSelects() {
  let perpage = document.getElementById("per-page");
  if (perpage.tomselect) return;
  let settings = {};
  new TomSelect(perpage, settings);
}

const form = reactive({
  hash: null,
  name: null,
  identification_code: null,
});

function edit(record) {
  if (!sidebarComponent.value) return;
  form.hash = record.hash;
  form.name = record.name;
  form.identification_code = record.identification_code;
  let nameInput = document.getElementById("product_name");
  let codeInput = document.getElementById("identification_code");
  if (nameInput) nameInput.value = record.name;
  if (codeInput) codeInput.value = record.identification_code;
  sidebarComponent.value.open();
}

function addNew() {
  form.hash = null;
  form.name = null;
  form.identification_code = null;
  let nameInput = document.getElementById("name");
  let codeInput = document.getElementById("identification_code");
  if (nameInput) nameInput.value = null;
  if (codeInput) codeInput.value = null;
}

function submit() {
  if (!form.hash) Inertia.post("/product/store", form);
  else Inertia.put("/product/" + form.hash + "/update", form);
  if (sidebarComponent.value) sidebarComponent.value.close();
}

onMounted(() => {
  initSelects();
  let search = document.getElementById("search");
  if (search) search.value = props.where_any;
});
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
          <th :colspan="fields.length + 1">
            <div
              class="
                flex
                justify-between
                items-center
                flex-wrap
                space-y-2
                px-3
                py-2
              "
            >
              <div>
                <div v-show="products.total && products.total > 10">
                  <select id="per-page" @change="changePerPage">
                    <option :selected="filters.per_page == '5'" value="5">
                      5
                    </option>
                    <option :selected="filters.per_page == '10'" value="10">
                      10
                    </option>
                    <option :selected="filters.per_page == '25'" value="25">
                      25
                    </option>
                    <option :selected="filters.per_page == '50'" value="50">
                      50
                    </option>
                    <option :selected="filters.per_page == '100'" value="100">
                      100
                    </option>
                  </select>
                </div>
              </div>
              <div class="flex items-center space-x-2">
                <Sidebar ref="sidebarComponent" @open-clicked="addNew">
                  <template #button>
                    <span
                      class="
                        btn
                        bg-primary
                        hover:bg-primary-focus
                        dark:text-white
                      "
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-square-rounded-plus"
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
                        <path d="M9 12h6"></path>
                        <path d="M12 9v6"></path>
                        <path
                          d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"
                        ></path></svg
                    ></span>
                  </template>
                  <template #title
                    ><span v-if="!form.id">Add product</span
                    ><span v-else>Edit product</span></template
                  >
                  <form class="px-4" @submit.prevent="submit">
                    <div class="space-y-4">
                      <div>
                        <label class="block text-sm font-medium mb-1" for="name"
                          >Name</label
                        >
                        <input
                          id="product_name"
                          type="text"
                          class="form-input w-full"
                          @change="form.name = $event.target.value"
                        />
                      </div>
                      <div>
                        <label
                          class="block text-sm font-medium mb-1"
                          for="identification_code"
                          >Identification code</label
                        >
                        <input
                          id="identification_code"
                          type="text"
                          class="form-input w-full"
                          @change="
                            form.identification_code = $event.target.value
                          "
                        />
                      </div>
                    </div>
                    <div
                      class="flex items-center justify-between space-x-2 mt-6"
                    >
                      <button
                        class="
                          btn
                          inline-flex
                          items-center
                          text-white
                          bg-gray-900
                          hover:bg-gray-800
                          dark:hover:bg-gray-700
                          group
                        "
                        type="submit"
                      >
                        <span v-if="!form.hash">Create</span
                        ><span v-else>Edit</span>
                        <span
                          class="
                            tracking-normal
                            text-blue-500
                            group-hover:translate-x-0.5
                            transition-transform
                            duration-150
                            ease-in-out
                            ml-2
                          "
                        >
                          <svg
                            class="fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="8"
                          >
                            <path
                              d="m10.865.013.747.148c.243.065.481.143.716.235.495.18.97.42 1.415.716.265.192.571.343.858.55.096.064.192.135.288.209l.196.154.192.178c.09.08.175.168.254.262.189.21.33.466.414.747.076.275.073.568-.008.84-.09.27-.236.513-.427.708-.096.1-.198.191-.306.274l-.152.117-.116.074c-.369.252-.75.482-1.14.69-.577.315-1.153.585-1.701.932-.408.262-.803.549-1.182.86-.083.064-.16.136-.247.193a.918.918 0 0 1-.113.072.644.644 0 0 1-.118.016.708.708 0 0 1-.191.01.559.559 0 0 1-.246-.088l-.072-.054a1.481 1.481 0 0 1-.141-.107c-.128-.122-.1-.377.05-.726.036-.08.079-.156.128-.226l.316-.401c.164-.188.336-.372.514-.543.178-.17.356-.342.546-.493.19-.152.394-.265.59-.39.53-.329 1.05-.626 1.552-.93-.159.018-.32.034-.48.04-.511.036-1.026.044-1.546.048a43.432 43.432 0 0 1-2.31-.058l-.005-.02a78.728 78.728 0 0 0-2.292-.148c-.279-.016-.558.01-.837-.006L4.543 3.81l-.977-.046a19.357 19.357 0 0 1-.49-.029 12.6 12.6 0 0 0-1.303.013l-.828.055-.406.021H.335l-.18.008c-.145 0-.208-.15-.102-.356.16-.268.422-.46.723-.531.57-.117 1.144-.205 1.72-.264.287-.026.576-.048.865-.053.29-.004.578.01.865.042.69.065 1.408-.015 2.113-.015.776.003 1.549.02 2.324.04l1.428.039 1.087.039c.359.012.716.02 1.075.013.442-.008.879-.065 1.318-.112a3.672 3.672 0 0 0-.186-.166 9.045 9.045 0 0 0-1.06-.762 9.82 9.82 0 0 0-1.034-.537 5.9 5.9 0 0 1-1.284-.854c-.12-.115-.053-.199.12-.26a1.55 1.55 0 0 1 .738-.083Z"
                            />
                          </svg>
                        </span>
                      </button>
                    </div>
                  </form>
                </Sidebar>
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                  <div
                    class="
                      absolute
                      inset-y-0
                      left-0
                      flex
                      items-center
                      pl-3
                      pointer-events-none
                    "
                  >
                    <svg
                      aria-hidden="true"
                      class="w-5 h-5 text-gray-500 dark:text-gray-400"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </div>
                  <input
                    type="text"
                    id="search"
                    @change="search"
                    class="
                      bg-gray-50
                      border border-gray-300
                      text-gray-900 text-sm
                      rounded-lg
                      focus:ring-primary focus:border-primary
                      block
                      w-full
                      pl-10
                      p-2.5
                      dark:bg-gray-700
                      dark:border-gray-600
                      dark:placeholder-gray-400
                      dark:text-white
                      dark:focus:ring-primary
                      dark:focus:border-primary
                    "
                    placeholder="Search"
                    required
                  />
                </div>
              </div>
            </div>
          </th>
        </tr>
        <tr>
          <th class="px-4 py-2" v-for="(field, i) in fields" :key="i">
            <span
              class="flex-1 flex items-center space-x-2"
              :class="{ 'hover:cursor-pointer': field.sortable }"
              @click="orderBy(field)"
            >
              <span v-if="field.sortable"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-arrows-sort"
                  width="15"
                  height="15"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M3 9l4 -4l4 4m-4 -4v14"
                    :class="
                      sort_split &&
                      sort_split[0] == field.key &&
                      sort_split[1] == 'desc'
                        ? 'dark:stroke-white stroke-black'
                        : ''
                    "
                  ></path>
                  <path
                    d="M21 15l-4 4l-4 -4m4 4v-14"
                    :class="
                      sort_split &&
                      sort_split[0] == field.key &&
                      sort_split[1] == 'asc'
                        ? 'dark:stroke-white stroke-black'
                        : ''
                    "
                  ></path></svg></span
              ><span>{{ field.label }}</span></span
            >
          </th>
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
          <td class="px-4 py-2" v-for="(field, i) in fields" :key="i">
            <span v-if="field.key === 'hash'"
              ><Link class="text-primary hover:text-primary-focus" :href="'/product/' + p.hash + '/info'">{{
                p[field.key]
              }}</Link></span
            >
            <span v-else>{{ p[field.key] }}</span>
          </td>
          <td>
            <div class="flex space-x-2 items-center">
              <Link :href="'/product/' + p.hash + '/info'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    icon icon-tabler icon-tabler-info-circle
                    hover:stroke-primary
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
              </Link>
              <button
                class="
                  btn-edit
                  stroke-gray-700
                  dark:stroke-gray-400
                  hover:stroke-amber-600
                "
                type="button"
                @click="edit(p)"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    icon icon-tabler icon-tabler-pencil
                    hover:stroke-warning
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
                    d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"
                  ></path>
                  <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                </svg>
              </button>
              <button type="button" class="" @click="deleteRecord(p.hash)">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-trash hover:stroke-error"
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
      <tfoot
        class="
          text-xs text-gray-700
          uppercase
          bg-gray-50
          dark:bg-gray-700 dark:text-gray-400
          sticky
          bottom-0
          min-w-[100vh]
          z-1
        "
      >
        <tr>
          <td :colspan="fields.length + 1">
            <span
              class="
                flex flex-wrap
                items-center
                justify-between
                px-4
                py-2
                min-h-[3rem]
                md:max-w-[calc(100vw-2rem)]
                z-2
                relative
              "
            >
              <span
                >showing <strong>{{ products.from }}</strong> to
                <strong>{{ products.to }}</strong> out of
                <strong>{{ products.total }}</strong> results.</span
              >
              <span>
                <ul class="pagination">
                  <li v-for="(l, i) in products.links" :key="i">
                    <Link
                      class="pagination-link"
                      :href="l.url ? l.url : ''"
                      :data="filters"
                      :class="{
                        active: l.active,
                        disabled: !l.url,
                      }"
                      v-html="l.label"
                      preserve-state
                      preserve-scroll
                    ></Link>
                  </li>
                </ul>
              </span>
            </span>
          </td>
        </tr>
      </tfoot>
    </table>
  </AppLayout>
</template> 