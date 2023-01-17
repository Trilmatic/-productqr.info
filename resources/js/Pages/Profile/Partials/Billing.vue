<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref, reactive, onMounted, nextTick } from "vue";
import "@stripe/stripe-js";
import { loadStripe } from "@stripe/stripe-js/pure";
import ActionSection from "@/Components/ActionSection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import WarningButton from "@/Components/WarningButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    subscription: Object,
    payment_method: Object,
    billing_details: Object,
    stripe_key: String,
    locale: String,
    intent: Object,
});

const stripe = ref(null);
const elements = ref(null);
const billing_details_new = ref(null);
const card_element = ref(null);
const showUpdatePayment = ref(false);

const closeModal = () => {
    showUpdatePayment.value = false;
};

const handleBillingsSubmit = async () => {
    const addressElement = elements.value.getElement("address");
    const { complete, value } = await addressElement.getValue();
    billing_details_new.value = value;

    if (complete) {
        Inertia.post(
            "/user/billing-details",
            {
                ...billing_details_new.value.address,
                name: billing_details_new.value.name,
            },
            {
                onSuccess: () => {},
            }
        );
    }
};

function deletePaymentMethod() {
    if (confirm("Are you sure you want to delete your payment method?")) {
        Inertia.delete("/user/payment-method/delete", {
            payment_method: props.payment_method.id,
        });
    }
}

function updatePaymentMethod() {
    const secret = props.intent.client_secret;
    stripe.value
        .handleCardSetup(secret, card_element.value, {
            payment_method_data: {
                //billing_details: billing_details.value,
            },
        })
        .then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                Inertia.post("/user/payment-method/update", {
                    payment_method: result.setupIntent.payment_method,
                });
            }
        });
}

async function openUpdatePaymentModal() {
    showUpdatePayment.value = true;
    await nextTick();
    initCard();
}

function initCard() {
    card_element.value = elements.value.create("card");
    card_element.value.mount("#card-element");
}

async function initStripe() {
    const dark =
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches;
    const appearance = {
        theme: dark ? "night" : "stripe",

        variables: {
            colorPrimary: "#3b82f6",
            colorBackground: dark ? "#374151" : "#f9fafb",
            colorDanger: "#ef4444",
        },
    };
    const locale = props.locale;
    const secret = props.intent.client_secret;
    stripe.value = await loadStripe(props.stripe_key, { locale: locale });
    elements.value = stripe.value.elements({
        secret,
        appearance,
    });
    var defaultValues = {};
    if (props.billing_details)
        defaultValues = {
            name: props.billing_details.name,
            address: {
                line1: props.billing_details.line1,
                line2: props.billing_details.line2,
                city: props.billing_details.city,
                state: props.billing_details.state,
                postal_code: props.billing_details.postal_code,
                country: props.billing_details.country,
            },
        };
    const addressElement = elements.value.create("address", {
        mode: "billing",
        defaultValues: defaultValues,
    });

    addressElement.mount("#address-element");
}

onMounted(() => {
    initStripe();
});
</script>
<template>
    <ActionSection>
        <template #title> Subscription </template>
        <template #description></template>
        <template #content>
            <div v-if="subscription">
                {{ subscription }}
            </div>
            <div v-else>
                <div
                    class="font-cabinet-grotesk text-xl font-bold mb-1 text-gray-600 dark:text-gray-400"
                >
                    Free
                </div>
                <div class="text-gray-700 dark:text-gray-300 mb-6">
                    You are not subscribed to any paid plans.
                </div>
                <Link
                    class="btn inline-flex items-center text-white bg-primary hover:bg-primary-focus group"
                    href="/subscriptions"
                >
                    Subscribe
                </Link>
            </div>
        </template>
    </ActionSection>
    <ActionSection class="mt-6">
        <template #title> Billing information </template>
        <template #description></template>
        <template #content>
            <form @submit.prevent id="address-form">
                <div id="address-element" class="mb-4">
                    <!-- Elements will create form elements here -->
                </div>
                <button
                    type="button"
                    @click="handleBillingsSubmit"
                    class="btn bg-primary hover:bg-primary-focus"
                >
                    Save
                </button>
            </form>
        </template>
    </ActionSection>
    <ActionSection class="mt-6">
        <template #title> Payment method </template>
        <template #description></template>
        <template #content>
            <div v-if="payment_method">
                <div
                    class="w-96 h-50 rounded-xl relative text-white shadow-2xl transition-transform transform"
                >
                    <img
                        class="relative object-cover w-full h-full rounded-xl"
                        src="/images/card.png"
                    />

                    <div class="w-full px-8 absolute top-8">
                        <div class="flex justify-between">
                            <div class="">
                                <p class="font-light">Name</p>
                                <p class="font-medium tracking-widest">
                                    {{ payment_method.billing_details.name }}
                                </p>
                            </div>
                            <p class="uppercase font-bold">
                                {{ payment_method.card.brand }}
                            </p>
                        </div>
                        <div class="pt-1">
                            <p class="font-light">Card Number</p>
                            <div
                                class="font-medium tracking-wider flex items-center space-x-3"
                            >
                                <div class="flex space-x-1">
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                </div>
                                <div class="flex space-x-1">
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                </div>
                                <div class="flex space-x-1">
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                    <span
                                        class="block rounded-full w-2 h-2 bg-white"
                                    />
                                </div>
                                <p>{{ payment_method.card.last4 }}</p>
                            </div>
                        </div>
                        <div class="pt-6 pr-6"></div>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap space-x-4">
                    <button
                        type="button"
                        class="btn bg-primary hover:bg-primary-focus mb-2"
                        @click="openUpdatePaymentModal"
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
                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                        </svg>
                        Update
                    </button>
                    <button
                        type="button"
                        class="btn bg-error hover:bg-error-focus mb-2"
                        @click="deletePaymentMethod"
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
                            <line x1="4" y1="7" x2="20" y2="7"></line>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                            <path
                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                            ></path>
                            <path
                                d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                            ></path>
                        </svg>
                        Delete
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="text-gray-700 dark:text-gray-300 mb-6">
                    No payment method added.
                </div>
            </div>

            <DialogModal :show="showUpdatePayment" @close="closeModal">
                <template #title> Payment Method </template>

                <template #content>
                    <div class="mt-4">
                        <form @submit.prevent="" id="card-form" class="w-full">
                            <div class="space-y-6">
                                <div class="mb-8">
                                    <div class="">
                                        <label for="font-medium">
                                            Enter your credit card information
                                        </label>
                                        <div
                                            class="p-4 h-12 bg-gray-50 rounded-lg mt-4"
                                        >
                                            <div id="card-element"></div>
                                        </div>
                                    </div>
                                    <div
                                        class="text-error"
                                        id="card-errors"
                                        role="alert"
                                    ></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </template>

                <template #footer>
                    <WarningButton @click="closeModal"> Cancel </WarningButton>
                    <PrimaryButton class="ml-3" @click="updatePaymentMethod">
                        Update
                    </PrimaryButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
