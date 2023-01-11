<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
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
                            class="h1 font-cabinet-grotesk text-white mb-2"
                            data-aos="fade-up"
                        >
                            About us
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <div
                        class="max-w-3xl mx-auto text-center pb-6 md:pb-8 mb-6 border-b border-gray-200 dark:border-gray-800"
                    >
                        <h2
                            class="h4 font-cabinet-grotesk"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            Not everybody can read the small format product
                            information or guides, but everybody should have
                            access to it.
                        </h2>
                    </div>
                    <p
                        class="text-lg md:text-xl text-white text-left text-opacity-80 mb-8"
                    >
                        We want to make products more accessible and
                        understandable for customers all around the world. The
                        goal of our services is to be easily setup, simple, but
                        very effective. We are auto generating thousands of QR
                        codes to just make customer care better.
                    </p>
                    <div
                        class="max-w-3xl mx-auto text-center pb-6 md:pb-8 mb-6 border-b border-gray-200 dark:border-gray-800"
                    >
                        <h2 class="text-xl font-cabinet-grotesk">
                            But why would you need to use productqr when you
                            already have a company website?
                        </h2>
                    </div>
                    <div
                        class="max-w-xl mx-auto md:max-w-none flex flex-col md:flex-row md:space-x-8 lg:space-x-16 xl:space-x-20 space-y-8 space-y-reverse md:space-y-0"
                    >
                        <!-- Content -->
                        <div
                            class="md:w-7/12 lg:w-1/2 order-1 md:order-none aos-init aos-animate"
                            data-aos="fade-up"
                        >
                            <!-- Content #1 -->
                            <ul class="inline-flex flex-col space-y-6">
                                <li class="flex items-start">
                                    <svg
                                        class="w-3 h-3 fill-current text-blue-500 mt-1.5 mr-3 shrink-0"
                                        viewBox="0 0 12 12"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                        ></path>
                                    </svg>
                                    <div>
                                        <div
                                            class="text-gray-500"
                                            data-aos="fade-up"
                                            data-aos-delay="100"
                                        >
                                            We will autogenerate QR code with
                                            info icon so it is very clear that
                                            by scanning the QR code on product
                                            you will access information about
                                            the product online.
                                        </div>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <svg
                                        class="w-3 h-3 fill-current text-blue-500 mt-1.5 mr-3 shrink-0"
                                        viewBox="0 0 12 12"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                        ></path>
                                    </svg>
                                    <div>
                                        <div
                                            class="text-gray-500"
                                            data-aos="fade-up"
                                            data-aos-delay="125"
                                        >
                                            We autodetect any ISO language that
                                            will come to our website, if you
                                            don't have the product localized in
                                            that language it will select the
                                            first of the most spoken languages
                                            on earth that you have localized.
                                        </div>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <svg
                                        class="w-3 h-3 fill-current text-blue-500 mt-1.5 mr-3 shrink-0"
                                        viewBox="0 0 12 12"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                        ></path>
                                    </svg>
                                    <div>
                                        <div
                                            class="text-gray-500"
                                            data-aos="fade-up"
                                            data-aos-delay="150"
                                        >
                                            Even if you don't need to localize
                                            the language it will help customers
                                            with worse vision to easily access
                                            the product information.
                                        </div>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <svg
                                        class="w-3 h-3 fill-current text-blue-500 mt-1.5 mr-3 shrink-0"
                                        viewBox="0 0 12 12"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                        ></path>
                                    </svg>
                                    <div>
                                        <div
                                            class="text-gray-500"
                                            data-aos="fade-up"
                                            data-aos-delay="175"
                                        >
                                            Your website's SEO will not be hurt
                                            by the locales that might be
                                            unnecessary for the full website.
                                        </div>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <svg
                                        class="w-3 h-3 fill-current text-blue-500 mt-1.5 mr-3 shrink-0"
                                        viewBox="0 0 12 12"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                        ></path>
                                    </svg>
                                    <div>
                                        <div
                                            class="text-gray-500"
                                            data-aos="fade-up"
                                            data-aos-delay="200"
                                        >
                                            You will be able to improve customer
                                            experience, which will positively
                                            impact your customers view of the
                                            products and gets you ahead of
                                            competitors.
                                        </div>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <svg
                                        class="w-3 h-3 fill-current text-blue-500 mt-1.5 mr-3 shrink-0"
                                        viewBox="0 0 12 12"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z"
                                        ></path>
                                    </svg>
                                    <div>
                                        <div
                                            class="text-gray-500"
                                            data-aos="fade-up"
                                            data-aos-delay="225"
                                        >
                                            Our core code is publicly visible
                                            (all rights are reserved), so
                                            anybody can check we are not hiding
                                            any shady practices.
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Image -->
                        <div
                            class="md:w-5/12 lg:w-1/2 aos-init aos-animate"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            <img
                                class="mx-auto md:max-w-none"
                                src="/images/features-01.png"
                                width="540"
                                height="405"
                                alt="Features"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
