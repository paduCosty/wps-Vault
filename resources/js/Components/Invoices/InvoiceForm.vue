<template>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <form class="form-card">
                        <div class="row justify-content-between text-left mb-3">
                            <div class="col-sm-10 flex-column d-flex">
                                <div class="row justify-content-between text-left mb-3">
                                    <CustomersSelectorComponent
                                        @customer-selected="handleOptionSelected"
                                        class="form-control- label"
                                    >
                                    </CustomersSelectorComponent>

                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-between text-left mb-3">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Invoice Number<span
                                    class="text-danger"></span></label>
                                <input type="number" placeholder="Invoice Number" class="form-control">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left mb-3">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Due Date<span class="text-danger"></span></label>
                                <input type="date" v-model="due_date" class="form-control">
                            </div>

                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Payment Term<span
                                    class="text-danger"></span></label>
                                <select v-model="payment_term" class="form-select">
                                    <option v-for="option in payment_term_options" :key="option" :value="option">
                                        {{ option }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left mb-3">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Currency<span class="text-danger"></span></label>
                                <select v-model="currency" class="form-select">
                                    <option value="ron">RON</option>
                                    <option value="eur">EUR</option>
                                    <option value="usd">USD</option>
                                </select>
                            </div>
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Type<span class="text-danger"></span></label>
                                <select v-model="type" class="form-select">
                                    <option value="general">General</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6">
                                <input value="Add New Invoices" type="button" @click.prevent="addInvoices"
                                       id="addInvoices"
                                       class="btn-block btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';

import CustomersSelectorComponent from '../Commons/CustomersSelectorComponent.vue';

export default {
    components: {
        CustomersSelectorComponent,
    },
    data() {
        return {
            showTable: true,
            customer_id: '',
            invoice_number: '',
            due_date: '',
            payment_term: '',
            payment_term_options: [],
            currency: 'ron',
            type: 'general',
            customers: [],
        };
    },
    methods: {
        handleOptionSelected(option) {
            this.customer_id = option;
        },

        async addInvoices() {
            try {
                const csrfMeta = document.head.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.content : null;

                const headers = {
                    'Content-Type': 'application/json',
                };

                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken;
                }

                console.log({
                    customer_id: this.customer_id,
                    invoice_number: this.invoice_number,
                    due_date: this.due_date,
                    payment_term: this.payment_term,
                    currency: this.currency,
                    type: this.type
                });
                // const response = await axios.post("/api/invoices", {
                //     customer_id: this.customer_id,
                //     invoice_number: this.invoice_number,
                //     due_date: this.due_date,
                //     payment_term: this.payment_term,
                //     currency: this.currency,
                //     type: this.type,
                // }, {
                //     headers: headers,
                // });

                //     if (response.status === 200) {
                //         console.log("Invoice created successfully!");
                //         this.$router.push("/bills");
                //     } else {
                //         console.error("Error creating Invoice:");
                //     }
            } catch (error) {
                console.error("Error creating Invoice:", error);
                // alert(this.customers);
            }
        },
        async fetchPaymentTermOptions() {
            this.payment_term_options = ['7', '14', '30'];

        },

    },
    mounted() {
        this.fetchPaymentTermOptions(); // Apelează metoda pentru a popula opțiunile de plată


    },
};
</script>

<style scoped></style>
