<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

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
                            <h1 class="h2 font-cabinet-grotesk">Welcome!</h1>
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
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
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
                                    autocomplete="new-password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel
                                    for="password_confirmation"
                                    value="Confirm Password"
                                />
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="new-password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>

                            <div
                                v-if="
                                    $page.props.jetstream
                                        .hasTermsAndPrivacyPolicyFeature
                                "
                                class="mt-4"
                            >
                                <InputLabel for="terms">
                                    <div class="flex items-center">
                                        <Checkbox
                                            id="terms"
                                            v-model:checked="form.terms"
                                            name="terms"
                                            required
                                        />

                                        <div class="ml-2">
                                            I agree to the
                                            <a
                                                target="_blank"
                                                :href="route('terms.show')"
                                                class="underline text-sm text-primary hover:text-primary-focus"
                                                >Terms of Service</a
                                            >
                                            and
                                            <a
                                                target="_blank"
                                                :href="route('policy.show')"
                                                class="underline text-sm text-primary hover:text-primary-focus"
                                                >Privacy Policy</a
                                            >
                                        </div>
                                    </div>
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.terms"
                                    />
                                </InputLabel>
                            </div>

                            <div
                                class="flex items-center justify-end mt-4 space-x-2"
                            >
                                <Link
                                    :href="route('login')"
                                    class="underline text-sm text-secondary hover:text-secondary-focus"
                                >
                                    Already registered?
                                </Link>

                                <button
                                    class="btn inline-flex items-center text-white bg-primary hover:bg-primary-focus group"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Register
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
                        width="543.21934"
                        height="633.6012"
                        viewBox="0 0 543.21934 633.6012"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                        <path
                            d="M854.05236,366.72793H345.48229a17.11177,17.11177,0,0,1-17.092-17.092V150.29137a17.11177,17.11177,0,0,1,17.092-17.092H854.05236a17.11177,17.11177,0,0,1,17.092,17.092V349.636A17.11177,17.11177,0,0,1,854.05236,366.72793Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#f2f2f2"
                        />
                        <path
                            d="M735.44243,355.827H426.21a87.01423,87.01423,0,0,1-86.916-86.916V231.02584a87.01476,87.01476,0,0,1,86.916-86.91662h347.1176a87.01476,87.01476,0,0,1,86.916,86.91662A124.94266,124.94266,0,0,1,735.44243,355.827Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#fff"
                        />
                        <path
                            d="M655.673,201.175H451.26661a4.408,4.408,0,1,1,0-8.81606H655.673a4.408,4.408,0,0,1,0,8.81606Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#e6e6e6"
                        />
                        <path
                            d="M759.14708,248.20578H451.26661a4.408,4.408,0,1,1,0-8.81606H759.14708a4.408,4.408,0,0,1,0,8.81606Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#e6e6e6"
                        />
                        <path
                            d="M759.14708,295.23659H451.26661a4.408,4.408,0,1,1,0-8.81606H759.14708a4.408,4.408,0,0,1,0,8.81606Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#e6e6e6"
                        />
                        <path
                            d="M759.14708,295.23659H451.26661a4.408,4.408,0,1,1,0-8.81606H759.14708a4.408,4.408,0,0,1,0,8.81606Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#e6e6e6"
                        />
                        <path
                            d="M634.10291,253.6037a9.08847,9.08847,0,0,0,11.00741,8.54713l16.81052,27.57777,7.15453-15.18214L652.015,250.6857a9.13775,9.13775,0,0,0-17.912,2.918Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#ffb6b6"
                        />
                        <path
                            d="M760.255,332.63993,702.3227,301.21629,684.04961,284.0724s-7.94382-2.1269-5.02-4.70983-5.40826-5.074-5.40826-5.074l-9.80947-9.20329L649.8729,274.948l4.0341,6.25338s-.27766,10.35216,5.39346,8.36056,4.25394,6.59416,4.25394,6.59416l33.84976,52.47148Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="260.85489"
                            cy="113.24865"
                            r="56.58599"
                            fill="#fbbf24"
                        />
                        <polygon
                            points="432.044 611.601 420.278 611.601 414.679 566.219 432.044 566.219 432.044 611.601"
                            fill="#ffb6b6"
                        />
                        <path
                            d="M766.64449,765.186h-8.43765l-1.50609-7.96615-3.8573,7.96614H730.46478a5.03052,5.03052,0,0,1-2.85851-9.17017l17.87094-12.34231V735.62l18.79712,1.12193Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#2f2e41"
                        />
                        <polygon
                            points="337.942 611.601 326.176 611.601 320.577 566.219 337.942 566.219 337.942 611.601"
                            fill="#ffb6b6"
                        />
                        <path
                            d="M672.54234,765.186h-8.43765l-1.50608-7.96615L658.7413,765.186H636.36263a5.03052,5.03052,0,0,1-2.85851-9.17017l17.871-12.34231V735.62l18.79711,1.12193Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#2f2e41"
                        />
                        <rect
                            x="360.17495"
                            y="268.38114"
                            width="59.38485"
                            height="67.60737"
                            fill="#ffb6b6"
                        />
                        <path
                            d="M689.9357,434.92742l-10.04975,11.877L662.5273,483.34891,618.788,587.41832l-9.25023,22.00919,7.47021,38.90734s1.20911,27.41093,1.20911,31.89768c0,9.13613,7.64134,14.19843,7.64134,14.19843l5.606,29.19819,54.36-2.284s-1.89668-32.18465-13.28212-40.30307-16.6191-50.42877-16.6191-50.42877l-6.1865-18.77224,60.29846-71.47763.38919,24.98513.18838,12.09342s-8.83024,78.65618,1.463,93.921.20981,13.46892.20981,13.46892l.49048,31.48835,64.40973.45681L762.976,626.12129s-7.2153-5.6971-3.35489-11.42384-3.74157-12.74053-3.74157-12.74053l3.40954-70.77248s-3.7751-12.22439.66547-13.81333.583-12.10132.583-12.10132l.65994-13.69836-13.24739-42.483Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#2f2e41"
                        />
                        <path
                            d="M748.86374,401.58054l6.39529-19.18588,4.56807-6.39529,1.82722-18.27226c0-49.33511-11.00445-41.11978-11.00445-41.11978l-6.3542-17.35146-29.23561-.91361L696.331,316.15772l-15.53142,5.48167-6.082,31.60212,11.10688,33.72122,2.74084,18.27226c-5.22846,9.6521-4.78621,5.08671-.45681,12.33378l51.61914,14.161c18.27226,6.39529,18.27226-10.04974,14.60827-14.161C750.672,413.45751,748.86374,401.58054,748.86374,401.58054Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#3f3d56"
                        />
                        <circle
                            cx="397.51079"
                            cy="131.90749"
                            r="27.10245"
                            fill="#ffb6b6"
                        />
                        <path
                            d="M699.50588,307.8341"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#2f2e41"
                        />
                        <path
                            d="M762.08369,301.28407a3.32909,3.32909,0,0,1-1.8546,4.86957c-3.63616,1.206-5.87453,4.72337-8.48745,7.53731-2.60383,2.8048-6.79728,5.1345-10.12284,3.225-3.31642-1.90027-3.54483-6.75155-6.32219-9.38276-2.70432-2.55811-7.19928-2.24751-10.37869-.30151l-.09507.05848a3.35133,3.35133,0,0,1-5.12711-3.40958q1.671-8.88678,3.34014-17.77163a59.76117,59.76117,0,0,1-12.50736,18.9118,13.757,13.757,0,0,1-5.42687,3.8189c-1.90027.603-3.74579-1.36128-5.59131-1.005,4.58636-4.01077,20.00815-29.71986,17.249-46.90492q-4.865.5482-9.72994,1.09635A8.94324,8.94324,0,0,0,704.855,257.924a10.51041,10.51041,0,0,1-.55734,4.41271c-1.35213.15535-2.71341.30151-4.06554.4568-1.882.21017-3.92858.39285-5.54563-.59381-2.69517-1.64449-2.77742-5.53649-2.01-8.60628,2.2475-8.926,9.063-16.39022,17.40431-20.30045,8.3413-3.90115,10.80806,4.78732,19.597,2.01,17.35864-5.48168,30.66085,3.892,35.34769,21.28717C768.96323,271.18051,766.10361,286.66626,762.08369,301.28407Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#2f2e41"
                        />
                        <path
                            d="M837.11581,765.77552H803.92929l-.14258-.25879c-.42431-.76953-.834-1.585-1.2168-2.42285-3.41845-7.31836-4.86328-15.68848-6.13818-23.07325l-.96-5.5664a3.43689,3.43689,0,0,1,5.41016-3.36231q7.56517,5.5049,15.13623,10.999c1.91113,1.39062,4.09375,3,6.18408,4.73925.20166-.97949.4126-1.96191.62353-2.93066a3.43916,3.43916,0,0,1,6.28077-1.08594l3.88281,6.23828c2.832,4.55567,5.33154,9.04493,4.82226,13.88672a.756.756,0,0,1-.01318.17578,10.94679,10.94679,0,0,1-.56348,2.33106Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#f0f0f0"
                        />
                        <path
                            d="M870.42521,766.49329l-315.3575.30731a1.19069,1.19069,0,0,1,0-2.38135l315.3575-.30731a1.19069,1.19069,0,0,1,0,2.38135Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#cacaca"
                        />
                        <path
                            d="M584.10145,322.60868l-34.688-29.29381a5.86536,5.86536,0,0,1-.69609-8.25652l6.38441-7.56005a5.86537,5.86537,0,0,1,8.25653-.6961l34.688,29.29381a5.86536,5.86536,0,0,1,.6961,8.25652l-6.38442,7.56006A5.86537,5.86537,0,0,1,584.10145,322.60868Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M551.2336,285.66783a3.161,3.161,0,0,0,.37511,4.44934l34.688,29.29381a3.16093,3.16093,0,0,0,4.44933-.37512l6.38442-7.56a3.161,3.161,0,0,0-.37512-4.44934l-34.688-29.29381a3.161,3.161,0,0,0-4.44934.37512Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#fff"
                        />
                        <path
                            d="M571.59773,297.05559a1.33329,1.33329,0,0,1-1.05444.55768l-5.45025.12517a1.33366,1.33366,0,1,1-.06117-2.66662l3.56552-.082-3.5114-9.26539a1.33372,1.33372,0,0,1,2.49431-.94531l4.17956,11.02823a1.33428,1.33428,0,0,1-.14089,1.21782Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#fbbf24"
                        />
                        <path
                            d="M572.29679,299.38408a9.08846,9.08846,0,0,1,7.29959,11.8715l25.5864,19.70946-15.87006,5.46132-21.86426-19.5537a9.13775,9.13775,0,0,1,4.84831-17.48852Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#ffb6b6"
                        />
                        <path
                            d="M705.50514,309.12932l-65.50929,40.27784s-26.4126-9.77273-21.25071-14.29686-11.2708-7.58266-11.2708-7.58266l-18.15322-12.213-10.534,12.24231s1.91937,19.88518,5.18517,16.442,8.14738,5.96269,8.14738,5.96269,1.44254,10.50246,10.73916,7.8595S637.101,382.88158,637.101,382.88158l80.62233-30.06905Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#3f3d56"
                        />
                        <path
                            d="M587.25535,269.147a4.89054,4.89054,0,0,1-3.91317-1.95719l-11.99792-15.99749a4.89185,4.89185,0,1,1,7.82715-5.87l7.84945,10.46514,20.16029-30.24a4.89206,4.89206,0,0,1,8.14088,5.42726l-23.99584,35.99375a4.894,4.894,0,0,1-3.93468,2.177C587.34613,269.14624,587.30074,269.147,587.25535,269.147Z"
                            transform="translate(-328.39033 -133.1994)"
                            fill="#fff"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </main>
</template>
