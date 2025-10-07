<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[]=[
    {
        title: 'Doctor',
        href: '#'
    },
    {
        title: 'List',
        href: '#'
    }
]

</script>


<template>
    <Head title="Doctor List" />
    <AppLayout>

        
    </AppLayout>

</template>
