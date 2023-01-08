<script setup>
import { nextTick, ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const recovery = ref(false);

const form = useForm({
    code: "",
    recovery_code: "",
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = "";
    } else {
        codeInput.value.focus();
        form.recovery_code = "";
    }
};

const submit = () => {
    form.post(route("two-factor.login"));
};
</script>

<template>
    <Head title="Two-factor Confirmation" />

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
                                Two factor challenge
                            </h1>
                            <div class="text-sm text-gray-600">
                                <template v-if="!recovery">
                                    Please confirm access to your account by
                                    entering the authentication code provided by
                                    your authenticator application.
                                </template>

                                <template v-else>
                                    Please confirm access to your account by
                                    entering one of your emergency recovery
                                    codes.
                                </template>
                            </div>
                        </div>

                        <!-- Form -->
                        <form @submit.prevent="submit">
                            <div v-if="!recovery">
                                <InputLabel for="code" value="Code" />
                                <TextInput
                                    id="code"
                                    ref="codeInput"
                                    v-model="form.code"
                                    type="text"
                                    inputmode="numeric"
                                    class="mt-1 block w-full"
                                    autofocus
                                    autocomplete="one-time-code"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.code"
                                />
                            </div>

                            <div v-else>
                                <InputLabel
                                    for="recovery_code"
                                    value="Recovery Code"
                                />
                                <TextInput
                                    id="recovery_code"
                                    ref="recoveryCodeInput"
                                    v-model="form.recovery_code"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="one-time-code"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.recovery_code"
                                />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button
                                    type="button"
                                    class="text-sm text-primary hover:text-primary-focus underline cursor-pointer"
                                    @click.prevent="toggleRecovery"
                                >
                                    <template v-if="!recovery">
                                        Use a recovery code
                                    </template>

                                    <template v-else>
                                        Use an authentication code
                                    </template>
                                </button>

                                <button
                                    class="btn inline-flex items-center text-white bg-primary hover:bg-primary-focus group"
                                    :class="{ 'opacity-25': form.processing }"
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
                <div class="flex flex-nowrap space-x-3 mx-auto">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        data-name="Layer 1"
                        width="1100.50064"
                        height="691.70682"
                        viewBox="0 0 1100.50064 691.70682"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                        <title>two_factor_authentication</title>
                        <path
                            d="M1150.25032,388.23743h-1.85859V337.32194a29.4685,29.4685,0,0,0-29.46859-29.46853H1011.05186a29.4685,29.4685,0,0,0-29.46859,29.46853V616.64827a29.46851,29.46851,0,0,0,29.46859,29.46854h107.87128a29.46851,29.46851,0,0,0,29.46859-29.46854V424.47994h1.85859Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M1142.121,339.05342v278.92a22.01111,22.01111,0,0,1-22.01,22.01h-108.39a22.00248,22.00248,0,0,1-22-22.01v-278.92a22.00031,22.00031,0,0,1,22-22h13.15a10.4608,10.4608,0,0,0,9.68,14.4h61.8a10.44027,10.44027,0,0,0,9.67993-14.4H1120.111A22.00894,22.00894,0,0,1,1142.121,339.05342Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#d0cde1"
                        />
                        <rect
                            x="945.85129"
                            y="355.70682"
                            width="126"
                            height="34"
                            fill="#fbbf24"
                        />
                        <path
                            d="M1126.601,487.85341h-122a3.00328,3.00328,0,0,1-3-3v-30a3.00328,3.00328,0,0,1,3-3h122a3.00328,3.00328,0,0,1,3,3v30A3.00328,3.00328,0,0,1,1126.601,487.85341Zm-122-34a1.001,1.001,0,0,0-1,1v30a1.00067,1.00067,0,0,0,1,1h122a1.00067,1.00067,0,0,0,1-1v-30a1.001,1.001,0,0,0-1-1Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="959.85129"
                            y="374.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="981.85129"
                            y="374.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="1003.85129"
                            y="374.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="1025.85129"
                            y="374.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="1047.85129"
                            y="374.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <path
                            d="M1142.121,589.61342v28.36a22.01111,22.01111,0,0,1-22.01,22.01h-108.39a22.00248,22.00248,0,0,1-22-22.01v-130.46Z"
                            transform="translate(-49.74968 -104.14659)"
                            opacity="0.1"
                        />
                        <rect
                            x="99.85129"
                            y="459.70682"
                            width="473"
                            height="232"
                            fill="#d0cde1"
                        />
                        <path
                            d="M502.351,795.85341H151.601a2.00591,2.00591,0,0,1-2-2v-228a2.00587,2.00587,0,0,1,2-2h4.44Z"
                            transform="translate(-49.74968 -104.14659)"
                            opacity="0.1"
                        />
                        <rect
                            x="318.85129"
                            y="490.70682"
                            width="732.99951"
                            height="2"
                            fill="#3f3d56"
                        />
                        <path
                            d="M600.34268,108.46435H390.853v-4.31776H295.86217v4.31776H85.5089a14.17039,14.17039,0,0,0-14.1704,14.1704V409.4906a14.17043,14.17043,0,0,0,14.1704,14.17045H600.34268a14.17044,14.17044,0,0,0,14.1704-14.17045V122.63475A14.17039,14.17039,0,0,0,600.34268,108.46435Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="40.59128"
                            y="29.35679"
                            width="505.16998"
                            height="284.98004"
                            fill="#d0cde1"
                        />
                        <circle
                            cx="292.74433"
                            cy="16.4075"
                            r="5.18132"
                            fill="#fbbf24"
                        />
                        <path
                            d="M240.601,239.85341h-12a3.00328,3.00328,0,0,1-3-3v-12a3.00328,3.00328,0,0,1,3-3h12a3.00328,3.00328,0,0,1,3,3v12A3.00328,3.00328,0,0,1,240.601,239.85341Zm-12-16a1.0013,1.0013,0,0,0-1,1v12a1.0013,1.0013,0,0,0,1,1h12a1.0013,1.0013,0,0,0,1-1v-12a1.0013,1.0013,0,0,0-1-1Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="176.85129"
                            y="133.70682"
                            width="228"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="345.85129"
                            y="188.70682"
                            width="53"
                            height="16"
                            fill="#fbbf24"
                        />
                        <path
                            d="M452.601,304.85341h-49a3.00328,3.00328,0,0,1-3-3v-12a3.00328,3.00328,0,0,1,3-3h49a3.00328,3.00328,0,0,1,3,3v12A3.00328,3.00328,0,0,1,452.601,304.85341Zm-49-16a1.0013,1.0013,0,0,0-1,1v12a1.0013,1.0013,0,0,0,1,1h49a1.0013,1.0013,0,0,0,1-1v-12a1.0013,1.0013,0,0,0-1-1Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="703.85129"
                            y="206.70682"
                            width="100"
                            height="70"
                            fill="#fbbf24"
                        />
                        <path
                            d="M863.601,375.35341h-96a4.00427,4.00427,0,0,1-4-4v-66a4.00427,4.00427,0,0,1,4-4h96a4.00426,4.00426,0,0,1,4,4v66A4.00426,4.00426,0,0,1,863.601,375.35341Zm-96-70v66H863.6039l-.00293-66Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M852.601,302.85341h-4a33,33,0,1,0-66,0h-4a37,37,0,1,1,74,0Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M825.601,330.35341a10.00023,10.00023,0,1,0-15.29412,8.47258V349.5593a5.29411,5.29411,0,0,0,5.29412,5.29411h0a5.29411,5.29411,0,0,0,5.29411-5.29411V338.826A9.98327,9.98327,0,0,0,825.601,330.35341Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="284.35129"
                            y="562.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="306.35129"
                            y="562.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="328.35129"
                            y="562.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="350.35129"
                            y="562.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="372.35129"
                            y="562.70682"
                            width="16"
                            height="2"
                            fill="#3f3d56"
                        />
                        <path
                            d="M643.60059,778.85352H174.60107a4.00428,4.00428,0,0,1-4-4v-228a4.00427,4.00427,0,0,1,4-4H643.60059a4.004,4.004,0,0,1,4,4v228A4.004,4.004,0,0,1,643.60059,778.85352Zm-468.99952-232v228H643.60352l-.00293-228Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="145.85129"
                            cy="470.70682"
                            r="6"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="166.85129"
                            cy="470.70682"
                            r="6"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="187.85129"
                            cy="470.70682"
                            r="6"
                            fill="#3f3d56"
                        />
                        <path
                            d="M453.601,680.85341h-135a3.00328,3.00328,0,0,1-3-3v-34a3.00328,3.00328,0,0,1,3-3h135a3.00328,3.00328,0,0,1,3,3v34A3.00328,3.00328,0,0,1,453.601,680.85341Zm-135-38a1.001,1.001,0,0,0-1,1v34a1.001,1.001,0,0,0,1,1h135a1.001,1.001,0,0,0,1-1v-34a1.001,1.001,0,0,0-1-1Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="437.85129"
                            cy="559.70682"
                            r="18"
                            fill="#fbbf24"
                        />
                        <path
                            d="M493.601,679.85341a19,19,0,1,1,19-19A19.02162,19.02162,0,0,1,493.601,679.85341Zm0-36a17,17,0,1,0,17,17A17.019,17.019,0,0,0,493.601,643.85341Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <polygon
                            points="444.118 563.803 434.437 554.121 437.265 551.293 443.584 557.611 461.216 532.555 464.487 534.858 444.118 563.803"
                            fill="#3f3d56"
                        />
                        <polygon
                            points="433.761 314.337 40.591 314.337 40.591 50.947 433.761 314.337"
                            opacity="0.1"
                        />
                        <path
                            d="M628.69739,413.2984H579.39527v-3.55218a.7043.7043,0,0,0-.70431-.70432H561.78737a.70429.70429,0,0,0-.70431.70432v3.55218H550.51832v-3.55218a.7043.7043,0,0,0-.70432-.70432H532.91042a.7043.7043,0,0,0-.70432.70432v3.55218H521.64136v-3.55218a.70429.70429,0,0,0-.70431-.70432H504.03347a.7043.7043,0,0,0-.70432.70432v3.55218H492.76441v-3.55218a.7043.7043,0,0,0-.70432-.70432H475.15651a.70429.70429,0,0,0-.70431.70432v3.55218H463.88746v-3.55218a.7043.7043,0,0,0-.70432-.70432H446.27956a.7043.7043,0,0,0-.70432.70432v3.55218H435.0105v-3.55218a.70429.70429,0,0,0-.70431-.70432H417.4026a.7043.7043,0,0,0-.70431.70432v3.55218H406.13355v-3.55218a.7043.7043,0,0,0-.70432-.70432H273.01784a.7043.7043,0,0,0-.70432.70432v3.55218H261.74878v-3.55218a.7043.7043,0,0,0-.70432-.70432H244.14088a.70429.70429,0,0,0-.70431.70432v3.55218H232.87183v-3.55218a.7043.7043,0,0,0-.70432-.70432H215.26393a.7043.7043,0,0,0-.70432.70432v3.55218H203.99487v-3.55218a.70429.70429,0,0,0-.70431-.70432H186.387a.7043.7043,0,0,0-.70431.70432v3.55218H175.11792v-3.55218a.7043.7043,0,0,0-.70432-.70432H157.51a.7043.7043,0,0,0-.70432.70432v3.55218H146.241v-3.55218a.7043.7043,0,0,0-.70432-.70432H128.63307a.7043.7043,0,0,0-.70432.70432v3.55218H117.364v-3.55218a.7043.7043,0,0,0-.70431-.70432H99.75611a.70429.70429,0,0,0-.70431.70432v3.55218H66.65326A16.90359,16.90359,0,0,0,49.74968,430.202v7.6434a16.90358,16.90358,0,0,0,16.90358,16.90354H628.69739A16.90358,16.90358,0,0,0,645.601,437.84539V430.202A16.90359,16.90359,0,0,0,628.69739,413.2984Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M474.601,321.85341h-264a3.00328,3.00328,0,0,1-3-3v-110a3.00328,3.00328,0,0,1,3-3h264a3.00328,3.00328,0,0,1,3,3v110A3.00328,3.00328,0,0,1,474.601,321.85341Zm-264-114a1.0013,1.0013,0,0,0-1,1v110a1.0013,1.0013,0,0,0,1,1h264a1.0013,1.0013,0,0,0,1-1v-110a1.0013,1.0013,0,0,0-1-1Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M240.601,269.85341h-12a3.00328,3.00328,0,0,1-3-3v-12a3.00328,3.00328,0,0,1,3-3h12a3.00328,3.00328,0,0,1,3,3v12A3.00328,3.00328,0,0,1,240.601,269.85341Zm-12-16a1.0013,1.0013,0,0,0-1,1v12a1.0013,1.0013,0,0,0,1,1h12a1.0013,1.0013,0,0,0,1-1v-12a1.0013,1.0013,0,0,0-1-1Z"
                            transform="translate(-49.74968 -104.14659)"
                            fill="#3f3d56"
                        />
                        <rect
                            x="176.85129"
                            y="163.70682"
                            width="228"
                            height="2"
                            fill="#3f3d56"
                        />
                        <rect
                            x="264.85129"
                            y="269.70682"
                            width="732.99951"
                            height="2"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="264.85129"
                            cy="269.70682"
                            r="14"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="997.85129"
                            cy="271.70682"
                            r="11"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="1051.85129"
                            cy="492.70682"
                            r="11"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="321.85129"
                            cy="492.70682"
                            r="11"
                            fill="#3f3d56"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </main>
</template>
