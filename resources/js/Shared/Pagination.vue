<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
})

</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mb-1 items-center justify-center bg-white rounded-md shadow-sm bg-cyan-900">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key"
                     class="my-1 mr-1 px-4 py-3 text-cyan-700 text-sm leading-4 rounded text-xs cursor-not-allowed"
                     v-html="link.label"/>
                <Link v-else :key="`link-${key}`" preserve-scroll
                      class="my-1 mr-1 text-xs px-4 py-3 text-cyan-100 focus:text-white text-sm leading-4 hover:bg-cyan-800 focus:border-indigo-500 rounded"
                      :class="{ 'bg-cyan-800 text-cyan-300': link.active }" :href="link.url" v-html="link.label"/>
            </template>
        </div>
    </div>
</template>
