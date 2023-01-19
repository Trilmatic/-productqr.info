<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted, ref, nextTick, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import TomSelect from "tom-select/dist/js/tom-select.complete.min";
import Quill from "quill/dist/quill.min";
const props = defineProps({
    product: Object,
    languages: Array,
    info: Object,
});
const editors = ref([]);
const sections = ref(props.info.sections);
const sections_sort = computed(() => {
    return sections.value.sort(function (a, b) {
        return a.sort - b.sort;
    });
});
async function initTextarea() {
    let elements = document.querySelectorAll(".editor");
    elements.forEach((el, index) => {
        if (!editors.value[index])
            editors.value[index] = new Quill(el, {
                modules: {
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        ["blockquote", "code-block"],
                        [{ list: "ordered" }, { list: "bullet" }],
                        [{ script: "sub" }, { script: "super" }],
                        [{ indent: "-1" }, { indent: "+1" }],
                        [{ direction: "rtl" }],
                        [{ size: ["small", false, "large", "huge"] }],
                        [{ header: [1, 2, 3, 4, 5, 6, false] }],
                        [{ color: [] }, { background: [] }],
                        [{ direction: "rtl" }],
                        [{ font: [] }],
                        [{ align: [] }],
                        ["link", "video", "formula"],
                        ["clean"],
                    ],
                },
                theme: "snow",
            });
    });
}
async function addSection() {
    sections.value.push({
        title: null,
        content: "",
        hash: Date.now(),
        sort: sections.value.length,
    });
    await nextTick();
    initTextarea();
}
async function initSelects() {
    let perpage = document.getElementById("language");
    if (perpage.tomselect) return;
    let settings = {};
    new TomSelect(perpage, settings);
}
async function loadInputData() {
    sections.value.forEach((el) => {
        let input = document.getElementById("title-" + el.hash);
        if (input) input.value = el.title;
    });
}
function removeSection(section, index) {
    if (section.id) {
        router.delete(
            "/product/" +
                props.product.hash +
                "/info/section/" +
                section.hash +
                "/delete"
        );
    }
    sections.value.splice(index, 1);
    editors.value.splice(index, 1);
}
function moveUp(section, index) {
    if (index === 0) return;
    sections.value[index - 1].sort = section.sort;
    section.sort--;
}
function moveDown(section, index) {
    if (index === sections.length - 1) return;
    sections.value[index + 1].sort = section.sort;
    section.sort++;
}
function submit() {
    let language_id = document.getElementById("language").value;
    editors.value.forEach((editor, index) => {
        sections.value[index].content = editor.root.innerHTML;
    });
    router.put(
        "/product/" +
            props.product.hash +
            "/info/" +
            props.info.hash +
            "/update",
        {
            language_id: language_id,
            sections: sections.value,
        }
    );
}
onMounted(() => {
    initSelects();
    initTextarea();
    loadInputData();
});
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex mb-2">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
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
                        <li>
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
                                <Link
                                    :href="'/product/' + product.hash + '/info'"
                                    class="ml-1 text-sm font-medium text-primary hover:text-primary-focus"
                                    >{{ product.hash }}</Link
                                >
                            </div>
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
                                    ><svg
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
                                        ></line></svg
                                ></span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <form @submit.prevent="submit" class="space-y-2">
                    <div>
                        <label class="block text-sm font-medium mb-1" for="name"
                            >Language</label
                        >
                        <select id="language">
                            <option value=""></option>
                            <option
                                v-for="lang in languages"
                                :key="lang.id"
                                :value="lang.id"
                                :selected="info.language_id === lang.id"
                            >
                                {{ lang.name }} ({{ lang.native_name }})
                            </option>
                        </select>
                        <label
                            v-show="$page.props.errors.language_id"
                            class="block text-sm font-medium mb-1 text-error"
                            for="name"
                            >Language is required</label
                        >
                    </div>
                    <section>
                        <TransitionGroup name="list" tag="ul" class="relative">
                            <li
                                class="py-4 box-border w-full"
                                v-for="(section, i) in sections_sort"
                                :key="section.hash"
                            >
                                <div class="flex justify-end space-x-2">
                                    <button
                                        class="btn bg-warning hover:bg-warning-focus text-white"
                                        type="button"
                                        @click="moveUp(section, i)"
                                        v-if="section.sort != 0"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-big-up-line"
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
                                                d="M9 12h-3.586a1 1 0 0 1 -.707 -1.707l6.586 -6.586a1 1 0 0 1 1.414 0l6.586 6.586a1 1 0 0 1 -.707 1.707h-3.586v6h-6v-6z"
                                            ></path>
                                            <path d="M9 21h6"></path>
                                        </svg>
                                    </button>
                                    <button
                                        class="btn bg-warning hover:bg-warning-focus text-white"
                                        type="button"
                                        @click="moveDown(section, i)"
                                        v-if="
                                            section.sort < sections.length - 1
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-big-down-line"
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
                                                d="M15 12h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-6h6v6z"
                                            ></path>
                                            <path d="M15 3h-6"></path>
                                        </svg>
                                    </button>
                                    <button
                                        class="btn bg-error hover:bg-error-focus text-white"
                                        type="button"
                                        @click="removeSection(section, i)"
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
                                <div class="mb-4">
                                    <label
                                        class="block text-sm font-medium mb-1"
                                        :for="'title-' + section.hash"
                                        >Title</label
                                    >
                                    <input
                                        :id="'title-' + section.hash"
                                        type="text"
                                        class="form-input w-full"
                                        :class="{
                                            error:
                                                $page.props.errors &&
                                                $page.props.errors[
                                                    'sections.' + i + '.title'
                                                ],
                                        }"
                                        @change="
                                            sections[i].title =
                                                $event.target.value
                                        "
                                    />
                                </div>
                                <div
                                    class="editor"
                                    v-html="section.content"
                                ></div>
                            </li>
                        </TransitionGroup>
                        <div class="py-3 flex justify-center">
                            <button
                                class="btn bg-secondary hover:bg-secondary-focus"
                                type="button"
                                @click="addSection()"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-circle-plus"
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
                                    <line x1="9" y1="12" x2="15" y2="12"></line>
                                    <line x1="12" y1="9" x2="12" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                    </section>
                    <button
                        class="btn inline-flex items-center text-white bg-primary hover:bg-primary-focus group"
                        type="submit"
                    >
                        <span>Edit</span>
                        <span
                            class="tracking-normal text-gray-900 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-2"
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
                </form>
            </div>
        </div>
    </AppLayout>
</template>
