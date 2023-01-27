<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <div class="w-full bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6">
        <h2 class="h4">API basics</h2>
        <p>
            Product info offers a web API to a PRO plan users, with which you
            can manage the products and integrate with other internal systems.
        </p>
        <h3 class="h4 mt-4">General info</h3>
        <ul class="list-disc ml-4 pl-4">
            <li>UTF-8 encoding is used in every request and server response</li>
            <li>Only JSON format is used in every request and response</li>
            <li>
                Usage of this API is limited. You can make 60 requests/minute,
                10000 requests/month. If you need more contact us at
                <a
                    href="mailto:hello@productqr.info"
                    class="text-warning hover:text-warning-focus"
                    >hello@productqr.info</a
                >.
            </li>
        </ul>
        <h3 class="h4 mt-4">Responses</h3>
        <ul class="list-disc ml-4 pl-4">
            <li>
                <strong>200</strong> - Request successful. More information is
                returned in json object. Object schema depends on method.
            </li>
            <li>
                <strong>201</strong> - Request successful. No result returned.
            </li>
            <li>
                <strong>400</strong> - Error occurred. Additional information
                provided in json response (ErrorResponse format: more info
                below)
            </li>
            <li>
                <strong>401</strong> - Authentication failure. There are two
                possible reasons: disabled API access or invalid ApiKey provided
            </li>
            <li><strong>403</strong> - Access forbidden</li>
            <li><strong>404</strong> - Invalid method URL</li>
            <li>
                <strong>405</strong> - HTTP method not allowed, please verify
                HTTP method of the request
            </li>
            <li>
                <strong>429</strong> - Too many requests in a given amount of
                time.
            </li>
            <li>
                <strong>5xx</strong> - Something wrong happened in ProductQR
                backend. Please wait a while and repeat your request. If error
                still occurs, please contact us.
            </li>
        </ul>
        <h3 class="h4 mt-4">Terms of use and changes policy and versioning</h3>
        <p class="mt-2">
            The API is versioned to prevent errors occuring from changes or
            upgades. Current version is
            <strong class="text-secondary">v1</strong>. Any changes will be
            released in v2 to prevent integration errors.
        </p>
        <p class="mt-2">
            Please read the
            <Link
                class="text-primary hover:text-primary-focus"
                href="/user/api-tokens"
                >terms of service</Link
            >
            for more information.
        </p>
    </div>
</template>
