<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <main
        class="flex font-sans antialiased bg-white dark:bg-slate-900 text-black dark:text-white"
    >
        <!-- Content -->
        <div class="min-h-screen w-full lg:w-1/2">
            <div class="h-full">
                <div
                    class="h-full w-full max-w-md px-6 mx-auto flex flex-col after:mt-auto after:flex-1"
                >
                    <!-- Site header -->
                    <header class="flex-1 flex mb-auto">
                        <div
                            class="flex items-center justify-between h-16 md:h-20"
                        >
                            <!-- Logo -->
                            <Link
                                :href="route('dashboard')"
                                v-if="$page.props.user"
                            >
                                <ApplicationMark class="block h-9 w-auto" />
                            </Link>
                            <Link href="/" v-else>
                                <ApplicationMark class="block h-9 w-auto" />
                            </Link>
                        </div>
                    </header>

                    <div class="flex-1 py-8">
                        <div class="mb-10">
                            <h1 class="h2 font-cabinet-grotesk">
                                Welcome back!
                            </h1>
                            <span class="text-gray-500 text-sm"
                                ><span class="inline"
                                    >Are you new here? </span
                                ><Link
                                    class="font-medium text-secondary text-secondary-focus"
                                    href="/register"
                                    >Register</Link
                                ></span
                            >
                        </div>

                        <!-- Form -->
                        <div
                            v-if="status"
                            class="mb-4 font-medium text-sm text-success"
                        >
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Password" />
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="current-password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>
                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox
                                        v-model:checked="form.remember"
                                        name="remember"
                                    />
                                    <span class="ml-2 text-sm text-gray-600"
                                        >Remember me</span
                                    >
                                </label>
                            </div>
                            <div
                                class="flex items-center justify-end mt-4 space-x-2"
                            >
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="underline text-sm text-primary hover:text-primary-focus"
                                >
                                    Forgot your password?
                                </Link>
                                <button
                                    class="btn inline-flex items-center text-white bg-primary hover:bg-primary-focus group"
                                    :class="{
                                        'opacity-25': form.processing,
                                    }"
                                    :disabled="form.processing"
                                >
                                    Log in
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side -->
        <div
            class="fixed right-0 top-0 bottom-0 hidden lg:block lg:w-1/2 overflow-hidden"
            aria-hidden="true"
        >
            <!-- Bg -->
            <div
                class="absolute inset-0 bg-blue-600 pointer-events-none -z-10"
            ></div>

            <!-- Illustration -->
            <div
                class="absolute left-1/2 -translate-x-1/4 pointer-events-none -z-10"
            >
                <object
                    type="image/svg+xml"
                    data="/images/hero-illustration.svg"
                    width="1440"
                    height="1214"
                ></object>
            </div>

            <!-- Quotes -->
            <div
                class="absolute inset-0 flex flex-col justify-center space-y-3"
            >
                <div
                    class="flex flex-nowrap space-x-3 mx-auto -translate-x-1/4"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        data-name="Layer 1"
                        width="1139.17088"
                        height="654.54324"
                        viewBox="0 0 1139.17088 654.54324"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                        <title></title>
                        <circle
                            cx="246.82682"
                            cy="521.76476"
                            r="59.24334"
                            fill="#f2f2f2"
                        />
                        <circle
                            cx="256.45989"
                            cy="513.095"
                            r="59.24334"
                            fill="#fbbf24"
                        />
                        <rect
                            x="304.17137"
                            y="447.54324"
                            width="732.99951"
                            height="2"
                            fill="#3f3d56"
                        />
                        <path
                            d="M714.20735,141.38055H454.03775v-5.36232h-117.971v5.36232H74.82467a17.5985,17.5985,0,0,0-17.59852,17.59851V515.23125a17.59856,17.59856,0,0,0,17.59852,17.59858H714.20735a17.59856,17.59856,0,0,0,17.59852-17.59858V158.97906A17.5985,17.5985,0,0,0,714.20735,141.38055Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="50.4058"
                            y="49.75362"
                            width="627.3913"
                            height="353.91304"
                            fill="#fbbf24"
                        />
                        <circle
                            cx="363.56522"
                            cy="33.66667"
                            r="6.43478"
                            fill="#fbbf24"
                        />
                        <polygon
                            points="498.374 403.667 50.406 403.667 50.406 49.754 498.374 403.667"
                            opacity="0.1"
                        />
                        <circle
                            cx="148.57375"
                            cy="316.87641"
                            r="60.3068"
                            fill="#f2f2f2"
                        />
                        <rect
                            x="509.95272"
                            y="240.62175"
                            width="58.6052"
                            height="12.24586"
                            fill="#3f3d56"
                        />
                        <rect
                            x="439.10165"
                            y="145.27896"
                            width="200.30733"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="439.10165"
                            y="161.89834"
                            width="200.30733"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="439.10165"
                            y="178.51773"
                            width="200.30733"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="439.10165"
                            y="195.13711"
                            width="200.30733"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="439.10165"
                            y="211.7565"
                            width="200.30733"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="614.91726"
                            y="56.9338"
                            width="24.49173"
                            height="24.49173"
                            fill="#f2f2f2"
                        />
                        <path
                            d="M681.1947,215.52507h-29.74v-29.74h29.74Zm-28.44691-1.293h27.15387V187.07816H652.74779Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M749.42165,519.96024H688.19234v-4.41153a.87468.87468,0,0,0-.87471-.87471h-20.9929a.87468.87468,0,0,0-.87471.87471v4.41153H652.32945v-4.41153a.87467.87467,0,0,0-.8747-.87471H630.46184a.87468.87468,0,0,0-.8747.87471v4.41153H616.46657v-4.41153a.87468.87468,0,0,0-.8747-.87471H594.599a.87468.87468,0,0,0-.87471.87471v4.41153H580.60369v-4.41153a.87468.87468,0,0,0-.87471-.87471H558.73607a.87468.87468,0,0,0-.8747.87471v4.41153H544.7408v-4.41153a.87468.87468,0,0,0-.8747-.87471H522.87319a.87467.87467,0,0,0-.8747.87471v4.41153H508.87792v-4.41153a.87468.87468,0,0,0-.87471-.87471h-20.9929a.87468.87468,0,0,0-.87471.87471v4.41153H473.015v-4.41153a.87468.87468,0,0,0-.8747-.87471H307.69588a.87468.87468,0,0,0-.8747.87471v4.41153H293.70061v-4.41153a.87468.87468,0,0,0-.8747-.87471H271.833a.87467.87467,0,0,0-.8747.87471v4.41153H257.83773v-4.41153a.87468.87468,0,0,0-.87471-.87471h-20.9929a.87468.87468,0,0,0-.87471.87471v4.41153H221.97484v-4.41153a.87467.87467,0,0,0-.8747-.87471H200.10723a.87468.87468,0,0,0-.8747.87471v4.41153H186.112v-4.41153a.87468.87468,0,0,0-.8747-.87471H164.24435a.87468.87468,0,0,0-.87471.87471v4.41153H150.24908v-4.41153a.87468.87468,0,0,0-.87471-.87471H128.38146a.87468.87468,0,0,0-.8747.87471v4.41153H114.38619v-4.41153a.87468.87468,0,0,0-.8747-.87471H92.51858a.87467.87467,0,0,0-.8747.87471v4.41153H51.40747a20.99293,20.99293,0,0,0-20.99291,20.99291v9.4925A20.99291,20.99291,0,0,0,51.40747,571.4385H749.42165a20.9929,20.9929,0,0,0,20.99291-20.99285v-9.4925A20.99292,20.99292,0,0,0,749.42165,519.96024Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M193.58593,477.27162a76,76,0,1,1,76-76A76.08614,76.08614,0,0,1,193.58593,477.27162Zm0-150a74,74,0,1,0,74,74A74.08385,74.08385,0,0,0,193.58593,327.27162Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="586.17137"
                            y="32.54324"
                            width="254.99951"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="406.17137"
                            y="560.54324"
                            width="732.99951"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="192.67161"
                            y="652.54324"
                            width="254.99951"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="471"
                            y="550"
                            width="28"
                            height="28"
                            fill="#fbbf24"
                        />
                        <path
                            d="M546.41456,684.72838h-34v-34h34Zm-32.52174-1.47826H544.9363V652.20664H513.89282Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="796"
                            y="22"
                            width="28"
                            height="28"
                            fill="#fbbf24"
                        />
                        <path
                            d="M871.41456,156.72838h-34v-34h34Zm-32.52174-1.47826H869.9363V124.20664H838.89282Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="1078"
                            y="550"
                            width="28"
                            height="28"
                            fill="#fbbf24"
                        />
                        <path
                            d="M1153.41456,684.72838h-34v-34h34Zm-32.52174-1.47826h31.04348V652.20664h-31.04348Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M1087.58593,354.6866h-2.37862V289.525a37.71374,37.71374,0,0,0-37.71385-37.71377H909.44A37.71373,37.71373,0,0,0,871.72613,289.525V647.00639A37.71374,37.71374,0,0,0,909.44,684.72017h138.05348a37.71374,37.71374,0,0,0,37.71385-37.71378V401.06969h2.37862Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M1077.176,291.74159v356.96a28.16523,28.16523,0,0,1-28.16016,28.17H910.296a28.16511,28.16511,0,0,1-28.16-28.17v-356.96a28.163,28.163,0,0,1,28.16-28.16h16.83a13.3792,13.3792,0,0,0,12.39,18.43h79.09a13.37908,13.37908,0,0,0,12.38995-18.43h18.02A28.16308,28.16308,0,0,1,1077.176,291.74159Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#fbbf24"
                        />
                        <rect
                            x="928.57968"
                            y="376.21769"
                            width="41.32357"
                            height="12.24586"
                            fill="#3f3d56"
                        />
                        <rect
                            x="878.62133"
                            y="280.8749"
                            width="141.24028"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="878.62133"
                            y="297.49429"
                            width="141.24028"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="878.62133"
                            y="314.11367"
                            width="141.24028"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="878.62133"
                            y="330.73306"
                            width="141.24028"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="878.62133"
                            y="347.35244"
                            width="141.24028"
                            height="5.24823"
                            fill="#3f3d56"
                        />
                        <rect
                            x="929.68352"
                            y="211.17873"
                            width="24.49173"
                            height="24.49173"
                            fill="#f2f2f2"
                        />
                        <path
                            d="M969.47386,340.03163v29.74h29.74v-29.74Zm28.45,28.45h-27.16v-27.16h27.16Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M1077.176,610.58162v38.12a28.16523,28.16523,0,0,1-28.16016,28.17H910.296a28.16511,28.16511,0,0,1-28.16-28.17v-192.21l116.87,92.33,2,1.58,21.74,17.17,2.03,1.61Z"
                            transform="translate(-30.41456 -122.72838)"
                            opacity="0.1"
                        />
                        <circle
                            cx="937.24147"
                            cy="498.70691"
                            r="43.86783"
                            fill="#f2f2f2"
                        />
                        <path
                            d="M350.58593,777.27162a87,87,0,1,1,87-87A87.09858,87.09858,0,0,1,350.58593,777.27162Zm0-172a85,85,0,1,0,85,85A85.09629,85.09629,0,0,0,350.58593,605.27162Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M980.58593,655.27162a55,55,0,1,1,55-55A55.06223,55.06223,0,0,1,980.58593,655.27162Zm0-108a53,53,0,1,0,53,53A53.05963,53.05963,0,0,0,980.58593,547.27162Z"
                            transform="translate(-30.41456 -122.72838)"
                            fill="#3f3d56"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </main>
</template>
