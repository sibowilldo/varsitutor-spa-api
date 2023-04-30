<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {UserIcon, CalendarDaysIcon, DocumentTextIcon} from "@heroicons/vue/24/outline";
import Pagination from '@/Shared/Pagination.vue'

const props = defineProps({
    users: Object,
    analytics: Object
})
console.log(props.users.data)
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex gap-5 my-5 mb-16">
                    <div class="w-1/3 h-[180px] flex flex-col justify-between dark:bg-gray-600 bg-white rounded-md p-4 shadow-lg relative overflow-hidden">
                        <h3 class="font-black text-2xl text-gray-700 dark:text-gray-300">Users</h3>
                        <div>
                            <span class="text-4xl font-mono font-bold text-red-400">{{ analytics.users }}</span>
                            <UserIcon class="w-32 absolute -right-10 -bottom-6 text-gray-50 dark:text-gray-500"></UserIcon>
                        </div>
                    </div>
                    <div class="w-1/3 h-[180px] flex flex-col justify-between  dark:bg-gray-600 bg-white rounded-md p-4 shadow-lg relative overflow-hidden">
                        <h3 class="font-black text-2xl text-gray-700 dark:text-gray-300">Vacancies</h3>
                        <div>
                            <span class="text-4xl font-mono font-bold text-green-400">{{ analytics.vacancies }}</span>
                            <DocumentTextIcon class="w-32 absolute -right-10 -bottom-6 text-gray-50 dark:text-gray-500"></DocumentTextIcon>
                        </div>
                    </div>
                    <div class="w-1/3 h-[180px] flex flex-col justify-between  dark:bg-gray-600 bg-white rounded-md p-4 shadow-lg relative overflow-hidden">
                        <h3 class="font-black text-2xl text-gray-700 dark:text-gray-300">Applications</h3>
                        <div>
                            <span class="text-4xl font-mono font-bold text-blue-400">{{  analytics.applications }}</span>
                            <CalendarDaysIcon class="w-32 absolute -right-10 -bottom-6 text-gray-50 dark:text-gray-500"></CalendarDaysIcon>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-xl sm:rounded-lg mb-8">
                    <table class="w-full rounded">
                        <thead>
                        <tr class="dark:bg-gray-800 bg-gray-200 dark:text-white">
                            <th class="text-left px-6 py-3">ID</th>
                            <th class="text-left px-6 py-3">Group</th>
                            <th class="text-left px-6 py-3">Email</th>
                            <th class="text-left px-6 py-3">Verified</th>
                            <th class="text-left px-6 py-3">Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(user,index) in users.data"
                            :class="index % 2? 'dark:bg-gray-500 bg-gray-100 dark:text-white': 'dark:bg-gray-600 bg-gray-50 dark:text-white'"
                        >
                            <td class="px-6 py-3 text-sm text-mono" v-text="user.internal_identification"></td>
                            <td class="px-6 py-3 text-sm" v-text="user.internal_identification_type.substring(0, user.internal_identification_type.indexOf(' '))"></td>
                            <td class="px-6 py-3 text-sm" v-text="user.email"></td>
                            <td class="px-6 py-3 text-sm" v-text="user.email_verified_at == null ?'❌':'✔'"></td>
                            <td class="px-6 py-3 text-sm capitalize" v-text="user.name"></td>
                            <td class="px-6 py-3 text-sm" v-text=""></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <Pagination :links="users.links" />
            </div>
        </div>
    </AppLayout>
</template>
