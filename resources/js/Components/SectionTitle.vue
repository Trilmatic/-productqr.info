<template>
    <div class="md:col-span-1 flex justify-between w-full">
        <div class="px-4 sm:px-0 w-full">
            <h3 class="text-lg font-medium">
                <slot name="title" />
            </h3>

            <p class="mt-1 text-sm mb-4">
                <slot name="description" />
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside" />
        </div>
    </div>
</template>
