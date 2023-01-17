<script setup>
import { ref, reactive } from "vue";
import ActionSection from "@/Components/ActionSection.vue";
</script>
<template>
    <ActionSection>
        <template #title> Subscription </template>
        <template #description></template>
        <template #content></template>
    </ActionSection>
    <ActionSection class="mt-6">
        <template #title> Billing information </template>
        <template #description></template>
        <template #content></template>
    </ActionSection>
    <ActionSection class="mt-6">
        <template #title> Payment method </template>
        <template #description></template>
        <template #content></template>
    </ActionSection>
</template>
