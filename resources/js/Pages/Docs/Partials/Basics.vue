<script setup>
import { Link } from "@inertiajs/vue3";
import Accordeon from "@/Components/Accordeon.vue";
</script>
<template>
    <div class="w-full bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6">
        <h2 class="h3 mb-4">Basics</h2>
        <Accordeon>
            <template #title><h3 class="h4">Products list</h3></template>
            <p>
                <Link
                    class="text-primary hover:text-primary-focus"
                    href="/product"
                    >Product list</Link
                >
                is the main view for your products. Throug this view you can
                search create and access all of your products.
            </p>
            <h3 class="h4">Creating products</h3>
            <ol class="list-decimal ml-4 pl-4">
                <li>Click plus button in top right corner of product list</li>
                <li>
                    You will be able to fill in:
                    <ul class="list-disc pl-4 ml-4">
                        <li>
                            <span class="font-medium">Name</span> - required,
                            name of the product that identifies it (not
                            localized)
                        </li>
                        <li>
                            <span class="font-medium">Identification code</span>
                            - any public code that identifies the product
                            (mainly used for search purpouses)
                        </li>
                    </ul>
                </li>
                <li>
                    Click "create". The product will be generated and you will
                    be redirected to product detail.
                </li>
            </ol>
            <img
                src="/images/gif-product-create.gif"
                class="w-full bg-gray-600 max-w-full my-4"
            />
        </Accordeon>
        <Accordeon>
            <template #title> <h3 class="h4">Editing products</h3></template>
            <ol class="list-decimal ml-4 pl-4">
                <li>Click pen icon in last column of product list table</li>
                <li>Update the information and than click "edit"</li>
            </ol>
            <img
                src="/images/gif-product-edit.gif"
                class="w-full bg-gray-600 max-w-full my-4"
            />
            <h3 class="h4">Deleting products</h3>
            <p>Click on trash icon in products table last column.</p>
            <p>
                The records are not deleted permanently you can request the
                restoration through support.
            </p>
            <img
                src="/images/gif-product-delete.gif"
                class="w-full bg-gray-600 max-w-full my-4"
            />
        </Accordeon>
        <Accordeon>
            <template #title>
                <h3 class="h4">Adding product information</h3></template
            >
            <ol class="list-decimal ml-4 pl-4">
                <li>
                    If the product does not have any information yet you will
                    see big plus botton, if it already has some information
                    created, you will be able to select "Languages" in top right
                    corner to access the plus button
                </li>
                <li>
                    You will be taken to a page where you will be able to fill
                    in details about the product
                </li>
                <li>
                    You will need to select a language in which the information
                    will be localized.
                </li>
                <li>
                    After that you will be able to add any ammount of sections
                    with WYSIWIG editor.
                </li>
                <li>
                    Fill in the information in given language and then press
                    "create"
                </li>
            </ol>
            <img
                src="/images/gif-info-create.gif"
                class="w-full bg-gray-600 max-w-full my-4"
        /></Accordeon>
        <Accordeon>
            <template #title>
                <h3 class="h4">Editing product information</h3></template
            >
            <ol class="list-decimal ml-4 pl-4">
                <li>
                    Click on languages in top right corner of product and click
                    on pen icon on any of the already created languages.
                </li>
                <li>
                    You will be able to:
                    <ul class="list-disc pl-4 ml-4">
                        <li>update the information and language</li>
                        <li>move sections up and down with arrow buttons</li>
                        <li>delete sections with thrash button</li>
                    </ul>
                </li>
            </ol>
            <img
                src="/images/gif-info-edit.gif"
                class="w-full bg-gray-600 max-w-full my-4"
        /></Accordeon>
        <Accordeon>
            <template #title>
                <h3 class="h4">Deleting products information</h3></template
            >
            <p>
                Click on "languages" in top right corner and then on trash icon
                on given language you want to delete.
            </p>
            <p>
                The records are not deleted permanently you can request the
                restoration through support.
            </p>
            <img
                src="/images/gif-info-delete.gif"
                class="w-full bg-gray-600 max-w-full my-4" />
            <h3 class="h4">Visuals for customers</h3>
            <p>
                Customers see the page without any header and footer to
                disctract them.
            </p>
            <p>They can switch to any other language if they need to.</p>
            <img
                src="/images/gif-switch-language.gif"
                class="w-full bg-gray-600 max-w-full my-4"
        /></Accordeon>
        <Accordeon>
            <template #title>
                <h3 class="h4">Downloading the QR code</h3></template
            >
            <p>
                In products list click a arrow down icon in last column of
                products table.
            </p>
            <p>
                In product detail click QR code button in top right corner.
                Modal with QR code will be opend and you will be able to
                "download" the image in .png format.
            </p>
            <img
                src="/images/gif-qr-download.gif"
                class="w-full bg-gray-600 max-w-full my-4"
        /></Accordeon>

        <h3 class="h4 mt-6">Visuals of the QR code</h3>
        <img src="/qr-address.png" class="w-40 bg-gray-600 max-w-full my-4" />
    </div>
</template>
