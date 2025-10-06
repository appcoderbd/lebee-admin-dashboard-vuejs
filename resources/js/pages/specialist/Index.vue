<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { User, SquarePen, Trash, Stethoscope, FileText, UploadCloud, MoveLeft } from 'lucide-vue-next';


// function index_specialists() {

//     router.visit('/specialists');
// }

// Alert Dialog----
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog"

import { Button } from "@/components/ui/button"

function handleDelete() {
  // 🧹 এখানে ডিলিট লজিক লিখবে
  // যেমন: router.delete(`/specialists/${id}`)
  console.log("Item deleted successfully!");
}

function index_specialists() {
  return { url: '/specialists' };
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Specialist',
        href: '/specialists',
    }

];

function routeToCreate() {
    router.visit('/specialists/create');
}


const search = ref('');

const specialists = ref([
  {
    name: 'Cardiologist',
    description: 'Heart and blood vessel specialist',
    icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966327.png',
  },
  {
    name: 'Dermatologist',
    description: 'Skin and hair specialist',
    icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966338.png',
  },
  {
    name: 'Neurologist',
    description: 'Brain and nervous system specialist',
    icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966352.png',
  },
]);

const filteredSpecialists = computed(() => {
  if (!search.value) return specialists.value;
  return specialists.value.filter((s) =>
    s.name.toLowerCase().includes(search.value.toLowerCase())
  );
});


</script>

<template>
  <Head title="Specialist" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
      <!-- Header -->
      <div class="flex w-full rounded-lg border-b px-4 py-4">
        <div class="text-left text-lg font-medium text-gray-600">
          <h1 class="text-0.5xl font-bold">Manage Specialists</h1>
          <p class="text-sm">View & Update Your Specialist Information</p>
        </div>

        <div class="ml-auto">
          <button
            @click="router.visit('/specialists/create')"
            class="flex items-center gap-1 text-sm rounded-lg bg-gray-700 px-4 py-2 text-white transition hover:bg-gray-800"
          >
            Add New
            <Plus class="h-5 w-5" />
          </button>
        </div>
      </div>

      <!-- Modern Data Table -->
      <div class="bg-white shadow-sm border rounded-lg overflow-hidden">
        <!-- Table Header -->
        <div class="flex justify-between items-center px-4 py-3 border-b bg-gray-50">
          <div class="flex items-center gap-2">
            <h2 class="font-semibold text-gray-700 text-base">Specialist List</h2>
            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-lg border border-gray-500 border-dashed">
              {{ specialists.length }} Total
            </span>
          </div>
          <div>
            <input
              v-model="search"
              type="text"
              placeholder="Search specialist..."
              class="border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
            />
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
              <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Icon</th>
                <th class="px-6 py-3 text-left">Specialty</th>
                <th class="px-6 py-3 text-left">Description</th>
                <th class="px-6 py-3 text-right">Action</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
              <tr
                v-for="(specialist, index) in filteredSpecialists"
                :key="index"
                class="hover:bg-gray-50 transition"
              >
                <td class="px-6 py-4">{{ index + 1 }}</td>
                <td class="px-6 py-4">
                  <img
                    :src="specialist.icon"
                    alt="icon"
                    class="w-10 h-10 rounded-full border"
                  />
                </td>
                <td class="px-6 py-4 font-medium">{{ specialist.name }}</td>
                <td class="px-6 py-4">{{ specialist.description }}</td>
                <td class="px-6 py-4 flex items-center justify-end gap-2">
                    <button
                        class="flex items-center justify-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded-md text-sm transition-all duration-200 shadow-sm"
                        >
                        <SquarePen class="w-4 h-4" />
                        <span>Edit</span>
                    </button>

                    <!-- 🗑️ Delete Button with Alert -->
                    <AlertDialog>
                    <AlertDialogTrigger as-child>
                        <button
                        class="flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm transition-all duration-200 shadow-sm"
                        >
                        <Trash class="w-4 h-4" />
                        <span>Delete</span>
                        </button>
                    </AlertDialogTrigger>

                    <AlertDialogContent>
                        <AlertDialogHeader>
                        <AlertDialogTitle>Are you sure you want to delete?</AlertDialogTitle>
                        <AlertDialogDescription>
                            This action cannot be undone. The specialist data will be permanently removed.
                        </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <AlertDialogAction @click="handleDelete">
                            Yes, Delete
                        </AlertDialogAction>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                    </AlertDialog>
                </td>
              </tr>

              <!-- Empty State -->
              <tr v-if="filteredSpecialists.length === 0">
                <td colspan="5" class="text-center py-6 text-gray-500 text-sm">
                  No specialists found
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
