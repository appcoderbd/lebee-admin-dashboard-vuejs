<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';


// function index_specialists() {

//     router.visit('/specialists');
// }

function index_specialists() {
  return { url: '/specialists' };
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Specialist',
        href: '/specialists',
    },
    {
        title: 'Create',
        href: '/specialists/create',
    },
];

function routeToCreate() {
    router.visit('/specialists/create');
}


</script>

<template>
    <Head title="Specialist" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="flex w-full rounded-lg border-b px-4 py-4">
                <!-- Content for Specialist page goes here -->
                <div class="text-left text-lg font-medium text-gray-600">
                    <h1 class="text-0.5xl font-bold">Manage Specialists</h1>
                    <p class="text-sm">
                        View & Update Your Specialist Information
                    </p>
                </div>

                <div class="ml-auto">
                    <button
                        @click="router.visit('/specialists/create')"
                        class="flex items-center gap-1 text-sm rounded-lg bg-gray-700 px-4 py-2 text-white transition hover:bg-gary-800"
                    >
                        Add New
                        <Plus class="h-5 w-5" />
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
