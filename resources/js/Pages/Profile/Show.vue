<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import Billing from "@/Pages/Profile/Partials/Billing.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
    subscription: Object,
    payment_method: Object,
    billing_details: Object,
    stripe_key: String,
    intent: Object,
});

const tab = ref("profile");

onMounted(() => {
    if (window.location.hash) tab.value = window.location.hash.substring(1);
});
</script>

<template>
    <AppLayout title="Profile">
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
        <div>
            <div class="max-w-7xl mx-auto py-10 px-2 sm:px-6 lg:px-8 space-y-5">
                <div class="flex flex-wrap md:flex-nowrap mt-8">
                    <aside class="w-full md:w-64 pb-8">
                        <div
                            class="px-3 py-4 overflow-y-auto rounded-lg bg-gray-50 dark:bg-gray-800 md:sticky md:top-0"
                        >
                            <ul class="space-y-2 list-none pl-0">
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'profile'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        @click="tab = 'profile'"
                                    >
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'billing'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#billing"
                                        @click="tab = 'billing'"
                                    >
                                        <span>Billing</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'password'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        href="#password"
                                        @click="tab = 'password'"
                                    >
                                        <span>Update password</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'twofactor'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        @click="tab = 'twofactor'"
                                        href="#twofactor"
                                    >
                                        <span>Two Factor Authentication</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'browser'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        @click="tab = 'browser'"
                                        href="#browser"
                                    >
                                        <span>Browser Sessions</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer"
                                        :class="
                                            tab === 'delete'
                                                ? 'bg-gray-100 dark:bg-gray-700'
                                                : ''
                                        "
                                        @click="tab = 'delete'"
                                        href="#delete"
                                    >
                                        <span>Delete Account</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <article class="md:pl-4 w-full">
                        <div
                            v-if="
                                $page.props.jetstream
                                    .canUpdateProfileInformation
                            "
                            v-show="tab === 'profile'"
                        >
                            <UpdateProfileInformationForm
                                :user="$page.props.user"
                            />
                        </div>

                        <div v-show="tab === 'billing'">
                            <Billing
                                :billing_details="billing_details"
                                :subscription="subscription"
                                :payment_method="payment_method"
                                :locale="$page.props.locale"
                                :stripe_key="stripe_key"
                                :intent="intent"
                            />
                        </div>

                        <div
                            v-if="$page.props.jetstream.canUpdatePassword"
                            v-show="tab === 'password'"
                        >
                            <UpdatePasswordForm />
                        </div>

                        <div
                            v-if="
                                $page.props.jetstream
                                    .canManageTwoFactorAuthentication
                            "
                            v-show="tab === 'twofactor'"
                        >
                            <TwoFactorAuthenticationForm
                                :requires-confirmation="
                                    confirmsTwoFactorAuthentication
                                "
                            />
                        </div>

                        <LogoutOtherBrowserSessionsForm
                            v-show="tab === 'browser'"
                            :sessions="sessions"
                        />

                        <template
                            v-if="
                                $page.props.jetstream.hasAccountDeletionFeatures
                            "
                        >
                            <DeleteUserForm v-show="tab === 'delete'" />
                        </template>
                    </article>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
