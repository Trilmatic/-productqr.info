<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ContentIcon from "@/Components/ContentIcon.vue";
import { reactive, onMounted, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";
const props = defineProps({
    product: Object,
    info: Object,
});
const qropened = ref(false);
function deleteRecord(hash) {
    if (confirm("Are you sure you want to delete?")) {
        router.delete(
            "/product/" + props.product.hash + "/info/" + hash + "/delete"
        );
    }
}
</script>
<template>
    <Head title="Info" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex justify-center items-center relative"
                v-if="
                    product.product_infos.length === 0 &&
                    $page.props.user &&
                    $page.props.user.id === product.user_id
                "
            >
                <ContentIcon />
                <Link
                    class="absolute p-4 rounded-full bg-secondary hover:bg-secondary-focus"
                    :href="'/product/' + product.hash + '/info/create'"
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-circle-plus stroke-gray-700"
                        width="60"
                        height="60"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"
                        ></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="9" y1="12" x2="15" y2="12"></line>
                        <line x1="12" y1="9" x2="12" y2="15"></line></svg
                ></Link>
            </div>
            <div v-else class="relative">
                <header
                    class="flex items-center justify-between flex-wrap lg:flex-nowrap"
                >
                    <nav class="flex mb-2">
                        <ol
                            class="inline-flex list-none items-center space-x-1 md:space-x-3"
                        >
                            <li class="inline-flex items-center">
                                <Link
                                    href="/product"
                                    class="inline-flex items-center text-sm font-medium text-primary hover:text-primary-focus"
                                >
                                    <img
                                        class="w-10 h-10 rounded-full"
                                        :src="product.owner.profile_photo_url"
                                        :alt="product.owner.name"
                                    />
                                </Link>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg
                                        class="w-6 h-6 text-gray-400"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                    <span
                                        class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400"
                                    >
                                        {{ product.hash }}</span
                                    >
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <div class="flex items-center justify-end">
                        <button
                            type="button"
                            class="text-white bg-primary hover:bg-primary-focus font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none inline-flex space-x-1"
                            @click="qropened = true"
                        >
                            <span>QR code</span>
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
                                <line x1="7" y1="17" x2="7" y2="17.01"></line>
                                <rect
                                    x="14"
                                    y="4"
                                    width="6"
                                    height="6"
                                    rx="1"
                                ></rect>
                                <line x1="7" y1="7" x2="7" y2="7.01"></line>
                                <rect
                                    x="4"
                                    y="14"
                                    width="6"
                                    height="6"
                                    rx="1"
                                ></rect>
                                <line x1="17" y1="7" x2="17" y2="7.01"></line>
                                <line x1="14" y1="14" x2="17" y2="14"></line>
                                <line x1="20" y1="14" x2="20" y2="14.01"></line>
                                <line x1="14" y1="14" x2="14" y2="17"></line>
                                <line x1="14" y1="20" x2="17" y2="20"></line>
                                <line x1="17" y1="17" x2="20" y2="17"></line>
                                <line x1="20" y1="17" x2="20" y2="20"></line>
                            </svg>
                        </button>
                        <Sidebar :handleClickOutside="true">
                            <template #button>
                                <span
                                    class="text-white bg-secondary hover:bg-secondary-focus font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none inline-flex space-x-1"
                                >
                                    <span>Languages</span>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-world"
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
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <line
                                            x1="3.6"
                                            y1="9"
                                            x2="20.4"
                                            y2="9"
                                        ></line>
                                        <line
                                            x1="3.6"
                                            y1="15"
                                            x2="20.4"
                                            y2="15"
                                        ></line>
                                        <path
                                            d="M11.5 3a17 17 0 0 0 0 18"
                                        ></path>
                                        <path
                                            d="M12.5 3a17 17 0 0 1 0 18"
                                        ></path>
                                    </svg>
                                </span>
                            </template>
                            <template #title><span>Languages</span></template>
                            <div
                                class="flex justify-center py-2"
                                v-if="
                                    $page.props.user &&
                                    product.user_id === $page.props.user.id
                                "
                            >
                                <Link
                                    class="bg-primary hover:bg-primary-focus font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none inline-flex space-x-1"
                                    :href="
                                        '/product/' +
                                        product.hash +
                                        '/info/create'
                                    "
                                    ><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-circle-plus stroke-white"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            stroke="none"
                                            d="M0 0h24v24H0z"
                                            fill="none"
                                        ></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <line
                                            x1="9"
                                            y1="12"
                                            x2="15"
                                            y2="12"
                                        ></line>
                                        <line
                                            x1="12"
                                            y1="9"
                                            x2="12"
                                            y2="15"
                                        ></line></svg
                                ></Link>
                            </div>
                            <ul
                                class="text-sm font-medium text-gray-900 dark:text-white px-4 mt-4 list-none"
                            >
                                <li
                                    v-for="i in product.product_infos"
                                    :key="i"
                                    class="w-full border-b border-gray-200 cursor-pointer focus:outline-none focus:ring-2 dark:border-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white flex items-center"
                                    :class="
                                        info.hash === i.hash
                                            ? 'bg-primary text-white hover:bg-primary-focus'
                                            : 'hover:bg-gray-100 dark:hover:bg-gray-600'
                                    "
                                >
                                    <Link
                                        class="w-full py-2 pl-4"
                                        :href="
                                            '/product/' +
                                            product.hash +
                                            '/info/?hash=' +
                                            i.hash
                                        "
                                        >{{ i.language.native_name }} ({{
                                            i.language.name
                                        }})</Link
                                    ><Link
                                        class="py-2"
                                        v-if="
                                            $page.props.user &&
                                            i.user_id === $page.props.user.id
                                        "
                                        :href="
                                            '/product/' +
                                            product.hash +
                                            '/info/' +
                                            i.hash +
                                            '/edit'
                                        "
                                    >
                                        <div
                                            class="p-2 hover:bg-warning rounded-lg"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-pencil"
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
                                                    d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"
                                                ></path>
                                                <line
                                                    x1="13.5"
                                                    y1="6.5"
                                                    x2="17.5"
                                                    y2="10.5"
                                                ></line>
                                            </svg></div
                                    ></Link>
                                    <button
                                        type="button"
                                        @click="deleteRecord(i.hash)"
                                        class="hover:bg-error p-2 rounded-lg py-2 mr-2"
                                        v-if="
                                            $page.props.user &&
                                            i.user_id === $page.props.user.id
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
                                </li>
                            </ul>
                        </Sidebar>
                    </div>
                </header>
                <!-- Main Content -->
                <div class="flex flex-wrap md:flex-nowrap mt-8">
                    <aside class="w-full md:w-64 pb-8">
                        <div
                            class="px-3 py-4 overflow-y-auto rounded-lg bg-gray-50 dark:bg-gray-800 md:sticky md:top-0"
                        >
                            <ul class="space-y-2 list-none pl-0">
                                <li v-for="s in info.sections" :key="s.id">
                                    <a
                                        :href="'#section-' + s.hash"
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                                    >
                                        <span>{{ s.title }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <article class="py-2 pl-4 w-full" v-if="info">
                        <section
                            class="info-content mb-8 pb-4 border-b border-gray-200 dark:border-gray-800"
                            :id="'section-' + s.hash"
                            v-for="s in info.sections"
                            :key="s.id"
                        >
                            <h2>{{ s.title }}</h2>
                            <div v-html="s.content"></div>
                        </section>
                    </article>
                </div>
                <!-- QR modal -->
                <div
                    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full backdrop-blur min-h-screen"
                    v-show="qropened"
                >
                    <div
                        class="relative mx-auto w-full h-full max-w-lg md:h-auto"
                    >
                        <!-- Modal content -->
                        <div
                            class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                        >
                            <!-- Modal header -->
                            <div
                                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                            >
                                <h3
                                    class="text-xl font-semibold text-gray-900 dark:text-white"
                                >
                                    QR code
                                </h3>
                                <button
                                    type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    @click="qropened = false"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="w-5 h-5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <img
                                    class="mx-auto block"
                                    :src="product.qr_code"
                                    alt="QR code"
                                    id="qr-code"
                                />
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                            >
                                <a
                                    @click="qropened = false"
                                    type="button"
                                    class="btn text-white bg-primary hover:bg-primary-focus font-medium text-sm"
                                    :href="product.qr_code"
                                    download
                                >
                                    Download
                                </a>
                                <button
                                    type="button"
                                    class="btn text-gray-500 bg-white hover:bg-gray-100 border border-gray-200 text-sm font-medium hover:text-gray-900 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600"
                                    @click="qropened = false"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
