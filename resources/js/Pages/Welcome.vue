<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PricingTables from "@/Components/PricingTables.vue";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
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
                            {{
                                __(
                                    "Allow your customers to understand your products."
                                )
                            }}
                        </h1>
                        <p
                            class="text-lg md:text-xl text-white text-opacity-80 mb-8"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            Let you products be understandable around the globe.
                            With our service you can do that with ease no matter
                            in what hands your products end up.
                        </p>
                        <div data-aos="fade-up" data-aos-delay="200">
                            <Link
                                class="btn inline-flex items-center text-white bg-gray-900 hover:bg-gray-800 group"
                                href="/register"
                            >
                                Register for free
                                <span
                                    class="tracking-normal text-blue-500 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-2"
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
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Explainer -->
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <!-- Section header -->
                    <div class="max-w-3xl mx-auto text-center pb-12 md:pb-16">
                        <h2 class="h2 font-cabinet-grotesk">
                            We have use for anybody, no matter if you are a
                            small company or a multinational corporate.
                        </h2>
                    </div>

                    <!-- Section image -->
                    <div
                        class="flex justify-center pb-12 md:pb-16"
                        x-data="{ modalExpanded: false }"
                        data-aos="fade-up"
                    >
                        <div
                            class="relative inline-flex justify-center items-center"
                        >
                            <img
                                src="/images/explainer.jpg"
                                width="768"
                                height="432"
                                alt="Explainer"
                            />
                            <!-- Illustration -->
                            <svg
                                class="absolute right-0 top-0 -mt-11 mr-9"
                                xmlns="http://www.w3.org/2000/svg"
                                width="69"
                                height="77"
                            >
                                <path
                                    class="fill-emerald-400"
                                    d="M19.987 69.903a16 16 0 0 1-4.12.88 10 10 0 0 1-4.6-.76 9.15 9.15 0 0 1-3.71-3l-.63-.93-.51-1a9.07 9.07 0 0 1-.76-2.31 16.42 16.42 0 0 1 1-8.18 46 46 0 0 1 3.11-6.78 58.58 58.58 0 0 1 8.65-11.79 60.66 60.66 0 0 1 11.18-9.44 45.88 45.88 0 0 1 9.67-4.87 28.1 28.1 0 0 1 11-1.65 25.07 25.07 0 0 1 9.68 2.59 18.08 18.08 0 0 1 4.34 2.92 12.86 12.86 0 0 1 3.16 4.55 13.64 13.64 0 0 1 1 5.31 20.71 20.71 0 0 1-.7 5 35.54 35.54 0 0 1-3.79 8.91 52.15 52.15 0 0 1-5.46 7.63 72.54 72.54 0 0 1-6.52 6.6 58.48 58.48 0 0 1-15.51 10.06 39.78 39.78 0 0 1-3.91 1.47c-.67.2-1.35.39-2 .56a10.66 10.66 0 0 1-2.74.25 7.59 7.59 0 0 1-2.73-.63 3.17 3.17 0 0 1-1.82-1.94c-.48-1.77.65-3.57 1.92-5 .15-.17.33-.38.46-.51l.37-.37c.25-.25.5-.5.75-.73.5-.49 1-.94 1.54-1.4 1-.91 2.11-1.76 3.2-2.59a66 66 0 0 1 6.81-4.53 44.56 44.56 0 0 1 9.75-4.32 22.28 22.28 0 0 1 5.53-.91 13.5 13.5 0 0 1 5.91 1.09 10.75 10.75 0 0 1 4.61 4.13l.74 1.32c.229.488.42.993.57 1.51.28.977.438 1.984.47 3a17.19 17.19 0 0 1-.73 5.58 21.73 21.73 0 0 1-2.16 5.06c-1.24 2-2.26 2.51-2.44 2.23-.18-.28.17-1.39.5-3.15a24.07 24.07 0 0 0 .33-7 13.91 13.91 0 0 0-.83-3.9 8.73 8.73 0 0 0-2.2-2.87 6.64 6.64 0 0 0-3-1.32 12.39 12.39 0 0 0-4 .05 31.68 31.68 0 0 0-8.84 3.07 59.18 59.18 0 0 0-8.36 5.16c-1.34 1-2.64 2-3.84 3.05-.3.27-.61.54-.88.81l-.54.52c-.11.1-.08.06-.12.11-.04.05 0 .15.12.16h.17l.42-.09.56-.14c.75-.2 1.51-.44 2.26-.71a47.25 47.25 0 0 0 8.79-4.41 65.55 65.55 0 0 0 14.92-13.36 41 41 0 0 0 6.16-10.25c1.47-3.62 2.17-7.66.82-10.69a8.43 8.43 0 0 0-3.29-3.74 19.61 19.61 0 0 0-2.45-1.33c-.45-.17-.89-.37-1.34-.54l-1.37-.43a23 23 0 0 0-11.5 0 38.32 38.32 0 0 0-12.15 5.44 58.11 58.11 0 0 0-10.35 8.85 53.09 53.09 0 0 0-8 11.06 32.11 32.11 0 0 0-2.51 6.2c-.57 2.09-.72 4.22.06 5.77a6.4 6.4 0 0 0 2.2 2.63 5.15 5.15 0 0 0 1.51.61 6.23 6.23 0 0 0 1.74.11 17.27 17.27 0 0 0 7.38-2.8c4.75-2.91 9-6.88 13.05-10.89a97.44 97.44 0 0 0 16-20.33 49.73 49.73 0 0 0 4.91-11.72l.37-1.49.27-1.54c.199-.989.32-1.992.36-3a9.11 9.11 0 0 0-1.23-5.27 6.61 6.61 0 0 0-3.08-2.43 13.93 13.93 0 0 0-4.31-.84 32 32 0 0 0-9.31 1.08 59.27 59.27 0 0 0-9.08 3.11 60.65 60.65 0 0 0-8.39 4.66c-2.37 1.57-4.58 3.3-6.83 5.12-2.09 1.69-3.79 3.15-5.22 4.38a77.994 77.994 0 0 1-3.64 2.95 14 14 0 0 1-4.68 2.64 10.65 10.65 0 0 1-1.73.49c-.72 0-.44-.89.68-2.61a54.19 54.19 0 0 1 5.93-7.22 86.61 86.61 0 0 1 14.37-12.19 60.24 60.24 0 0 1 4.18-2.53 45.5 45.5 0 0 1 4.49-2.2 55.38 55.38 0 0 1 9.54-3 37.12 37.12 0 0 1 10.52-.89 17.78 17.78 0 0 1 5.84 1.44 12.52 12.52 0 0 1 5.32 4.36 13.2 13.2 0 0 1 2.19 6.31 21.59 21.59 0 0 1-.28 5.76 45.26 45.26 0 0 1-2.91 9.94 68.73 68.73 0 0 1-7.37 13 104.64 104.64 0 0 1-9.37 11.25 134.3 134.3 0 0 1-10.58 9.94 61.69 61.69 0 0 1-6 4.45 32.1 32.1 0 0 1-6.92 3.51l-.04-.12Z"
                                />
                            </svg>
                            <!-- Play button -->
                            <div class="absolute">
                                <button
                                    class="btn h-10 px-4 inline-flex items-center text-gray-900 bg-white hover:bg-blue-50"
                                    @click.prevent="modalExpanded = true"
                                    aria-controls="video-modal"
                                >
                                    <span
                                        class="tracking-normal text-blue-500 mr-2"
                                    >
                                        <svg
                                            class="fill-current"
                                            width="9"
                                            height="12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M.783.088A.5.5 0 0 0 0 .5v11a.5.5 0 0 0 .783.412l8-5.5a.5.5 0 0 0 0-.824l-8-5.5Z"
                                            />
                                        </svg>
                                    </span>
                                    Quick Explainer
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Steps -->
                    <div class="relative pb-12">
                        <!-- Line -->
                        <div
                            class="hidden lg:block absolute top-4 left-32 right-32 mt-px h-0.5 bg-gray-200 -z-10"
                            aria-hidden="true"
                        ></div>

                        <!-- Grid -->
                        <div
                            class="max-w-sm mx-auto grid gap-12 sm:grid-cols-2 sm:max-w-3xl lg:grid-cols-4 lg:max-w-none items-start"
                        >
                            <!-- #1 -->
                            <div class="text-center">
                                <div
                                    class="w-9 h-9 bg-gray-900 border-2 border-white text-white text-[15px] font-bold rounded-full inline-flex items-center justify-center mb-3"
                                >
                                    1
                                </div>
                                <h3
                                    class="font-cabinet-grotesk font-bold text-lg"
                                >
                                    Add info about your products.
                                </h3>
                                <div class="text-gray-500">
                                    You will be able to add information about
                                    your products that will be available on
                                    specific url adress.
                                </div>
                            </div>

                            <!-- #2 -->
                            <div class="text-center">
                                <div
                                    class="w-9 h-9 bg-gray-900 border-2 border-white text-white text-[15px] font-bold rounded-full inline-flex items-center justify-center mb-3"
                                >
                                    2
                                </div>
                                <h3
                                    class="font-cabinet-grotesk font-bold text-lg"
                                >
                                    Localaze it.
                                </h3>
                                <div class="text-gray-500">
                                    You will be able to localaze the information
                                    about your products to any ISO language.
                                </div>
                            </div>

                            <!-- #3 -->
                            <div class="text-center">
                                <div
                                    class="w-9 h-9 bg-gray-900 border-2 border-white text-white text-[15px] font-bold rounded-full inline-flex items-center justify-center mb-3"
                                >
                                    3
                                </div>
                                <h3
                                    class="font-cabinet-grotesk font-bold text-lg"
                                >
                                    Get QR codes.
                                </h3>
                                <div class="text-gray-500">
                                    We will autogenerate a downloadable QR code
                                    for you that you can put on your products
                                </div>
                            </div>

                            <!-- #4 -->
                            <div class="text-center">
                                <div
                                    class="w-9 h-9 bg-gray-900 border-2 border-white text-white text-[15px] font-bold rounded-full inline-flex items-center justify-center mb-3"
                                >
                                    4
                                </div>
                                <h3
                                    class="font-cabinet-grotesk font-bold text-lg"
                                >
                                    Let customers access it.
                                </h3>
                                <div class="text-gray-500">
                                    Let your customers access the information in
                                    language of preference that will be
                                    autodetected from their device.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="text-center">
                        <Link
                            class="btn inline-flex items-center text-white bg-primary hover:bg-primary-focus group"
                            href="/register"
                        >
                            Register
                            <span
                                class="tracking-normal text-slate-900 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-2"
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
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features #1 -->
        <section class="relative">
            <!-- Bg -->
            <div
                class="absolute inset-0 bg-blue-600 -z-10"
                aria-hidden="true"
            ></div>

            <!-- Illustration -->
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 pointer-events-none -z-10"
                aria-hidden="true"
            >
                <img
                    class="max-w-none"
                    src="/images/features-illustration.svg"
                    width="2120"
                    height="931"
                />
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <!-- Section header -->
                    <div class="max-w-3xl pb-12 md:pb-16">
                        <h2 class="h2 font-cabinet-grotesk text-white">
                            Improve customer expirience.
                        </h2>
                    </div>

                    <!-- Carousel -->
                    <div class="pb-12 md:pb-16">
                        <div
                            class="carousel swiper-container max-w-sm mx-auto sm:max-w-none"
                        >
                            <div class="swiper-wrapper">
                                <!-- Carousel items -->
                                <div class="swiper-slide max-w-[446px] h-auto">
                                    <!-- Image -->
                                    <img
                                        class="w-full aspect-[4/3] object-cover h-full"
                                        src="/images/carousel-01.jpg"
                                        width="446"
                                        height="335"
                                        alt="Carousel 01"
                                    />
                                </div>
                                <div class="swiper-slide max-w-[446px] h-auto">
                                    <!-- Image -->
                                    <img
                                        class="w-full aspect-[4/3] object-cover h-full"
                                        src="/images/carousel-02.jpg"
                                        width="446"
                                        height="335"
                                        alt="Carousel 02"
                                    />
                                </div>
                                <div class="swiper-slide max-w-[446px] h-auto">
                                    <!-- Image -->
                                    <img
                                        class="w-full aspect-[4/3] object-cover h-full"
                                        src="/images/carousel-03.jpg"
                                        width="446"
                                        height="335"
                                        alt="Carousel 03"
                                    />
                                </div>
                                <div class="swiper-slide max-w-[446px] h-auto">
                                    <!-- Image -->
                                    <img
                                        class="w-full aspect-[4/3] object-cover h-full"
                                        src="/images/carousel-04.jpg"
                                        width="446"
                                        height="335"
                                        alt="Carousel 04"
                                    />
                                </div>
                                <div class="swiper-slide max-w-[446px] h-auto">
                                    <!-- Image -->
                                    <img
                                        class="w-full aspect-[4/3] object-cover h-full"
                                        src="/images/carousel-05.jpg"
                                        width="446"
                                        height="335"
                                        alt="Carousel 05"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Arrows -->
                        <div class="flex mt-12 space-x-3 justify-end">
                            <button
                                class="carousel-prev relative z-20 w-11 h-11 rounded-full flex items-center justify-center group bg-gray-900"
                            >
                                <span class="sr-only">Previous</span>
                                <svg
                                    class="fill-blue-500 group-hover:fill-white transition duration-150 ease-in-out"
                                    width="13"
                                    height="12"
                                    viewBox="0 0 13 12"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="m3.914 5 3.5-3.5L6 .086 1.086 5H1v.086L.086 6 1 6.914V7h.086L6 11.914 7.414 10.5 3.914 7H13V5z"
                                    />
                                </svg>
                            </button>
                            <button
                                class="carousel-next relative z-20 w-11 h-11 rounded-full flex items-center justify-center group bg-gray-900"
                            >
                                <span class="sr-only">Next</span>
                                <svg
                                    class="fill-blue-500 group-hover:fill-white transition duration-150 ease-in-out"
                                    width="13"
                                    height="12"
                                    viewBox="0 0 13 12"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="m9.086 5-3.5-3.5L7 .086 11.914 5H12v.086l.914.914-.914.914V7h-.086L7 11.914 5.586 10.5l3.5-3.5H0V5z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Grid -->
                    <div
                        class="max-w-sm mx-auto grid sm:grid-cols-2 sm:max-w-3xl lg:grid-cols-4 lg:max-w-none items-start"
                    >
                        <!-- #1 -->
                        <div
                            class="relative p-5 before:opacity-0 hover:before:opacity-20 before:absolute before:inset-0 before:rounded before:bg-gradient-to-tr before:from-white before:to-white/25 before:shadow-xl before:transition-all before:duration-150 before:ease-in-out"
                            data-aos="fade-up"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-seo"
                                width="48"
                                height="48"
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
                                    d="M7 8h-3a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-3"
                                ></path>
                                <path d="M14 16h-4v-8h4"></path>
                                <path d="M11 12h2"></path>
                                <rect
                                    x="17"
                                    y="8"
                                    width="4"
                                    height="8"
                                    rx="1"
                                ></rect>
                            </svg>
                            <h3
                                class="font-cabinet-grotesk font-bold text-lg text-white"
                            >
                                Help yor SEO
                            </h3>
                            <div class="text-white text-opacity-80">
                                If you would add this functionality to your own
                                company web it would significantly worsen your
                                SEO capabilities. That is why outsourcing makes
                                sense, especially with our prices.
                            </div>
                        </div>

                        <!-- #2 -->
                        <div
                            class="relative p-5 before:opacity-0 hover:before:opacity-20 before:absolute before:inset-0 before:rounded before:bg-gradient-to-tr before:from-white before:to-white/25 before:shadow-xl before:transition-all before:duration-150 before:ease-in-out"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-eyeglass"
                                width="48"
                                height="48"
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
                                <path d="M8 4h-2l-3 10"></path>
                                <path d="M16 4h2l3 10"></path>
                                <line x1="10" y1="16" x2="14" y2="16"></line>
                                <path
                                    d="M21 16.5a3.5 3.5 0 0 1 -7 0v-2.5h7v2.5"
                                ></path>
                                <path
                                    d="M10 16.5a3.5 3.5 0 0 1 -7 0v-2.5h7v2.5"
                                ></path>
                            </svg>
                            <h3
                                class="font-cabinet-grotesk font-bold text-lg text-white"
                            >
                                Allow customers with worse vision read product
                                information.
                            </h3>
                            <div class="text-white text-opacity-80">
                                Older people are having trouble reading product
                                information especially with the small formating,
                                but most fo them can scan a QR code.
                            </div>
                        </div>

                        <!-- #3 -->
                        <div
                            class="relative p-5 before:opacity-0 hover:before:opacity-20 before:absolute before:inset-0 before:rounded before:bg-gradient-to-tr before:from-white before:to-white/25 before:shadow-xl before:transition-all before:duration-150 before:ease-in-out"
                            data-aos="fade-up"
                            data-aos-delay="200"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-world"
                                width="48"
                                height="48"
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
                                <line x1="3.6" y1="9" x2="20.4" y2="9"></line>
                                <line x1="3.6" y1="15" x2="20.4" y2="15"></line>
                                <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                                <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                            </svg>
                            <h3
                                class="font-cabinet-grotesk font-bold text-lg text-white"
                            >
                                Localize to any ISO language
                            </h3>
                            <div class="text-white text-opacity-80">
                                Localize the information to any ISO language to
                                access all of the customers. It does not make
                                sense to print as many localized packaging, but
                                it makes sense to have it localized online.
                            </div>
                        </div>

                        <!-- #4 -->
                        <div
                            class="relative p-5 before:opacity-0 hover:before:opacity-20 before:absolute before:inset-0 before:rounded before:bg-gradient-to-tr before:from-white before:to-white/25 before:shadow-xl before:transition-all before:duration-150 before:ease-in-out"
                            data-aos="fade-up"
                            data-aos-delay="300"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-accessible"
                                width="48"
                                height="48"
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
                                <path
                                    d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1"
                                ></path>
                                <circle
                                    cx="12"
                                    cy="7.5"
                                    r=".5"
                                    fill="currentColor"
                                ></circle>
                            </svg>
                            <h3
                                class="font-cabinet-grotesk font-bold text-lg text-white"
                            >
                                Improve customer expirience.
                            </h3>
                            <div class="text-white text-opacity-80">
                                Customers should allways be on the first place
                                when it comes to the product. We will help you
                                improve cutomer expirience, which will
                                positively impact customers view on you
                                products.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section>
            <div class="max-w-6xl mx-auto px-4 sm:px-6" id="subscriptions">
                <div class="pt-12 md:pt-20">
                    <!-- Section header -->
                    <div class="max-w-3xl mx-auto text-center pb-8">
                        <h2 class="h2 font-cabinet-grotesk">
                            Find a plan that fits your business best
                        </h2>
                    </div>

                    <!-- Pricing tables -->
                    <PricingTables />
                </div>
            </div>
        </section>

        <!-- Single testimonial -->
        <section class="relative" data-aos="fade-up">
            <!-- Illustration -->
            <div
                class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 pointer-events-none -z-10 mt-5"
                aria-hidden="true"
            >
                <img
                    class="max-w-none"
                    src="/images/testimonial-illustration.svg"
                    width="1440"
                    height="350"
                />
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:mb-20 hidden">
                    <div class="max-w-3xl mx-auto">
                        <div class="text-center">
                            <div class="inline-flex mb-3">
                                <img
                                    class="rounded-full"
                                    src="/images/testimonial-01.jpg"
                                    width="40"
                                    height="40"
                                    alt="Testimonial 01"
                                />
                            </div>
                            <div
                                class="font-cabinet-grotesk font-bold text-lg text-gray-900 mb-2"
                            >
                                "The service helped me find the perfect match.
                                Two clear benefits I gained are a good
                                assessment of my needs and a pool of reliable
                                potential talents."
                            </div>
                            <div
                                class="font-cabinet-grotesk text-gray-900 font-medium"
                            >
                                Patrick Mills
                                <span class="text-gray-400">-</span> CEO,
                                <a
                                    class="text-blue-500 font-bold hover:text-blue-600"
                                    href="#0"
                                    >PraxyNet</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQs -->
        <section class="pt-8 sm:pt-12 md:pt-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="pb-12 md:pb-20">
                    <!-- Section header -->
                    <div class="max-w-3xl mx-auto pb-10">
                        <h2 class="h2 font-cabinet-grotesk">
                            Frequently asked questions
                        </h2>
                    </div>

                    <div class="max-w-3xl mx-auto space-y-6">
                        <!-- Item -->
                        <div class="space-y-2">
                            <h4 class="text-xl font-cabinet-grotesk font-bold">
                                How much is this going to cost?
                            </h4>
                            <p class="text-gray-500">
                                It depends on your requirements, if 100 products
                                is enough, you can user our services for free.
                                If you have more products, you can user our
                                BASIC paid plan that costs 10$ per month and you
                                will be able to have up to 1000 products. If you
                                need even more products or if you need API
                                access for some integrations, you can use our
                                PRO plan which will cost you 30$ per month.
                            </p>
                        </div>
                        <!-- Item -->
                        <div class="space-y-2">
                            <h4 class="text-xl font-cabinet-grotesk font-bold">
                                Can i upgrade to paid plans later?
                            </h4>
                            <p class="text-gray-500">
                                Yes, you can change plans whenever you want.
                                Just be aware that if you will downgrade a plan
                                you will loose the abilities of that plan, so if
                                you have more products than plan allows, users
                                will not be able to access theese products.
                            </p>
                        </div>
                        <!-- Item -->
                        <div class="space-y-2">
                            <h4 class="text-xl font-cabinet-grotesk font-bold">
                                Where can i find more information about your
                                service?
                            </h4>
                            <p class="text-gray-500">
                                We have a
                                <a
                                    class="text-primary hover:text-primary-focus"
                                    href="#"
                                    >video guides</a
                                >
                                in English and also an extensive
                                <a
                                    class="text-primary hover:text-primary-focus"
                                    href="#"
                                    >documentation</a
                                >.
                            </p>
                        </div>
                        <!-- Item -->
                        <div class="space-y-2">
                            <h4 class="text-xl font-cabinet-grotesk font-bold">
                                Have more questions?
                            </h4>
                            <p class="text-gray-500">
                                You can send us a question at
                                <a
                                    class="text-primary hover:text-primary-focus"
                                    href="mailto:ask@productqr.info"
                                    >ask@productqr.info</a
                                >
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="relative overflow-hidden">
            <!-- Bg -->
            <div
                class="absolute inset-0 bg-blue-600 pointer-events-none -z-10"
                aria-hidden="true"
            ></div>

            <!-- Illustration -->
            <div
                class="absolute left-1/2 -translate-x-1/2 pointer-events-none -z-10"
                aria-hidden="true"
            >
                <img
                    class="max-w-none"
                    src="/images/cta-illustration.svg"
                    width="1440"
                    height="242"
                />
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="py-12 md:py-20">
                    <div class="max-w-3xl mx-auto text-center">
                        <h2
                            class="h2 font-cabinet-grotesk text-white mb-6"
                            data-aos="fade-up"
                        >
                            Start creting your product QR now.
                        </h2>
                        <div data-aos="fade-up" data-aos-delay="100">
                            <Link
                                class="btn inline-flex items-center text-white bg-gray-900 hover:bg-gray-800 group"
                                href="/register"
                            >
                                Register
                                <span
                                    class="tracking-normal text-blue-500 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-2"
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
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
