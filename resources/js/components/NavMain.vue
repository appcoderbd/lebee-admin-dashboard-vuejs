<script setup lang="ts">
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarSubMenu,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronDown } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
    label: string;
    items: NavItem[];
}>();

const page = usePage();

// 🧩 কোন সাবমেনু খোলা আছে তা ট্র্যাক করা হবে
const openSubMenus = ref<string[]>([]);

// সাবমেনু টগল ফাংশন
function toggleSubMenu(title: string) {
    if (openSubMenus.value.includes(title)) {
        openSubMenus.value = openSubMenus.value.filter(t => t !== title);
    } else {
        openSubMenus.value.push(title);
    }
}

// Nested route চেক
function isCurrentRoute(href: string) {
    return page.url.startsWith(href);
}

</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>{{ label }}</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem
                v-for="item in items"
                :key="item.title"
                class="transition-all duration-200"
            >
                <!-- সাবমেনু থাকলে -->
                <template v-if="item.children && item.children.length">
                    <SidebarMenuButton
                        @click="toggleSubMenu(item.title)"
                        :is-active="typeof item.href === 'string' ? isCurrentRoute(item.href) : false"
                        class="flex justify-between items-center w-full"
                    >
                        <div class="flex items-center gap-2">
                            <component :is="item.icon" class="w-4 h-4" />
                            <span>{{ item.title }}</span>
                        </div>
                        <ChevronDown
                            class="w-4 h-4 transition-transform duration-200"
                            :class="{
                                'rotate-180': openSubMenus.includes(item.title),
                            }"
                        />
                    </SidebarMenuButton>

                    <!-- সাবমেনু আইটেম -->
                    <SidebarSubMenu
                        v-show="openSubMenus.includes(item.title)"
                        class="ml-6 mt-1 transition-all duration-300"
                    >
                        <SidebarMenuItem
                            v-for="sub in item.children"
                            :key="sub.title"
                        >
                            <SidebarMenuButton
                                as-child
                                :is-active="urlIsActive(sub.href, page.url)"
                            >
                                <Link :href="sub.href">
                                    <component
                                        :is="sub.icon"
                                        class="w-4 h-4"
                                    />
                                    <span>{{ sub.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarSubMenu>
                </template>

                <!-- সাধারণ (সাবমেনু ছাড়া) আইটেম -->
                <template v-else>
                    <SidebarMenuButton
                        as-child
                        :is-active="urlIsActive(item.href, page.url)"
                        :tooltip="item.title"
                    >
                        <Link :href="item.href">
                            <component :is="item.icon" class="w-4 h-4" />
                            <span>{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </template>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>



