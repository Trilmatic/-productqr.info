<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PricingTables from "@/Components/PricingTables.vue";
import "@stripe/stripe-js";
import { loadStripe } from "@stripe/stripe-js/pure";
const props = defineProps({
    plan: Object,
    intent: Object,
    stripe_key: String,
});

async function initStripe() {
    var style = {
        base: {
            color: "#32325d",
            lineHeight: "18px",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4",
            },
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a",
        },
    };
    const stripe = await loadStripe(props.stripe_key);
    const elements = stripe.elements();
    const cardElement = elements.create("card", { style: style });
    const cardButton = document.getElementById("card-button");
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount("#card-element");

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

        stripe
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
}

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
                    <form @submit.prevent="" id="payment-form">
                        <div class="form-group">
                            <div class="card-header">
                                <label for="card-element">
                                    Enter your credit card information
                                </label>
                            </div>
                            <div class="card-body">
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <input
                                    type="hidden"
                                    name="plan"
                                    :value="plan.id"
                                />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button
                                id="card-button"
                                class="btn btn-dark"
                                type="submit"
                                :data-secret="intent.client_secret"
                            >
                                Pay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
