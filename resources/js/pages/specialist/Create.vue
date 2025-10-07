<script lang="ts" setup>
defineProps(['specialist'])
// defineProps({
//   specialist: Object,
// });
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Stethoscope, FileText, UploadCloud, MoveLeft, Trash, SquarePen } from 'lucide-vue-next';
import { Button } from "@/components/ui/button";
import { toast } from 'vue-sonner'
import { Link } from '@inertiajs/vue3';



// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Specialist', href: '/specialists' },
  { title: 'Create', href: '/specialists/create' },
];

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
import specialists from '@/routes/specialists';

function handleDelete() {

    // 🧹 এখানে ডিলিট লজিক লিখবে // যেমন:
    // router.delete(/specialists/${id})
    console.log("Item deleted successfully!");
}

function back_page() {
  router.visit('/specialists');
}

// Inertia Form
const form = useForm({
  specialist_name: '',
  description: '',
  icon: null as File | null,
});

const fileInput = ref<HTMLInputElement | null>(null);
const iconPreview = ref<string | null>(null);

function selectFile() {
  fileInput.value?.click();
}

function previewIcon(event: Event) {
  const target = event.target as HTMLInputElement;
  const file = target.files?.[0];
  if (file) {
    form.icon = file;
    iconPreview.value = URL.createObjectURL(file);
  }
}


function submitForm() {
  const data = new FormData();
  data.append('specialist_name', form.specialist_name);
  data.append('description', form.description || '');
  if (form.icon) {
    data.append('icon', form.icon);
  }

  router.post('/specialists', data, {
    onSuccess: () => {
      // ✅ toast success
      toast.success('✅ Specialist created successfully!')
      form.reset()
      iconPreview.value = null
    },
    onError: (errors) => {
      console.error(errors)
      // ✅ toast error
      toast.error('❌ Something went wrong! Please check your inputs.')
    },
  });
}
</script>


<template>
    <Head title="Create Specialist" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">

            <div class="w-full flex px-4 py-4 rounded-lg border-b">
                <!-- Content for Create Specialist page goes here -->
                <div class="text-left text-lg font-medium text-gray-600">
                    <h1 class="text-0.5xl font-bold">Add New Specialist</h1>
                    <p
                        @click="back_page"
                        class="text-sm flex items-center gap-1 text-gray-600 hover:underline cursor-pointer"
                    >
                        <MoveLeft class="h-5 w-5"/>
                        Manage Specialist
                    </p>
                </div>
            </div>

            <div class="w-full px-4 py-4 rounded-lg">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mb-4">
                    <div class="mt-4 w-xl rounded-lg p-6 border border-gray-300 border-dashed">
                        <h2 class="font-medium text-gray-600 mb-5">Complete the Form</h2>
                        <form class="space-y-4" @submit.prevent="submitForm">
                            <div>
                                <label for="specialty" class="block text-sm font-medium text-gray-700">Specialty</label>
                                <div class="mt-1 w-lg relative">
                                    <Stethoscope class="absolute left-3 top-3 text-gray-400 w-5 h-5" />
                                    <input
                                        type="text"
                                        id="specialty"
                                        v-model="form.specialist_name"
                                        placeholder="Enter specialty"
                                        class="pl-10 py-3 px-3 w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    />
                                </div>
                            </div>
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Descriptions</label>
                                <div class="mt-1 w-lg relative">
                                    <FileText class="absolute left-3 top-3 text-gray-400 w-5 h-5" />
                                    <textarea
                                        type="text"
                                        id="content"
                                        v-model="form.description"
                                        placeholder="Enter descriptions"
                                        class="pl-10 py-3 px-3 w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    ></textarea>
                                </div>
                            </div>
                            <!-- Icon Upload -->
                            <div class="w-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                                <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center text-center cursor-pointer hover:border-blue-500 transition"
                                @click="selectFile"
                                >
                                <input
                                    ref="fileInput"
                                    type="file"
                                    accept="image/*"
                                    class="hidden"
                                    @change="previewIcon"
                                />
                                <div v-if="iconPreview">
                                    <img :src="iconPreview" alt="Preview" class="w-16 h-16 object-cover rounded-lg mb-2" />
                                    <p class="text-sm text-gray-500">Click to change icon</p>
                                </div>
                                <div v-else>
                                    <UploadCloud class="w-10 h-10 text-gray-400 mb-2" />
                                    <p class="text-sm text-gray-500">Click to upload an icon</p>
                                </div>
                                </div>
                            </div>
                            <div class="pt-4 flex space-x-4">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Saved
                                </button>

                                <button type="button" @click="back_page" class="inline-flex justify-center rounded-md border border-transparent bg-gray-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    Cancel
                                </button>
                            </div>

                        </form>
                    </div>

                    <div class="bg-gray-10 rounded-lg mt-4 p-6 border border-gray-300 border-dashed">
                        <div class="flex" >
                            <h2 class="font-medium text-gray-600 mb-5">Top Specialist List</h2>
                        </div>

                        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-sm border-b-1 border-gray-400">
                                <tr>
                                <th class="px-6 py-3 text-sm text-left font-semibold">Icon</th>
                                <th class="px-6 py-3 text-sm text-left font-semibold">Specialty</th>
                                <th class="px-6 py-3 text-sm text-left font-semibold">Descriptions</th>
                                <th class="px-6 py-3 text-sm text-right font-semibold">Action</th>
                                </tr>
                            </thead>
                                <tbody class="divide-y divide-gray-200 text-gray-800">
                                    <tr class="hover:bg-gray-50 transition" v-for="specialists in specialist">
                                        <td class="px-6 py-4">
                                            <img :src="`/${specialists.icon}`" alt="icon" class="w-10 h-10 rounded-full object-cover">
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-sm">{{ specialists.specialist_name }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-sm max-w-[200px] truncate">{{ specialists.description ? specialists.description.slice(0, 50) + (specialists.description.length > 50 ? '...' : '') : '' }}</td>
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
                                    <!-- <tr class="hover:bg-gray-50 transition" v-if="specialist.length==0" >
                                        <td class="px-6 py-4">No Specialist Found</td>
                                    </tr> -->
                                </tbody>
                                <!-- Pagination Links -->
                                <!-- <div class="flex justify-center mt-4 space-x-2">
                                <Link
                                    v-for="link in specialists.links"
                                    :key="link.url"
                                    :href="link.url"
                                    v-html="link.label"
                                    class="px-3 py-1 border rounded-md hover:bg-blue-100"
                                    :class="{ 'bg-blue-500 text-white': link.active }"
                                />
                                </div> -->
                            </table>
                    </div>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
