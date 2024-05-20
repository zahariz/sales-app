<template>
    <AppLayout title="Transaction History">
        <Breadcrumb title="Dashboard">
            <BreadcumbLink :isCurrent="false" title="Transaction"/>
            <BreadcumbLink :isCurrent="true" :title="title"/>
        </Breadcrumb>

        <flash-messages />
        <div class=" rounded-lg border-gray-300 dark:border-gray-600 mb-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <h5 id="drawer-label" class="inline-flex items-center text-sm font-semibold text-gray-500 px-4 pt-4 uppercase dark:text-gray-400">Transaction History</h5>
                <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between p-4">
                    <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">

                    </search-filter>
                    <div>
                        <a type="button" :href="route('transaksi.create')" class="inline-flex items-center px-4 py-2 mb-3 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                            Create
                        </a>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Transaction Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sub Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Discount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ongkir
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Grand Total
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="transaction in data.data" :key="transaction.id">
                            <td class="px-6 py-4">
                                1
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ transaction.transaction_number }}
                            </th>
                            <td class="px-6 py-4">
                                {{ formatDate(transaction.tgl) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ transaction.customer.customer }}
                            </td>
                            <td class="px-6 py-4">
                                {{ transaction.details_sum_qty }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatCurrency(transaction.subtotal) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatCurrency(transaction.diskon) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatCurrency(transaction.ongkir) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatCurrency(transaction.total_bayar) }}
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
    import { format } from 'date-fns';
    import FlashMessages from '@/Components/FlashMessage.vue';
    import SearchFilter from '@/Components/SearchFilter.vue';
    import throttle from 'lodash/throttle'
    import pickBy from 'lodash/pickBy'
    import mapValues from 'lodash/mapValues'

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
            success : String,
            filters : Object
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
                this.$inertia.get('/transaksi/history', pickBy(this.form), { preserveState: true })
            }, 150),
            },
        },
        methods: {
            reset() {
                this.form = mapValues(this.form, () => null)
            },
            formatDate(date) {
            return format(new Date(date), 'd MMMM yyyy'); // Ganti id dengan locale yang sesuai
            },
            formatCurrency(value) {
                if (!value) return 'Rp 0';
                return `Rp ${value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')}`;
            }
        }
    }

</script>
