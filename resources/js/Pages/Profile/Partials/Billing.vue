<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, reactive, onMounted, nextTick } from "vue";
import "@stripe/stripe-js";
import { loadStripe } from "@stripe/stripe-js/pure";
import ActionSection from "@/Components/ActionSection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import WarningButton from "@/Components/WarningButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import { router } from "@inertiajs/vue3";

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
const name_on_card = ref(null);
const name_on_card_error = ref(false);
const billing_details_new = ref(null);
const card_element = ref(null);
const showUpdatePayment = ref(false);
const paymentMethodSubmiting = ref(false);

const closeModal = () => {
    showUpdatePayment.value = false;
};

const handleBillingsSubmit = async () => {
    const addressElement = elements.value.getElement("address");
    const { complete, value } = await addressElement.getValue();
    billing_details_new.value = value;

    if (complete) {
        router.post(
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
        router.post("/user/payment-method/delete", {
            payment_method: props.payment_method.id,
        });
    }
}

function updateNameOnCard(event) {
    name_on_card.value = event.target.value;
    if (!name_on_card.value) {
        name_on_card_error.value = true;
    } else name_on_card_error.value = false;
}

function cancelSubscription() {
    if (confirm("Are you sure you want to cancel your subscription?")) {
        router.delete("/user/subscribtion/cancel-subscription");
    }
}

function updatePaymentMethod() {
    if (!name_on_card.value) return;
    paymentMethodSubmiting.value = true;
    var billing = {};
    if (props.billing_details)
        billing = {
            name: name_on_card.value,
        };

    const secret = props.intent.client_secret;
    stripe.value
        .handleCardSetup(secret, card_element.value, {
            payment_method_data: {
                billing_details: billing,
            },
        })
        .then(function (result) {
            if (result.error) {
                paymentMethodSubmiting.value = false;
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                router.post(
                    "/user/payment-method/update",
                    {
                        payment_method: result.setupIntent.payment_method,
                    },
                    {
                        onSuccess: () => {
                            paymentMethodSubmiting.value = false;
                            showUpdatePayment.value = false;
                        },
                    }
                );
            }
        });
}

async function openUpdatePaymentModal() {
    showUpdatePayment.value = true;
    await nextTick();
    initCard();
}

function initCard() {
    if (!card_element.value) {
        card_element.value = elements.value.create("card");
    }
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
                <div
                    class="font-cabinet-grotesk text-2xl font-bold mb-1 text-gray-600 dark:text-gray-400 uppercase"
                >
                    {{
                        subscription.name
                            .replace("-yearly", "")
                            .replace("-monthly", "")
                    }}
                </div>
                <div class="text-gray-700 dark:text-gray-300 mb-6">
                    <p class="mb-2">
                        Switch you subscription to any other plan or cancel it
                        at any time. The changes for new subscription will be
                        charged immediately.
                        <span class="text-warning"
                            >You will be discounted based on remaining time from
                            previous subscription.</span
                        >
                    </p>
                    <div v-if="subscription.ends_at">
                        <p class="font-bold text-error">
                            <span>Ends at - </span>
                            <span>{{
                                new Date(
                                    subscription.ends_at
                                ).toLocaleDateString("en-GB")
                            }}</span>
                        </p>
                        <div class="mt-4">
                            <Link
                                class="btn bg-secondary hover:bg-secondary-focus"
                                href="/user/payments"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-file-invoice"
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
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path
                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"
                                    ></path>
                                    <line x1="9" y1="7" x2="10" y2="7"></line>
                                    <line x1="9" y1="13" x2="15" y2="13"></line>
                                    <line
                                        x1="13"
                                        y1="17"
                                        x2="15"
                                        y2="17"
                                    ></line>
                                </svg>
                                Payments
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4" v-if="!subscription.ends_at">
                    <Link
                        class="btn bg-primary hover:bg-primary-focus"
                        href="/user/subscribtion/change"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-arrows-exchange"
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
                            <path d="M7 10h14l-4 -4"></path>
                            <path d="M17 14h-14l4 4"></path>
                        </svg>
                        Change plan
                    </Link>
                    <Link
                        class="btn bg-secondary hover:bg-secondary-focus"
                        href="/user/payments"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-file-invoice"
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
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path
                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"
                            ></path>
                            <line x1="9" y1="7" x2="10" y2="7"></line>
                            <line x1="9" y1="13" x2="15" y2="13"></line>
                            <line x1="13" y1="17" x2="15" y2="17"></line>
                        </svg>
                        Payments
                    </Link>
                    <button
                        type="button"
                        class="btn text-gray-500 hover:bg-gray-100 border border-gray-200 over:text-gray-900 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600"
                        @click="cancelSubscription"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-clock-cancel"
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
                            <circle cx="19" cy="19" r="3"></circle>
                            <path d="M17 21l4 -4"></path>
                            <path
                                d="M20.995 12.3a9 9 0 1 0 -8.683 8.694"
                            ></path>
                            <path d="M12 7v5l2 2"></path>
                        </svg>
                        Cancel subscription
                    </button>
                </div>
            </div>
            <div v-else>
                <div
                    class="font-cabinet-grotesk text-2xl font-bold mb-1 text-gray-600 dark:text-gray-400 uppercase"
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
                <div class="mb-6" v-if="!subscription && !billing_details">
                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                        No payment method added.
                    </p>
                    <div
                        class="rounded-lg bg-primary-focus font-bold text-white p-4 mb-4"
                    >
                        <p>
                            No subscription activated please consider
                            subscribing to our services.
                        </p>
                    </div>
                    <a
                        href="/subscriptions"
                        class="btn bg-primary hover:bg-primary-focus mb-2"
                    >
                        Subscribe
                    </a>
                </div>
                <div
                    class="text-gray-700 dark:text-gray-300 mb-6"
                    v-else-if="subscription && !subscription.ends_at"
                >
                    <div
                        class="rounded-lg bg-error-focus text-white p-4 mb-4 font-bold"
                    >
                        <p>
                            You have subscription active, but no payment method
                            added. Please add an payment method.
                        </p>
                    </div>
                    <button
                        type="button"
                        class="btn bg-primary hover:bg-primary-focus mb-2"
                        @click="openUpdatePaymentModal"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-cards"
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
                                d="M3.604 7.197l7.138 -3.109a0.96 .96 0 0 1 1.27 .527l4.924 11.902a1.004 1.004 0 0 1 -.514 1.304l-7.137 3.109a0.96 .96 0 0 1 -1.271 -.527l-4.924 -11.903a1.005 1.005 0 0 1 .514 -1.304z"
                            ></path>
                            <path d="M15 4h1a1 1 0 0 1 1 1v3.5"></path>
                            <path
                                d="M20 6c.264 .112 .52 .217 .768 .315a1 1 0 0 1 .53 1.311l-2.298 5.374"
                            ></path>
                        </svg>
                        Add
                    </button>
                </div>
                <div v-else>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                        No payment method added.
                    </p>
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
                                        <div class="mb-2">
                                            <label> Name on card </label>
                                            <input
                                                class="bg-gray-50 text-gray-700 rounded-lg w-full p-3 outline-0 focus:outline-0 focus:ring-0"
                                                type="text"
                                                id="name-on-card"
                                                @change="updateNameOnCard"
                                                :class="
                                                    name_on_card_error
                                                        ? 'border-error focus:border-error'
                                                        : 'focus:border-transparent'
                                                "
                                            />
                                        </div>

                                        <label>
                                            Enter your credit card information
                                        </label>

                                        <div
                                            class="p-4 h-12 bg-gray-50 rounded-lg"
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
                    <div class="flex" v-show="!paymentMethodSubmiting">
                        <WarningButton @click="closeModal">
                            Cancel
                        </WarningButton>
                        <PrimaryButton
                            class="ml-3"
                            @click="updatePaymentMethod"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-credit-card"
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
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="3"
                                ></rect>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <line x1="7" y1="15" x2="7.01" y2="15"></line>
                                <line x1="11" y1="15" x2="13" y2="15"></line>
                            </svg>
                            Add payment method
                        </PrimaryButton>
                    </div>
                    <div class="flex" v-show="paymentMethodSubmiting">
                        <div role="status" class="">
                            <svg
                                aria-hidden="true"
                                class="w-10 h-10 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill"
                                />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
