<script lang="ts" setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { User, SquarePen, Trash, Stethoscope, FileText, UploadCloud, MoveLeft } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[]=[
    {
        title: 'Hospital',
        href: '/hospitals'
    },
        {
        title: 'List',
        href: ''
    }
];

</script>

<template>
    <Head title="Create Specialist" />
    <AppLayout :breadcrumbs="breadcrumbs">



    </AppLayout>
</template>
