<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <div class="w-full bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6">
        <h2 class="h4">API setup</h2>
        <p>
            For API access we use <strong>Bearer Authentication</strong>. You
            can generate a security tokens for your account and give specific
            permissions to them. After you have the token you must send this
            token in the Authorization header when making requests to protected
            resources:
        </p>
        <div class="mt-4 text-white">
            <code class="bg-black p-2 rounded-lg"
                ><span class="text-blue-500">Authorization</span
                ><span class="pun">:</span><span class="pln"> </span
                ><span class="typ ml-2 text-blue-500">Bearer</span
                ><span class="pln"> </span
                ><span class="text-orange-500 ml-2">&lt;token&gt;</span></code
            >
        </div>
        <h3 class="h4 mt-4">Generating tokens</h3>
        <p>
            You can generate and manage tokens through
            <Link
                class="text-primary hover:text-primary-focus"
                href="/user/api-tokens"
                >API token manager</Link
            >.
        </p>
        <p class="mt-2">
            To create token, just fill in the name and permissions that you want
            to give to that token and hit "create". Modal with the token will
            appear and you can copy it into the clipboard.
        </p>
        <p class="mt-2">
            <strong
                >Make sure you save the token somewhere because you will not be
                able to see it anymore after you close the modal.</strong
            >
            You will be able to manage the permission or delete the token at any
            time.
        </p>
        <img
            src="/images/gif-token-create.gif"
            class="w-full bg-gray-600 max-w-full my-4"
        />
    </div>
</template>
