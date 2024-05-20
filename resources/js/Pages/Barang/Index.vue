<template>
    <AppLayout title="Master Data Barang">
        <Breadcrumb title="Dashboard">
            <BreadcumbLink :isCurrent="false" title="Master Data"/>
            <BreadcumbLink :isCurrent="true" :title="title"/>
        </Breadcrumb>
        <flash-messages />
        <div class="rounded-lg border-gray-300 dark:border-gray-600 mb-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <h5 id="drawer-label" class="inline-flex items-center text-sm font-semibold text-gray-500 px-4 pt-4 uppercase dark:text-gray-400">Master Barang</h5>
                <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between p-4">
                    <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">

                    </search-filter>
                    <div>
                        <a type="button" :href="route('barang.create')" class="inline-flex items-center px-4 py-2 mb-3 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                            Create
                        </a>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                SKU
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="products in data.data" :key="products.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ products.sku }}
                            </th>
                            <td class="px-6 py-4">
                                {{ products.product }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{products.price}}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex">
                                    <a type="button" :href="route('barang.edit', products.id)" class="inline-flex items-center px-4 py-2 mb-3 bg-indigo-800 dark:bg-indigo-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-indigo-800 uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-white focus:bg-indigo-700 dark:focus:bg-white active:bg-indigo-900 dark:active:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-indigo-800 transition ease-in-out duration-150 mr-2">
                                        <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>

                                    </a>
                                    <button @click="confirmDelete(products.id)" class="inline-flex items-center px-4 py-2 mb-3 bg-pink-800 dark:bg-pink-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-pink-800 uppercase tracking-widest hover:bg-pink-700 dark:hover:bg-white focus:bg-pink-700 dark:focus:bg-white active:bg-pink-900 dark:active:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-pink-800 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
    import FlashMessages from '@/Components/FlashMessage.vue';
    import SearchFilter from '@/Components/SearchFilter.vue';
    import throttle from 'lodash/throttle'
    import pickBy from 'lodash/pickBy'
    import mapValues from 'lodash/mapValues'
    import Swal from 'sweetalert2';
    import { router } from '@inertiajs/vue3'

    export default {
        components: {
            AppLayout,
            Breadcrumb,
            BreadcumbLink,
            FlashMessages,
            SearchFilter
        },
        props: {
            title : String,
            data : Object,
            success: String,
            filters: Object,
        },
        data() {
            return {
            form: {
                search: this.filters.search
            },
            }
        },
        watch: {
            form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/master/barang', pickBy(this.form), { preserveState: true })
            }, 150),
            },
        },
        methods: {
            reset() {
                this.form = mapValues(this.form, () => null)
            },
            confirmDelete(productId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('barang.destroy', productId));
                }
            })
        }
        },
    }

</script>
