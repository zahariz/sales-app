<template>
    <AppLayout title="Transaction Create">
        <Breadcrumb title="Dashboard">
            <BreadcumbLink :isCurrent="false" title="Transaction" />
            <BreadcumbLink :isCurrent="true" :title="title" />
        </Breadcrumb>
        <flash-messages />
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 mb-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="p-4">
                    <form @submit.prevent="submit">
                        <h5 id="drawer-label"
                            class="inline-flex items-center text-sm font-semibold text-gray-500 py-2 uppercase dark:text-gray-400">
                            Transaksi</h5>
                        <div>
                            <InputLabel for="transaction_number" value="Transaction Number" />
                            <TextInput id="transaction_number" v-model="form.transaction_number" type="text"
                                class="mt-1 block xl:w-1/2 w-full" required autofocus placeholder="Ex. 202101-0001"
                                autocomplete="off" disabled />
                            <InputError class="mt-2" :message="form.errors.transaction_number" />
                        </div>
                        <div>
                            <InputLabel for="datepicker" value="Transaction Date" />
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <TextInput id="datepicker" v-model="form.transaction_date" type="date"
                                    class="mt-1 ps-10 block xl:w-1/2 w-full" autofocus placeholder="Select Date"
                                    autocomplete="off" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.transaction_date" />
                        </div>
                        <h5 id="drawer-label"
                            class="inline-flex items-center text-sm font-semibold text-gray-500 py-2 mt-2  uppercase dark:text-gray-400">
                            Customer</h5>
                        <div class="relative">
                            <InputLabel for="sku" value="SKU" />
                            <TextInput id="sku" v-model="form.sku" type="text" class="mt-1 block xl:w-1/2 w-full" required
                                autofocus placeholder="Find customer here .." autocomplete="off"  @keyup="onKeyUpCustomer" />
                            <InputError class="mt-2" :message="form.errors.sku" />
                            <div v-show="dropdownVisibleCustomer" id="dropdownCustomer" class="xl:w-1/2 w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto">
                                <div v-for="option in filteredCustomers" :key="option.id" @click="selectOptionCustomer(option.customer, option.sku, option.phone, option.id)" class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors">
                                   {{ option.sku }} - {{ option.customer }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <InputLabel for="customer" value="Customer" />
                            <TextInput id="customer" v-model="form.customer" type="text" class="mt-1 block xl:w-1/2 w-full"
                                required autofocus placeholder="Riki Kurniawan" autocomplete="off" disabled />
                            <InputError class="mt-2" :message="form.errors.customer" />
                        </div>
                        <div>
                            <InputLabel for="phone" value="Phone" />
                            <TextInput id="phone" v-model="form.phone" type="text" class="mt-1 block xl:w-1/2 w-full"
                                required autofocus placeholder="+62 89519067218" autocomplete="off" disabled />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <div class="mt-5">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="flex justify-center items-center py-3">
                                            <button type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                @click="openModal">
                                                Add Product
                                            </button>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            No.
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Product SKU
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Qty
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Product Price
                                        </th>
                                        <th scope="col" class="px-6 py-3  items-center" colspan="2">
                                            <span class="flex items-center justify-center">Discount</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Discount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Grand Total
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3 ">
                                            <span class="font-bold flex justify-center">%</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            <span class="flex justify-center">Rp</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="(transaction, index) in transactions" :key="index">
                                        <td class="px-6 py-4">
                                            <div class="flex">
                                                <a type="submit" @click="editCart(index)"
                                                    class="inline-flex items-center px-4 py-2 mb-3 bg-indigo-800 dark:bg-indigo-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-indigo-800 uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-white focus:bg-indigo-700 dark:focus:bg-white active:bg-indigo-900 dark:active:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-indigo-800 transition ease-in-out duration-150 mr-2">
                                                    <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                    </svg>

                                                </a>
                                                <a type="button" @click="deleteCart(index)"
                                                    class="inline-flex items-center px-4 py-2 mb-3 bg-pink-800 dark:bg-pink-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-pink-800 uppercase tracking-widest hover:bg-pink-700 dark:hover:bg-white focus:bg-pink-700 dark:focus:bg-white active:bg-pink-900 dark:active:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-pink-800 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>

                                                </a>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ transaction.transaction_number }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ transaction.product_sku }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.product }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.qty }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.total_product_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="flex justify-center">{{ transaction.discount_percent == '' ? 0 : transaction.discount_percent }}%</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="flex justify-center">{{ transaction.discount_price }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.total_discount_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.grand_total }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                        <div class="grid xl:grid-cols-2 gap-4 mb-4 sm:grid-cols-1 mt-2">
                            <div class=" rounded-lg border-gray-300 dark:border-gray-600">

                            </div>
                            <div class=" rounded-lg border-gray-300 dark:border-gray-600 ">
                                <div class="flex items-center justify-end">
                                    <InputLabel for="sub_total" value="Sub Total" class="mr-2 " />
                                    <TextInput
                                    id="sub_total"
                                    type="text"
                                    class="mt-1 block w-1/2"
                                    :value="subtotal"
                                    disabled
                                    autofocus
                                    autocomplete="off"
                                    />
                                </div>
                                <div class="flex items-center justify-end">
                                    <InputLabel for="ongkir" value="Ongkir" class="mr-2 " />
                                    <TextInput
                                    id="ongkir"
                                    type="number"
                                    v-model="form.ongkir"
                                    class="mt-1 block w-1/2"
                                    placeholder="Type ongkir here .."
                                    autofocus
                                    autocomplete="off"
                                    />
                                </div>
                                <div class="flex items-center justify-end">
                                    <InputLabel for="discounts" value="Discount" class="mr-2" />
                                    <TextInput
                                    id="discount"
                                    type="number"
                                    v-model="form.discountTransaction"
                                    class="mt-1 block w-1/2"
                                    placeholder="Type discount here .."
                                    autofocus
                                    autocomplete="off"
                                    />
                                </div>
                                <div class="flex items-center justify-end">
                                    <InputLabel for="sub_total" value="Total Bayar :" class="mr-2 text-xl" />
                                    <span class="text-2xl font-bold text-red-800"  id="totalBayars">Rp.{{ Number(form.ongkir) + Number(form.discountTransaction) + subtotal }}</span>

                                </div>
                            </div>

                        </div>


                        <div class="mt-2 flex items-center justify-center">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-6"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </button>
                            <a type="button" :href="route('transaksi.history')"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ml-6"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Cancel
                            </a>
                        </div>



                    </form>
                </div>

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
        <DialogModal :show="isModalVisible" :max-width="'2xl'" :closeable="true" @close="closeModal">
            <template #title>
                Add Product
            </template>
            <template #content>
                <form @submit.prevent="editingIndex === null ? submitCart() : updateCart()">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div class="relative">
                                <InputLabel for="Product" value="Product"/>
                                <TextInput
                                id="Product"
                                v-model="form.product"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="Type SKU Product here .."
                                autocomplete="off"
                                @keyup="onKeyUpProduct"
                                />
                                <InputError class="mt-2" :message="form.errors.product" />
                                <div v-show="dropdownVisibleProduct" id="dropdownProduct" class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto">
                                    <div v-for="option in filteredProducts" :key="option.id" @click="selectOption(option.product, option.price, option.sku, option.id)" class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors">
                                        {{ option.product }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <InputLabel for="qty" value="Qty" />
                                <TextInput
                                id="qty"
                                v-model="form.qty"
                                type="number"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="5"
                                autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.qty" />
                            </div>

                            <div>
                                <InputLabel for="discount" value="Discount (%)" />
                                <TextInput
                                id="discount"
                                v-model="form.discount"
                                type="number"
                                class="mt-1 block w-full"
                                placeholder="Type discount here .."
                                autofocus
                                autocomplete="off"

                                />
                                <InputError class="mt-2" :message="form.errors.discount" />
                            </div>
                            <div>
                                <InputLabel for="price" value="Total Price" />
                                <span id="price" class="text-2xl line-through font-bold mr-2" v-if="form.discount > 0">Rp. {{ (form.price * form.qty) + Number(form.ongkir) }}</span>
                                <span class="text-3xl text-red-600 font-bold" >Rp. {{ ((form.price - (form.price * (form.discount/100))) * form.qty) + Number(form.ongkir) }}</span>
                            </div>
                        </div>
                        <div class="flex flex-row justify-end px-6 py-4 text-end">
                            <button type="submit"
                                class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">
                                {{ editingIndex === null ? 'Add to Cart' : 'Update Cart' }}
                            </button>
                            <button @click="closeModal"
                                class="ml-2 text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
            </template>

        </DialogModal>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Shared/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import BreadcumbLink from '@/Components/BreadcumbLink.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, onMounted, watch, computed } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import Datepicker from 'flowbite-datepicker/Datepicker';
import { initFlowbite } from 'flowbite'
import Swal from 'sweetalert2'
import FlashMessages from '@/Components/FlashMessage.vue';

export default {
    components: {
        AppLayout,
        Breadcrumb,
        BreadcumbLink,
        TextInput,
        InputError,
        InputLabel,
        DialogModal,
        FlashMessages
    },
    props: {
        title: String,
        status: String,
        product : Object,
        customer : Object
    },
    setup(props) {
        const transaction_number = ref('');
        const transaction_date = ref('');
        const product = ref('');
        const product_sku = ref('');
        const product_id = ref('');
        const sku = ref('');
        const phone = ref('');
        const customer = ref('');
        const customer_id = ref('');
        const price = ref('');
        const discount = ref('');
        const discountTransaction = ref('');
        const totalBayar = ref('');
        const qty = ref('');
        const ongkir = ref('');
        const detail = ref('');
        const total = ref('');
        const isModalVisible = ref(false);
        const dropdownVisibleProduct = ref(false);
        const dropdownVisibleCustomer = ref(false);

        function generateTransactionNumber() {
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = ('0' + (currentDate.getMonth() + 1)).slice(-2);

            let lastTransactionDate = localStorage.getItem('lastTransactionNumber');
            if (!lastTransactionDate || lastTransactionDate.substring(0, 6) !== `${year}${month}`) {
                localStorage.setItem('lastTransactionNumber', `${year}${month}-0000`);
                lastTransactionDate = `${year}${month}-0000`;
            }

            let queueNumber = parseInt(lastTransactionDate.substring(7)) + 1;
            queueNumber = ('0000' + queueNumber).slice(-4);

            return `${year}${month}-${queueNumber}`;
        }

        const transactionNumber = generateTransactionNumber();
        transaction_number.value = transactionNumber;



        const form = useForm({
            transaction_number: transaction_number.value,
            product : product.value,
            product_sku : product_sku.value,
            product_id : product_id.value,
            customer : customer.value,
            customer_id : customer_id.value,
            sku: sku.value,
            phone: phone.value,
            transaction_date: transaction_date.value,
            price: price.value,
            discount: discount.value,
            qty: qty.value,
            ongkir: ongkir.value,
            discountTransaction : discountTransaction.value,
            total : 0,
            totalBayar : 0,
            detail : 0
        });


        const openModal = () => {
            isModalVisible.value = true;
        };
        const closeModal = () => {
            isModalVisible.value = false;
        };


        const totalWithoutDiscount = (form.price * form.qty) + form.ongkir;
        const totalWithDiscount = ((form.price - (form.price * (form.discount/100))) * form.qty) + form.ongkir;


        let products = props.product;

        let customers = props.customer;

        const filteredProducts = computed(() => {
        return products.filter((pd) =>
            pd.product.toLowerCase().includes(form.product.toLowerCase())
        );
        });

        const filteredCustomers = computed(() => {
            return customers.filter((cs) =>
                cs.customer.toLowerCase().includes(form.sku.toLowerCase()) ||
                cs.sku.toLowerCase().includes(form.sku.toLowerCase())
            );
        });

        const selectOption = (name, price, sku, id) => {
        form.product = name;
        form.price = price;
        form.product_sku = sku;
        form.product_id = id;
        dropdownVisibleProduct.value = false;
        };

        const selectOptionCustomer = (name, sku, phone, id) => {
        form.customer = name;
        form.sku = sku;
        form.phone = phone;
        form.customer_id = id;
        dropdownVisibleCustomer.value = false;
        };


        const onKeyUpProduct = (e) => {
        dropdownVisibleProduct.value = e.target.value !== '';
        };

        const onKeyUpCustomer = (e) => {
        dropdownVisibleCustomer.value = e.target.value !== '';
        };

        const submit = () => {
            form.totalBayar = Number(form.ongkir) - Number(form.discountTransaction) + Number(form.total);
            form.post(route('transaksi.store'), {
                onSuccess: () => {
                    localStorage.removeItem('transactions');
                    localStorage.setItem('lastTransactionNumber', form.transaction_number);
                    },
                    onError: (errors) => {
                        // Handle errors if needed
                        console.error(errors);
                    }
                });

            };

        return {
            transaction_number,
            product,
            submit,
            product_sku,
            product_id,
            customer,
            customer_id,
            sku,
            phone,
            transaction_date,
            price,
            discount,
            discountTransaction,
            totalBayar,
            qty,
            form,
            ongkir,
            detail,
            total,
            isModalVisible,
            openModal,
            closeModal,
            products,
            filteredProducts,
            selectOption,
            onKeyUpProduct,
            dropdownVisibleProduct,
            dropdownVisibleCustomer,
            customers,
            filteredCustomers,
            selectOptionCustomer,
            onKeyUpCustomer,
            totalWithoutDiscount,
            totalWithDiscount
        };
    },
    data() {
        return {
            transactions: [],
            subtotal : 0,
        };
    },
    created() {
        this.loadTransactionsCart();
        this.calculateSubtotal();
    },
    methods: {
        loadTransactionsCart() {
            const storedTransactions = JSON.parse(localStorage.getItem('transactions')) || [];
            this.transactions = storedTransactions;
            this.form.detail = storedTransactions;
        },
        submitCart() {
            const transactionData = {
                'transaction_number' : this.form.transaction_number,
                'transaction_date' : this.form.transaction_date,
                'customer_sku' : this.form.sku,
                'customer_name' : this.form.customer,
                'product_sku': this.form.product_sku,
                'product_id': this.form.product_id,
                'product' : this.form.product,
                'qty' : this.form.qty,
                'product_price' : this.form.price,
                'discount_percent' : this.form.discount,
                'discount_price' : (this.form.price) * (this.form.discount / 100),
                'total_discount_price' : this.form.discount == '' ? 0 : this.form.price - (this.form.price * (this.form.discount / 100)),
                'grand_total' : this.form.price * this.form.qty - (this.form.price * (this.form.discount / 100))
            };

            let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
            transactions.push(transactionData);
            localStorage.setItem('transactions', JSON.stringify(transactions));

            this.transactions.push(transactionData);

            this.calculateSubtotal();

            Swal.fire({
                title: 'Success!',
                text: 'Product successfully added to cart!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                this.closeModal();
            });

            this.resetForm();


        },
        editCart(index) {
            this.isModalVisible = true;
            const transaction = this.transactions[index];
            this.form.transaction_number = transaction.transaction_number;
            this.form.transaction_date = transaction.transaction_date;
            this.form.sku = transaction.customer_sku;
            this.form.customer = transaction.customer_name;
            this.form.product_sku = transaction.product_sku;
            this.form.product = transaction.product;
            this.form.qty = transaction.qty;
            this.form.price = transaction.total_product_price;
            this.form.discount = transaction.discount_percent;
            this.form.ongkir = transaction.ongkir;

            this.editingIndex = index;
        },
        updateCart() {
            if (this.editingIndex !== null) {
                const transactionData = {
                    'transaction_number' : this.form.transaction_number,
                    'transaction_date' : this.form.transaction_date,
                    'customer_sku' : this.form.sku,
                    'customer_name' : this.form.customer,
                    'product_sku': this.form.product_sku,
                    'product_id': this.form.product_id,
                    'product' : this.form.product,
                    'qty' : this.form.qty,
                    'product_price' : this.form.price,
                    'discount_percent' : this.form.discount,
                    'discount_price' : (this.form.price) * (this.form.discount / 100),
                    'total_discount_price' : this.form.discount == '' ? 0 : this.form.price - (this.form.price * (this.form.discount / 100)),
                    'ongkir' : this.form.ongkir,
                    'grand_total' : this.form.price * this.form.qty - (this.form.price * (this.form.discount / 100))
                };

                this.transactions.splice(this.editingIndex, 1, transactionData);
                localStorage.setItem('transactions', JSON.stringify(this.transactions));

                this.calculateSubtotal();

                Swal.fire({
                    title: 'Success!',
                    text: 'Product successfully updated in cart!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                this.resetForm();
                this.editingIndex = null;
                this.closeModal();
            }
        },
        deleteCart(index) {
                Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this product from the cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.transactions.splice(index, 1);
                    localStorage.setItem('transactions', JSON.stringify(this.transactions));

                    this.calculateSubtotal();

                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Product successfully removed from cart!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });
        },
        resetForm() {
            this.form.product = '';
            this.form.qty = '';
            this.form.discount = '';
            this.form.price = '';
        },

        calculateSubtotal() {
            this.subtotal = this.transactions.reduce((total, transaction) => {
                return total + parseFloat(transaction.grand_total);
            }, 0);

            this.form.total = this.subtotal;

        },




    }
}
</script>

