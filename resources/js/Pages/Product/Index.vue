<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, ref, onMounted, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import TomSelect from "tom-select/dist/js/tom-select.complete.min";

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

onMounted(() => {
  initSelects();
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
            <div class="flex justify-between items-center flex-wrap space-y-2 px-3 py-2">
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
                <button
                  class="btn bg-primary hover:bg-primary-focus dark:text-white"
                  type="button"
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
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 12h6"></path>
                    <path d="M12 9v6"></path>
                    <path
                      d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"
                    ></path>
                  </svg>
                </button>
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
            {{ p[field.key] }}
          </td>
          <td>
            <div class="flex space-x-2 items-center">
              <Link :href="'/product/' + p.hash">
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
              </Link>
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
      <tfoot
        class="
          text-xs text-gray-700
          uppercase
          bg-gray-50
          dark:bg-gray-700 dark:text-gray-400
          sticky
          bottom-0
          min-w-[100vh]
          z-2
        "
      >
        <tr>
          <td :colspan="fields.length + 1">
            <span
              class="
                flex
                flex-wrap
                space-y-3
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