<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { User } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] =[
    {
        title: 'Doctors',
        href: '#'
    },
    {
        title: 'Create',
        href: '#'
    }
];


</script>

<template>
    <Head title="Doctors Create" />
    <AppLayout>

    </AppLayout>

</template>
