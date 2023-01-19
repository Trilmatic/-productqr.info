<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Sidebar from "@/Components/Sidebar.vue";
const sidebarComponent = ref(null);
const props = defineProps({
    plan: Object,
});
function open() {
    sidebarComponent.value.open();
}
function close() {
    sidebarComponent.value.close();
}
defineExpose({
    open,
    close,
});
</script>
<template>
    <Sidebar
        ref="sidebarComponent"
        :handleClickOutside="false"
        :wide="true"
        :btn="false"
    >
        <template #title><span>Subscribe</span></template>
        <section class="px-4">
            <div
                class="w-full h-56 m-auto bg-red-100 rounded-xl relative text-white shadow-2xl transition-transform transform my-8"
            >
                <img
                    class="relative object-cover w-full h-full rounded-xl"
                    src="/images/card.png"
                />

                <form @submit.prevent="" class="w-full px-8 absolute top-8">
                    <div class="">
                        <p class="font-light">Name on card</p>
                        <input class="form-input w-full" type="text" />
                    </div>
                    <div class="pt-1">
                        <p class="font-light">Card Number</p>
                        <p class="font-medium tracking-more-wider">
                            4642 3489 9867 7632
                        </p>
                    </div>
                    <div class="pt-6 pr-6">
                        <div class="flex justify-between">
                            <div class="">
                                <p class="font-light text-xs">Valid</p>
                                <p class="font-medium tracking-wider text-sm">
                                    11/15
                                </p>
                            </div>
                            <div class="">
                                <p class="font-light text-xs text-xs">Expiry</p>
                                <p class="font-medium tracking-wider text-sm">
                                    03/25
                                </p>
                            </div>

                            <div class="">
                                <p class="font-light text-xs">CVV</p>
                                <p
                                    class="font-bold tracking-more-wider text-sm"
                                >
                                    ···
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </Sidebar>
</template>
