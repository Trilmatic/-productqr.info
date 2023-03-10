<script setup>
import { onMounted, ref, reactive, defineExpose } from "vue";
const opened = ref(false);
const sidebar = ref(null);
const props = defineProps({
    handleClickOutside: Boolean,
    btn: { type: Boolean, default: true },
    wide: { type: Boolean, default: false },
});
function clickHandler({ target }) {
    if (
        !sidebar.value ||
        !opened.value ||
        sidebar.value.contains(target) ||
        target.classList.contains("btn-edit")
    )
        return;
    opened.value = false;
}
function open() {
    opened.value = true;
}
function close() {
    opened.value = false;
}
function keyHandler({ keyCode }) {
    if (!opened.value || keyCode !== 27) return;
    opened.value = false;
}
onMounted(() => {
    if (props.handleClickOutside)
        document.addEventListener("click", clickHandler);
    document.addEventListener("keydown", keyHandler);
});

defineExpose({
    open,
    close,
});
</script>

<template>
    <div ref="sidebar">
        <button
            @click="
                opened = true;
                $emit('open-clicked');
            "
            v-show="btn"
        >
            <slot name="button"></slot>
        </button>
        <Transition name="slide-sidebar">
            <div
                class="fixed top-0 z-50 right-0 h-full shadow bg-white dark:bg-gray-800 pt-2"
                :class="wide ? 'w-96' : 'w-80'"
                v-show="opened"
            >
                <div class="p-2 flex justify-between items-center">
                    <h5
                        class="inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400 pl-2"
                    >
                        <slot name="title"></slot>
                    </h5>
                    <button
                        type="button"
                        @click="opened = false"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                        <span class="sr-only">Close menu</span>
                    </button>
                </div>
                <slot></slot>
            </div>
        </Transition>
    </div>
</template>
