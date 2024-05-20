<template>
    <AppLayout title="Dashboard">
        <Breadcrumb :title="title">
        </Breadcrumb>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="bg-gray-200 rounded-lg dark:bg-gray-600 p-4 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ formatCurrency(income) }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Income</dd>
                </div>
            </div>
            <div class="rounded-lg bg-gray-200 dark:bg-gray-600 p-3 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ customer }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Customer</dd>
                </div>
            </div>
            <div class="rounded-lg bg-gray-200 dark:bg-gray-600 p-3 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ product }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Product</dd>
                </div>
            </div>
            <div class="rounded-lg bg-gray-200 dark:bg-gray-600 p-3 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ productSold }}+</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Product Sold</dd>
                </div>
            </div>
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
            title : String,
            customer : Number,
            product : Number,
            productSold : String,
            income : String,
            auth: Object
        },
        methods: {
            formatCurrency(value) {
                if (!value) return 'Rp 0';
                return `Rp ${value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')}`;
            }
        }
    }

</script>
