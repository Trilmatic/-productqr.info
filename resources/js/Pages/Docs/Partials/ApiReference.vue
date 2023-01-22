<script setup>
import { Link } from "@inertiajs/vue3";
import Accordeon from "@/Components/Accordeon.vue";
</script>
<template>
    <div class="w-full bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6">
        <h2 class="h4 mb-4">
            API reference
            <span
                class="p-2 bg-primary rounded-lg font-medium text-base text-white ml-4"
                >v1</span
            >
        </h2>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/language</span>
                    <span
                        class="p-2 bg-secondary rounded-lg font-medium text-base text-white ml-4"
                        >GET</span
                    >
                </p></template
            >
            <p>Returns array of all available languages</p>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product</span>
                    <span
                        class="p-2 bg-secondary rounded-lg font-medium text-base text-white ml-4"
                        >GET</span
                    >
                </p></template
            >
            <p>Returns array of all products of the authenticated account.</p>
            <p class="font-medium uppercase mt-2">Parameters:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>
                    limit <i>(number)</i> - limits the ammount of returned
                    products
                </li>
            </ul>
            <p class="font-medium uppercase mt-2">Returns: [ ]</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>hash</li>
                <li>name</li>
                <li>identification_code</li>
                <li>qr_code</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    [ { "id": 1, "hash": "LEkL6zdV", "name": "Product name",
                    "identification_code": "Product identification code",
                    "qr_code": "link to generated product qr code", "user_id":
                    1, "created_at": "2023-01-20T16:24:47.000000Z",
                    "updated_at": "2023-01-20T16:24:48.000000Z", "deleted_at":
                    null }, ]
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/store</span>
                    <span
                        class="p-2 bg-primary rounded-lg font-medium text-base text-white ml-4"
                        >POST</span
                    >
                </p></template
            >
            <p>
                Saves a product and generates a qr for it. Returns an object of
                newly created product.
            </p>
            <p class="font-medium uppercase mt-2">Parameters:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>name <i>(string)</i> *required - name of the product</li>
                <li>
                    identification_code <i>(string)</i> - identification code of
                    the product
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "name": "Product name", "identification_code":
                    "Identification code" } ] }
                </code>
            </div>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>hash</li>
                <li>name</li>
                <li>identification_code</li>
                <li>qr_code</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "hash": "LEkL6zdV", "name": "Product name",
                    "identification_code": "Product identification code",
                    "qr_code": "link to generated product qr code", "user_id":
                    1, "created_at": "2023-01-20T16:24:47.000000Z",
                    "updated_at": "2023-01-20T16:24:48.000000Z", "deleted_at":
                    null }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/{hash}</span>
                    <span
                        class="p-2 bg-secondary rounded-lg font-medium text-base text-white ml-4"
                        >GET</span
                    >
                </p></template
            >
            <p>Gets data from product by hash.</p>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>hash</li>
                <li>name</li>
                <li>identification_code</li>
                <li>qr_code</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "hash": "LEkL6zdV", "name": "Product name",
                    "identification_code": "Product identification code",
                    "qr_code": "link to generated product qr code", "user_id":
                    1, "created_at": "2023-01-20T16:24:47.000000Z",
                    "updated_at": "2023-01-20T16:24:48.000000Z", "deleted_at":
                    null }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/{hash}/update</span>
                    <span
                        class="p-2 bg-primary rounded-lg font-medium text-base text-white ml-4"
                        >PUT</span
                    >
                </p></template
            >
            <p>Updates information about product.</p>
            <p class="font-medium uppercase mt-2">Parameters:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>name <i>(string)</i> *required - name of the product</li>
                <li>
                    identification_code <i>(string)</i> - identification code of
                    the product
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "name": "Product name", "identification_code":
                    "Identification code" } ] }
                </code>
            </div>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>hash</li>
                <li>name</li>
                <li>identification_code</li>
                <li>qr_code</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "hash": "LEkL6zdV", "name": "Product name",
                    "identification_code": "Product identification code",
                    "qr_code": "link to generated product qr code", "user_id":
                    1, "created_at": "2023-01-20T16:24:47.000000Z",
                    "updated_at": "2023-01-20T16:24:48.000000Z", "deleted_at":
                    null }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/{hash}/delete</span>
                    <span
                        class="p-2 bg-error rounded-lg font-medium text-base text-white ml-4"
                        >DELETE</span
                    >
                </p></template
            >
            <p>Deletes product.</p>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code> Success </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/{hash}/info</span>
                    <span
                        class="p-2 bg-secondary rounded-lg font-medium text-base text-white ml-4"
                        >GET</span
                    >
                </p></template
            >
            <p>Return a product with list of product informations.</p>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>hash</li>
                <li>name</li>
                <li>identification_code</li>
                <li>qr_code</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
                <li>product_infos</li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "hash": "LEkL6zdV", "name": "Product name",
                    "identification_code": "Product identification code",
                    "qr_code": "link to generated product qr code", "user_id":
                    1, "created_at": "2023-01-20T16:24:47.000000Z",
                    "updated_at": "2023-01-20T16:24:48.000000Z", "deleted_at":
                    null, product_infos: [] }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/{hash}/info/store</span>
                    <span
                        class="p-2 bg-primary rounded-lg font-medium text-base text-white ml-4"
                        >POST</span
                    >
                </p></template
            >
            <p>
                Saves a product information and assignes it to a given product
                based on hash in URL. Returns an object of newly created product
                information.
            </p>
            <p class="font-medium uppercase mt-2">Parameters:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>
                    language_id <i>(number)</i> *required - id of language that
                    the info belongs to
                </li>
                <li>
                    sections <i>(array)</i> - array of the sections of the
                    product information
                    <ul class="list-disc ml-4 pl-4">
                        <li>
                            title <i>(string)</i> *required - title of the
                            section
                        </li>
                        <li>
                            sort <i>(number)</i> *required - the index of the
                            section for sort purposes
                        </li>
                        <li>
                            content <i>(string)</i> - html content as a string
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "language_id": 1, "sections": [ { "title": "Section
                    title", "sort": 1, "content": "&lt;p&gt;content&lt;/p&gt;" }
                    ] }
                </code>
            </div>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>language_id</li>
                <li>product_id</li>
                <li>hash</li>
                <li>name</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
                <li>
                    sections [ ]
                    <ul class="list-disc ml-4 pl-4">
                        <li>id</li>
                        <li>product_info_id</li>
                        <li>user_id</li>
                        <li>hash</li>
                        <li>sort</li>
                        <li>title</li>
                        <li>content</li>
                        <li>created_at</li>
                        <li>updated_at</li>
                        <li>deleted_at</li>
                    </ul>
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "language_id": 1, "product_id": 1, "user_id": 1,
                    "hash": "LEkL6zdV", "created_at":
                    "2023-01-22T16:24:00.000000Z", "updated_at":
                    "2023-01-22T16:24:00.000000Z", "deleted_at": null,
                    "sections": [ { "id": 1, "product_info_id": 1, "user_id": 1,
                    "hash": "LEkL6zdV", "sort": 1, "title": "Section title",
                    "content": "content", "created_at":
                    "2023-01-22T16:24:00.000000Z", "updated_at":
                    "2023-01-22T16:24:00.000000Z", "deleted_at": null } ] }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/info/{hash}</span>
                    <span
                        class="p-2 bg-secondary rounded-lg font-medium text-base text-white ml-4"
                        >GET</span
                    >
                </p></template
            >
            <p>Gets data from product info by hash.</p>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>language_id</li>
                <li>product_id</li>
                <li>hash</li>
                <li>name</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
                <li>
                    sections [ ]
                    <ul class="list-disc ml-4 pl-4">
                        <li>id</li>
                        <li>product_info_id</li>
                        <li>user_id</li>
                        <li>hash</li>
                        <li>sort</li>
                        <li>title</li>
                        <li>content</li>
                        <li>created_at</li>
                        <li>updated_at</li>
                        <li>deleted_at</li>
                    </ul>
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "language_id": 1, "product_id": 1, "user_id": 1,
                    "hash": "LEkL6zdV", "created_at":
                    "2023-01-22T16:24:00.000000Z", "updated_at":
                    "2023-01-22T16:24:00.000000Z", "deleted_at": null,
                    "sections": [ { "id": 1, "product_info_id": 1, "user_id": 1,
                    "hash": "LEkL6zdV", "sort": 1, "title": "Section title",
                    "content": "content", "created_at":
                    "2023-01-22T16:24:00.000000Z", "updated_at":
                    "2023-01-22T16:24:00.000000Z", "deleted_at": null } ] }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/info/{hash}/update</span>
                    <span
                        class="p-2 bg-primary rounded-lg font-medium text-base text-white ml-4"
                        >PUT</span
                    >
                </p></template
            >
            <p>Updates a product information and its sections.</p>
            <p class="font-medium uppercase mt-2">Parameters:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>
                    language_id <i>(number)</i> *required - id of language that
                    the info belongs to
                </li>
                <li>
                    sections <i>(array)</i> - array of the sections of the
                    product information
                    <ul class="list-disc ml-4 pl-4">
                        <li>
                            title <i>(string)</i> *required - title of the
                            section
                        </li>
                        <li>
                            sort <i>(number)</i> *required - the index of the
                            section for sort purposes
                        </li>
                        <li>
                            content <i>(string)</i> - html content as a string
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "language_id": 1, "sections": [ { "title": "Section
                    title", "sort": 1, "content": "&lt;p&gt;content&lt;/p&gt;" }
                    ] }
                </code>
            </div>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <ul class="list-disc ml-4 pl-4">
                <li>id</li>
                <li>language_id</li>
                <li>product_id</li>
                <li>hash</li>
                <li>name</li>
                <li>user_id</li>
                <li>created_at</li>
                <li>updated_at</li>
                <li>deleted_at</li>
                <li>
                    sections [ ]
                    <ul class="list-disc ml-4 pl-4">
                        <li>id</li>
                        <li>product_info_id</li>
                        <li>user_id</li>
                        <li>hash</li>
                        <li>sort</li>
                        <li>title</li>
                        <li>content</li>
                        <li>created_at</li>
                        <li>updated_at</li>
                        <li>deleted_at</li>
                    </ul>
                </li>
            </ul>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code>
                    { "id": 1, "language_id": 1, "product_id": 1, "user_id": 1,
                    "hash": "LEkL6zdV", "created_at":
                    "2023-01-22T16:24:00.000000Z", "updated_at":
                    "2023-01-22T16:24:00.000000Z", "deleted_at": null,
                    "sections": [ { "id": 1, "product_info_id": 1, "user_id": 1,
                    "hash": "LEkL6zdV", "sort": 1, "title": "Section title",
                    "content": "content", "created_at":
                    "2023-01-22T16:24:00.000000Z", "updated_at":
                    "2023-01-22T16:24:00.000000Z", "deleted_at": null } ] }
                </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/info/{hash}/delete</span>
                    <span
                        class="p-2 bg-error rounded-lg font-medium text-base text-white ml-4"
                        >DELETE</span
                    >
                </p></template
            >
            <p>Deletes product information.</p>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code> Success </code>
            </div>
        </Accordeon>
        <Accordeon>
            <template #title
                ><p class="flex items-center">
                    <span>/api/v1/product/section/{hash}/delete</span>
                    <span
                        class="p-2 bg-error rounded-lg font-medium text-base text-white ml-4"
                        >DELETE</span
                    >
                </p></template
            >
            <p>Deletes produt information section.</p>
            <p class="font-medium uppercase mt-2">Returns:</p>
            <div class="bg-black p-2 rounded-lg mt-4 text-white">
                <code> Success </code>
            </div>
        </Accordeon>
    </div>
</template>
