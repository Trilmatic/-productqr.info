<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import PricingTables from "@/Components/PricingTables.vue";
import "@stripe/stripe-js";
import { loadStripe } from "@stripe/stripe-js/pure";
const props = defineProps({
    plan: Object,
    intent: Object,
    stripe_key: String,
    locale: String,
    billing_details: Object,
});

const stripe = ref(null);
const elements = ref(null);
const billing_details_new = ref(null);

const annual = computed(() => {
    return props.plan.slug.includes("yearly");
});

const step = ref(1);

const loadningAdress = ref(true);

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
    stripe.value = await loadStripe(props.stripe_key, { locale: locale });
    const secret = props.intent.client_secret;
    elements.value = stripe.value.elements({
        secret,
        appearance,
    });
    const cardElement = elements.value.create("card");
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
    const cardButton = document.getElementById("card-button");
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount("#card-element");
    addressElement.mount("#address-element");

    cardElement.addEventListener("change", function (event) {
        var displayError = document.getElementById("card-errors");
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    });

    var form = document.getElementById("payment-form");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        stripe.value
            .handleCardSetup(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                },
            })
            .then(function (result) {
                console.log(result);
                if (result.error) {
                    var errorElement = document.getElementById("card-errors");
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    stripeTokenHandler(result.setupIntent.payment_method);
                }
            });
    });

    loadningAdress.value = false;
}

// Submit the form with the token ID.
function stripeTokenHandler(paymentMethod) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById("payment-form");
    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "paymentMethod");
    hiddenInput.setAttribute("value", paymentMethod);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}

const handleNextStep = async () => {
    const addressElement = elements.value.getElement("address");

    const { complete, value } = await addressElement.getValue();

    billing_details_new.value = value;

    if (complete) {
        loadningAdress.value = true;
        Inertia.post(
            "/user/billing-details",
            {
                ...billing_details_new.value.address,
                name: billing_details_new.value.name,
            },
            {
                onSuccess: () => {
                    step.value = 2;
                    loadningAdress.value = false;
                },
            }
        );
    }
};

onMounted(() => {
    initStripe();
});
</script>

<template>
    <Head title="About us" />
    <AppLayout>
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
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <div
                        class="bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
                    >
                        <div class="p-6">
                            <div
                                class="font-cabinet-grotesk text-xl font-bold mb-1 text-gray-600 dark:text-gray-400"
                            >
                                <span>{{ plan.name }}</span>
                            </div>
                            <div
                                class="font-cabinet-grotesk text-gray-900 dark:text-gray-100 font-bold inline-flex items-baseline mb-2"
                            >
                                <span class="text-3xl">€</span>
                                <span class="text-5xl" v-if="plan.price">{{
                                    plan.price
                                }}</span>
                                <span v-if="annual">/year</span>
                                <span v-else>/mo</span>
                            </div>
                        </div>

                        <div
                            class="bg-gray-300 dark:bg-gray-600 p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center"
                            :class="
                                step === 2
                                    ? 'hover:bg-gray-400 hover:dark:bg-gray-500 hover:cursor-pointer'
                                    : ''
                            "
                            @click="step = 1"
                        >
                            <p class="text-3xl">Billing information</p>
                            <span v-show="step === 2" class="text-success"
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-circle-check"
                                    width="32"
                                    height="32"
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
                                    <path d="M9 12l2 2l4 -4"></path></svg
                            ></span>
                        </div>
                        <div
                            class="p-6 min-h-[25rem] relative"
                            v-show="step === 1"
                        >
                            <div
                                role="status"
                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                v-show="loadningAdress"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-20 h-20 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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
                            <form
                                @submit.prevent
                                id="address-form"
                                v-show="!loadningAdress"
                            >
                                <div id="address-element" class="mb-4">
                                    <!-- Elements will create form elements here -->
                                </div>
                                <button
                                    type="button"
                                    @click="handleNextStep"
                                    class="btn bg-primary hover:bg-primary-focus"
                                >
                                    Continue
                                </button>
                            </form>
                        </div>
                        <div
                            class="bg-gray-300 dark:bg-gray-600 p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center"
                            :class="step === 1 ? 'rounded-b-lg' : ''"
                        >
                            <p class="text-3xl">Payment</p>
                        </div>
                        <div class="p-6" v-show="step === 2">
                            <form
                                @submit.prevent=""
                                id="payment-form"
                                class="w-full"
                            >
                                <div class="space-y-6">
                                    <div class="mb-8">
                                        <div
                                            class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-lg p-4"
                                        >
                                            <label for="font-medium">
                                                Enter your credit card
                                                information
                                            </label>
                                            <div
                                                class="p-4 h-12 bg-gray-50 rounded-lg mt-4"
                                            >
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div
                                            class="text-error"
                                            id="card-errors"
                                            role="alert"
                                        ></div>
                                        <input
                                            type="hidden"
                                            name="plan"
                                            :value="plan.id"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <button
                                        id="card-button"
                                        class="btn bg-secondary hover:bg-secondary-focus"
                                        type="submit"
                                        :data-secret="intent.client_secret"
                                    >
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
