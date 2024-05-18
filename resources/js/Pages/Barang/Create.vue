<template>
    <AppLayout title="Master Data Barang">
        <Breadcrumb title="Dashboard">
            <BreadcumbLink :isCurrent="false" title="Master Data"/>
            <BreadcumbLink :isCurrent="true" :title="title"/>
        </Breadcrumb>

        <div class="rounded-lg border-gray-300 dark:border-gray-600 mb-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <h5 id="drawer-label" class="inline-flex items-center text-sm font-semibold text-gray-500 px-4 pt-4 uppercase dark:text-gray-400">Create Barang</h5>
                <div class="p-4">
                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <InputLabel for="sku" value="SKU" />
                                <TextInput
                                id="sku"
                                v-model="form.sku"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="Ex. B00001"
                                autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.sku" />
                            </div>
                            <div>
                                <InputLabel for="product" value="Product" />
                                <TextInput
                                id="product"
                                v-model="form.product"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="Ex. Laptop"
                                autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.product" />
                            </div>
                            <div>
                                <InputLabel for="price" value="Price" />
                                <TextInput
                                id="price"
                                v-model="form.price"
                                type="number"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="Type price here .."
                                autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>
                            <div>
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
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
    import { ref } from 'vue';

    export default {
        components: {
            AppLayout,
            Breadcrumb,
            BreadcumbLink,
            TextInput,
            InputError,
            InputLabel
        },
        props: {
            title : String,
            status : String
        },
        setup() {
            const sku = ref('');
            const customer = ref('');
            const phone = ref(false);

            const form = useForm({
            sku: sku.value,
            customer: customer.value,
            phone: phone.value ? 'on' : ''
            });

            const submit = () => {
            form.post(route('customer.store'), {
                onFinish: () => {
                form.reset('customer');
                customer.value = '';
                }
            });
            };

            return {
            sku,
            customer,
            phone,
            form,
            submit
            };
        }
    }

</script>
