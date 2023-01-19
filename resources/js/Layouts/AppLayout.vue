<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    Inertia.post(route("logout"));
};
</script>

<template>
    <div class="font-aspekta antialiased font-[350]">
        <Head :title="title" />
        <Banner />

        <div class="flex flex-col min-h-screen overflow-hidden">
            <nav class="absolute w-full z-30">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
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

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                                v-if="$page.props.user"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    :href="route('product.index')"
                                    :active="$page.url.startsWith('/product')"
                                >
                                    Product
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <div v-if="!$page.props.user" class="space-x-4">
                                    <Link
                                        :href="route('login')"
                                        class="text-sm underline"
                                        >Log in</Link
                                    >

                                    <Link
                                        :href="route('register')"
                                        class="text-sm underline"
                                        >Register</Link
                                    >
                                </div>
                                <!-- Teams Dropdown -->
                                <Dropdown
                                    v-if="$page.props.jetstream.hasTeamFeatures"
                                    align="right"
                                    width="60"
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                            >
                                                {{
                                                    $page.props.user
                                                        .current_team.name
                                                }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template
                                                v-if="
                                                    $page.props.jetstream
                                                        .hasTeamFeatures
                                                "
                                            >
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <DropdownLink
                                                    :href="
                                                        route(
                                                            'teams.show',
                                                            $page.props.user
                                                                .current_team
                                                        )
                                                    "
                                                >
                                                    Team Settings
                                                </DropdownLink>

                                                <DropdownLink
                                                    v-if="
                                                        $page.props.jetstream
                                                            .canCreateTeams
                                                    "
                                                    :href="
                                                        route('teams.create')
                                                    "
                                                >
                                                    Create New Team
                                                </DropdownLink>

                                                <div
                                                    class="border-t border-gray-100 dark:border-gray-700"
                                                />

                                                <!-- Team Switcher -->
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Switch Teams
                                                </div>

                                                <template
                                                    v-for="team in $page.props
                                                        .user.all_teams"
                                                    :key="team.id"
                                                >
                                                    <form
                                                        @submit.prevent="
                                                            switchToTeam(team)
                                                        "
                                                    >
                                                        <DropdownLink
                                                            as="button"
                                                        >
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <svg
                                                                    v-if="
                                                                        team.id ==
                                                                        $page
                                                                            .props
                                                                            .user
                                                                            .current_team_id
                                                                    "
                                                                    class="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                    />
                                                                </svg>
                                                                <div>
                                                                    {{
                                                                        team.name
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative" v-if="$page.props.user">
                                <div v-if="!$page.props.user">
                                    <NavLink
                                        :href="route('login')"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline"
                                        >Log in</NavLink
                                    >

                                    <NavLink
                                        v-if="canRegister"
                                        :href="route('register')"
                                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                                        >Register</NavLink
                                    >
                                </div>
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover"
                                                :src="
                                                    $page.props.user
                                                        .profile_photo_url
                                                "
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <span
                                            v-else
                                            class="inline-flex rounded-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                            >
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Manage Account
                                        </div>

                                        <DropdownLink
                                            :href="route('profile.show')"
                                        >
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink
                                            v-if="
                                                $page.props.jetstream
                                                    .hasApiFeatures
                                            "
                                            :href="route('api-tokens.index')"
                                        >
                                            API Tokens
                                        </DropdownLink>

                                        <div
                                            class="border-t border-gray-100 dark:border-gray-600"
                                        />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden bg-gray-100 dark:bg-gray-800 shadow-lg"
                >
                    <div class="pt-2 pb-3 space-y-1" v-if="$page.props.user">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('product.index')"
                            :active="$page.url.startsWith('/product')"
                        >
                            Product
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1" v-else>
                        <ResponsiveNavLink
                            :href="route('login')"
                            :active="route().current('login')"
                        >
                            Login
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('register')"
                            :active="route().current('register')"
                        >
                            Register
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600"
                        v-if="$page.props.user"
                    >
                        <div class="flex items-center px-4">
                            <div
                                v-if="
                                    $page.props.jetstream.managesProfilePhotos
                                "
                                class="shrink-0 mr-3"
                            >
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    :src="$page.props.user.profile_photo_url"
                                    :alt="$page.props.user.name"
                                />
                            </div>

                            <div>
                                <div
                                    class="font-medium text-base text-gray-800 dark:text-gray-200"
                                >
                                    {{ $page.props.user.name }}
                                </div>
                                <div
                                    class="font-medium text-sm text-gray-500 dark:text-gray-400"
                                >
                                    {{ $page.props.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                            >
                                Profile
                            </ResponsiveNavLink>

                            <ResponsiveNavLink
                                v-if="$page.props.jetstream.hasApiFeatures"
                                :href="route('api-tokens.index')"
                                :active="route().current('api-tokens.index')"
                            >
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template
                                v-if="$page.props.jetstream.hasTeamFeatures"
                            >
                                <div class="border-t border-gray-200" />

                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink
                                    :href="
                                        route(
                                            'teams.show',
                                            $page.props.user.current_team
                                        )
                                    "
                                    :active="route().current('teams.show')"
                                >
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink
                                    v-if="$page.props.jetstream.canCreateTeams"
                                    :href="route('teams.create')"
                                    :active="route().current('teams.create')"
                                >
                                    Create New Team
                                </ResponsiveNavLink>

                                <div class="border-t border-gray-200" />

                                <!-- Team Switcher -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Switch Teams
                                </div>

                                <template
                                    v-for="team in $page.props.user.all_teams"
                                    :key="team.id"
                                >
                                    <form @submit.prevent="switchToTeam(team)">
                                        <ResponsiveNavLink as="button">
                                            <div class="flex items-center">
                                                <svg
                                                    v-if="
                                                        team.id ==
                                                        $page.props.user
                                                            .current_team_id
                                                    "
                                                    class="mr-2 h-5 w-5 text-green-400"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    />
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </ResponsiveNavLink>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="grow">
                <slot />
            </main>
            <footer class="relative">
                <!-- Bg -->
                <div
                    class="absolute inset-0 bg-blue-600 -z-10"
                    aria-hidden="true"
                ></div>

                <!-- Illustration -->
                <div
                    class="absolute hidden bottom-0 left-1/2 -translate-x-1/2 pointer-events-none -z-10"
                    aria-hidden="true"
                >
                    <img
                        class="max-w-none"
                        src="/images/footer-illustration.svg"
                        width="2336"
                        height="421"
                    />
                </div>

                <div class="max-w-6xl mx-auto px-4 sm:px-6">
                    <!-- Blocks -->
                    <div
                        class="grid sm:grid-cols-12 lg:grid-cols-10 gap-8 py-8 border-t border-blue-500"
                    >
                        <!-- 1st block -->
                        <div class="sm:col-span-12 lg:col-span-2 lg:max-w-xs">
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

                        <!-- 2nd block -->
                        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
                            <h6
                                class="text-xs text-gray-100 font-bold uppercase mb-3"
                            >
                                Essentials
                            </h6>
                            <ul class="text-sm space-y-2">
                                <li>
                                    <Link
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="/subscriptions"
                                        >Subscriptions</Link
                                    >
                                </li>
                                <li v-if="$page.props.user">
                                    <Link
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="/user/payments"
                                        >Payments</Link
                                    >
                                </li>
                                <li v-if="$page.props.user">
                                    <Link
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="/user/profile"
                                        >Settings</Link
                                    >
                                </li>
                            </ul>
                        </div>

                        <!-- 3rd block -->
                        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
                            <h6
                                class="text-xs text-gray-100 font-bold uppercase mb-3"
                            >
                                Company
                            </h6>
                            <ul class="text-sm space-y-2">
                                <li>
                                    <Link
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="/about-us"
                                        >About us</Link
                                    >
                                </li>
                                <li>
                                    <a
                                        href="mailto:hello@productqr.info"
                                        class="text-warning hover:text-warning-focus"
                                        >hello@productqr.info</a
                                    >
                                </li>
                            </ul>
                        </div>

                        <!-- 5th block -->
                        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
                            <h6
                                class="text-xs text-gray-100 font-bold uppercase mb-3"
                            >
                                Resources
                            </h6>
                            <ul class="text-sm space-y-2">
                                <li>
                                    <a
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="#0"
                                        >Documentation</a
                                    >
                                </li>
                                <li>
                                    <Link
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="/terms-of-service"
                                        >Terms of service</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        class="text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                        href="/privacy-policy"
                                        >Privacy policy</Link
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom area -->
                    <div
                        class="md:flex md:items-center md:justify-between pb-4 md:pb-8"
                    >
                        <!-- Social links -->
                        <ul class="flex mb-4 md:order-1 md:ml-4 md:mb-0">
                            <li>
                                <a
                                    class="flex justify-center items-center text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                    href="#0"
                                    aria-label="Twitter"
                                >
                                    <svg
                                        class="w-8 h-8 fill-current"
                                        viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M24 11.5c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4 0 1.6 1.1 2.9 2.6 3.2-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H8c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4c.7-.5 1.3-1.1 1.7-1.8z"
                                        />
                                    </svg>
                                </a>
                            </li>
                            <li class="ml-2">
                                <a
                                    class="flex justify-center items-center text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                    href="#0"
                                    aria-label="Github"
                                >
                                    <svg
                                        class="w-8 h-8 fill-current"
                                        viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M16 8.2c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.6.4.1.5-.2.5-.4V22c-2.2.5-2.7-1-2.7-1-.4-.9-.9-1.2-.9-1.2-.7-.5.1-.5.1-.5.8.1 1.2.8 1.2.8.7 1.3 1.9.9 2.3.7.1-.5.3-.9.5-1.1-1.8-.2-3.6-.9-3.6-4 0-.9.3-1.6.8-2.1-.1-.2-.4-1 .1-2.1 0 0 .7-.2 2.2.8.6-.2 1.3-.3 2-.3s1.4.1 2 .3c1.5-1 2.2-.8 2.2-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 3.1-1.9 3.7-3.7 3.9.3.4.6.9.6 1.6v2.2c0 .2.1.5.6.4 3.2-1.1 5.5-4.1 5.5-7.6-.1-4.4-3.7-8-8.1-8z"
                                        />
                                    </svg>
                                </a>
                            </li>
                            <li
                                class="ml-2 w-8 h-8 flex justify-center items-center"
                            >
                                <a
                                    class="block text-blue-300 hover:text-white transition duration-150 ease-in-out"
                                    href="#0"
                                    aria-label="Discord"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 fill-current"
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
                                        <circle cx="9" cy="12" r="1"></circle>
                                        <circle cx="15" cy="12" r="1"></circle>
                                        <path
                                            d="M7.5 7.5c3.5 -1 5.5 -1 9 0"
                                        ></path>
                                        <path
                                            d="M7 16.5c3.5 1 6.5 1 10 0"
                                        ></path>
                                        <path
                                            d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-1 2.5"
                                        ></path>
                                        <path
                                            d="M8.5 17c0 1 -1.356 3 -1.832 3c-1.429 0 -2.698 -1.667 -3.333 -3c-.635 -1.667 -.476 -5.833 1.428 -11.5c1.388 -1.015 2.782 -1.34 4.237 -1.5l1 2.5"
                                        ></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>

                        <!-- Copyrights -->
                        <div class="text-sm text-blue-300">
                            © productqr.info All rights reserved.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
