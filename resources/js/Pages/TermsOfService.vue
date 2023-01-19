<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <Head title="About us" />
    <AppLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden">
            <!-- Bg -->
            <div
                class="absolute inset-0 bg-blue-600 pointer-events-none -z-10"
                aria-hidden="true"
            ></div>

            <!-- Illustration -->
            <div
                class="absolute left-1/2 -translate-x-1/3 md:-translate-x-1/2 pointer-events-none -z-10"
                aria-hidden="true"
            >
                <object
                    type="image/svg+xml"
                    data="/images/hero-illustration.svg"
                    width="1440"
                    height="1214"
                ></object>
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="pt-28 pb-16 md:pt-40 md:pb-20">
                    <!-- Hero content -->
                    <div class="max-w-3xl mx-auto text-center">
                        <h1
                            class="h1 font-cabinet-grotesk text-black dark:text-white mb-4"
                        >
                            Terms of Service
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        last updated January 1st, 2023
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        These Terms of Service ("Terms", "Terms of Service")
                        govern your relationship with https://productqr.info
                        website (the "Service", the "Services") operated by
                        ProductQR ("us", "we", or "our").
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Please read these Terms and Conditions carefully before
                        using the Service.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Scope and use of the subscription
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        The subscription grants the Customer (being the legal
                        entity that has taken out the subscription) the right to
                        use ProductQR’s system and services with a range defined
                        by the subscription. The subscription may not be used by
                        other people or organizations.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        The subscription terms for the Services are accepted by
                        the Customer by registration on ProductQR website.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Subscriptions
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Some parts of the Service are billed on a subscription
                        basis ("Subscription(s)"). You will be billed in advance
                        on a recurring and periodic basis ("Billing Cycle").
                        Billing cycles are set either on a monthly or annual
                        basis, depending on the type of subscription plan you
                        select when purchasing a Subscription.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        At the end of each Billing Cycle, your Subscription will
                        automatically renew under the exact same conditions
                        unless you cancel it or ProductQR cancels it. You may
                        cancel your Subscription renewal either through your
                        online account management page or by contacting
                        ProductQR customer support team.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        A valid payment method, including credit card or PayPal,
                        is required to process the payment for your
                        Subscription. You shall provide ProductQR with accurate
                        and complete billing information including full name,
                        address, state, zip code, telephone number, and a valid
                        payment method information. By submitting such payment
                        information, you automatically authorize ProductQR to
                        charge all Subscription fees incurred through your
                        account to any such payment instruments. Our current
                        Payment Processor is Stripe, and your payments are
                        processed by Stripe in accordance with Stripe’s terms of
                        service and privacy policy.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Should automatic billing fail to occur for any reason,
                        ProductQR will issue an electronic invoice indicating
                        that you must proceed manually, within a certain
                        deadline date, with the full payment corresponding to
                        the billing period as indicated on the invoice.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Alternative to subscription
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Alternative to subscription is a free plan that offers
                        limited resources to the customer.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Fee Changes
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        ProductQR, in its sole discretion and at any time, may
                        modify the Subscription fees for the Subscriptions. Any
                        Subscription fee change will become effective at the end
                        of the then-current Billing Cycle.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        ProductQR will provide you with a reasonable prior
                        notice of any change in Subscription fees to give you an
                        opportunity to terminate your Subscription before such
                        change becomes effective.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Your continued use of the Service after the Subscription
                        fee change comes into effect constitutes your agreement
                        to pay the modified Subscription fee amount.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Refunds
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Certain refund requests for Subscriptions may be
                        considered by ProductQR on a case-by-case basis and
                        granted in sole discretion of ProductQR.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Content
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Our Service allows you to post, link, store, share and
                        otherwise make available certain information, text,
                        graphics, videos, or other material ("Content"). You are
                        responsible for the Content that you post to the
                        Service, including its legality, reliability, and
                        appropriateness.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        By posting Content to the Service, you grant us the
                        right and license to use, modify, perform, display,
                        reproduce, and distribute such Content on and through
                        the Service. You retain any and all of your rights to
                        any Content you submit, post or display on or through
                        the Service and you are responsible for protecting those
                        rights.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        You represent and warrant that: (i) the Content is yours
                        (you own it) or you have the right to use it and grant
                        us the rights and license as provided in these Terms,
                        and (ii) the posting of your Content on or through the
                        Service does not violate the privacy rights, publicity
                        rights, copyrights, contract rights or any other rights
                        of any person.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Accounts
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        When you create an account with us, you must provide us
                        information that is accurate, complete, and current at
                        all times. Failure to do so constitutes a breach of the
                        Terms, which may result in immediate termination of your
                        account on our Service.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        You are responsible for safeguarding the password that
                        you use to access the Service and for any activities or
                        actions under your password, whether your password is
                        with our Service or a third-party service.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        You agree not to disclose your password to any third
                        party. You must notify us immediately upon becoming
                        aware of any breach of security or unauthorized use of
                        your account.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Copyright Policy
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        We respect the intellectual property rights of others.
                        It is our policy to respond to any claim that Content
                        posted on the Service infringes the copyright or other
                        intellectual property infringement ("Infringement") of
                        any person.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        If you are a copyright owner, or authorized on behalf of
                        one, and you believe that the copyrighted work has been
                        copied in a way that constitutes copyright infringement
                        that is taking place through the Service, you must
                        submit your notice in writing to the attention of
                        "Copyright Infringement" of
                        <a
                            href="mailto:hello@productqr.info"
                            class="text-warning hover:text-warning-focus"
                            >hello@productqr.info</a
                        >
                        and include in your notice a detailed description of the
                        alleged Infringement.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        You may be held accountable for damages (including costs
                        and attorneys' fees) for misrepresenting that any
                        Content is infringing your copyright.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Links To Other Web Sites
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Our Service may contain links to third-party web sites
                        or services that are not owned or controlled by
                        ProductQR.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        ProductQR has no control over, and assumes no
                        responsibility for, the content, privacy policies, or
                        practices of any third party web sites or services. You
                        further acknowledge and agree that ProductQR shall not
                        be responsible or liable, directly or indirectly, for
                        any damage or loss caused or alleged to be caused by or
                        in connection with use of or reliance on any such
                        content, goods or services available on or through any
                        such web sites or services.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        We strongly advise you to read the Terms of Service and
                        privacy policies of any third-party web sites or
                        services that you visit.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Termination
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        We may terminate or suspend your account immediately,
                        without prior notice or liability, for any reason
                        whatsoever, including without limitation if you breach
                        the Terms.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Upon termination, your right to use the Service will
                        immediately cease. If you wish to terminate your
                        account, you may simply discontinue using the Service.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Limitation Of Liability
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        In no event shall ProductQR, nor its directors,
                        employees, partners, agents, suppliers, or affiliates,
                        be liable for any indirect, incidental, special,
                        consequential or punitive damages, including without
                        limitation, loss of profits, data, use, goodwill, or
                        other intangible losses, resulting from (i) your access
                        to or use of or inability to access or use the Service;
                        (ii) any conduct or content of any third party on the
                        Service; (iii) any content obtained from the Service;
                        and (iv) unauthorized access, use or alteration of your
                        transmissions or content, whether based on warranty,
                        contract, tort (including negligence) or any other legal
                        theory, whether or not we have been informed of the
                        possibility of such damage, and even if a remedy set
                        forth herein is found to have failed of its essential
                        purpose.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Disclaimer
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        Your use of the Service is at your sole risk. The
                        Service is provided on an "AS IS" and "AS AVAILABLE"
                        basis. The Service is provided without warranties of any
                        kind, whether express or implied, including, but not
                        limited to, implied warranties of merchantability,
                        fitness for a particular purpose, non-infringement or
                        course of performance.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        ProductQR its subsidiaries, affiliates, and its
                        licensors do not warrant that a) the Service will
                        function uninterrupted, secure or available at any
                        particular time or location; b) any errors or defects
                        will be corrected; c) the Service is free of viruses or
                        other harmful components; or d) the results of using the
                        Service will meet your requirements.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Marketing
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        ProductQR shall be entitled to refer to the Customer and
                        the Services provided in its marketing, including a
                        brief description of such services.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        System changes and feature updates
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        ProductQR informs its users on the service about system
                        changes, feature updates, and other technical news by
                        e-mail.
                    </p>
                    <h3 class="h3 font-cabinet-grotesk mb-4 uppercase">
                        Changes
                    </h3>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        We reserve the right, at our sole discretion, to modify
                        or replace these Terms at any time. If a revision is
                        material we will try to provide at least 30 days notice
                        prior to any new terms taking effect. What constitutes a
                        material change will be determined at our sole
                        discretion.
                    </p>
                    <p
                        class="text-lg md:text-xl text-black dark:text-white text-left text-opacity-80 mb-4"
                    >
                        By continuing to access or use our Service after those
                        revisions become effective, you agree to be bound by the
                        revised terms. If you do not agree to the new terms,
                        please stop using the Service.
                    </p>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
