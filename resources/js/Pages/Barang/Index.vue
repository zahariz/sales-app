<template>
    <AppLayout title="Master Data Barang">
        <Breadcrumb title="Dashboard">
            <BreadcumbLink :isCurrent="false" title="Master Data"/>
            <BreadcumbLink :isCurrent="true" :title="title"/>
        </Breadcrumb>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 h-32 md:h-64"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
        </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
        <div class="grid grid-cols-2 gap-4">
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Shared/AppLayout.vue';
    import Breadcrumb from '@/Components/Breadcrumb.vue';
    import BreadcumbLink from '@/Components/BreadcumbLink.vue';

    export default {
        components: {
            AppLayout,
            Breadcrumb,
            BreadcumbLink
        },
        props: {
            title : String
        }
    }

</script>
