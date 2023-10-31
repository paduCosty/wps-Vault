<template>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <form class="form-card" @submit.prevent="addInvoices">
                        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
            
                            <div class="row justify-content-between text-left mb-3">
                                <div class="col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Invoice Number<span class="text-danger"></span></label>
                                        <input v-model="invoice_number" placeholder="Invoice Number" class="form-control" @input="validateForm">
                                            <ErrorMessages :errors="[invoice_numberError]" />
                                    </div>
                    
                                    <div class="col-sm-6 flex-column d-flex">
                                        <CustomersSelect class="form-control-label" ref="customers_select">
                                    </CustomersSelect>
                                </div>
                            </div>
                
                            <div class="row justify-content-between text-left mb-3">
                                <div class="col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Due Date<span class="text-danger"></span></label>
                                        <input @input="validateForm" type="date" v-model="due_date" class="form-control">
                                    <ErrorMessages :errors="[due_dateError]" />
                                </div>
                
                                <div class="col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Payment Term<span class="text-danger"></span></label>
                                        <select v-model="payment_term" class="form-select" @input="validateForm">
                                            <option value="" disabled placeholder="Select a payment term">
                                        Please select a payment term
                                    </option>
                
                                    <option v-for="option in payment_term_options" :key="option" :value="option">
                                        {{ option }}
                                            </option>
                                        </select>
                                    <ErrorMessages :errors="[payment_termError]" />
                                </div>
                            </div>
                
                            <div class="row justify-content-between text-left mb-3">
                                <div class="col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Currency<span class="text-danger"></span></label>
                                        <select v-model="currency" @input="validateForm" class="form-select">
                                            <option value="ron">RON</option>
                                                <option value="eur">EUR</option>
                                            <option value="usd">USD</option>
                                        </select>
                                    <ErrorMessages :errors="[currencyError]" />
                                </div>
                
                                <div class="col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Type<span class="text-danger"></span></label>
                                        <select v-model="type" @input="validateForm" class="form-select">
                                            <option value="general">General</option>
                                        </select>
                                    <ErrorMessages :errors="[typeError]" />
                                </div>
                            </div>
                
                            <InvoiceItems ref="invoiceItems"></InvoiceItems>
                
                            <div class="row justify-content-end mb-3">
                                <div class="form-group col-sm-5" style="margin-right: 400px;">
                                <button type="submit" class="btn-block btn-danger">Add New Invoices</button>
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
import CustomersSelect from '../Commons/CustomersSelect.vue';
import InvoiceItems from './InvoiceItems.vue';
import ErrorMessages from '../Commons/ErrorMessages.vue';

export default {
    components: {
        CustomersSelect,
        InvoiceItems,
        ErrorMessages,
    },
    data() {
        return {
            selected_customer: '',
            customer_id: '',
            invoice_number: '',
            due_date: '',
            payment_term: '',
            payment_term_options: ['7', '12', '14'],
            currency: 'ron',
            type: 'general',
            customers: [],
            invoice_numberError: '',  // Defineste typeError aici
            due_dateError: '',
            payment_termError: '',
            currencyError: '',
            typeError: '', 
        };
    },
    methods: {
        validateForm() {
            this.formErrors = [];

            const fields = {
                invoice_number: 'Invoice Number',
                due_date: 'Due Date',
                payment_term: 'Payment Term',
                currency: 'Currency',
                type: 'Type',
            };

            for (const field in fields) {
                if (!this[field]) {
                    this[`${field}Error`] = `The ${fields[field]} field is required.`;
                    this.formErrors.push(this[`${field}Error`]);
                } else {
                    this[`${field}Error`] = ''; // Reset the error message
                }
            }
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

                const data = {
                    customer_id: this.$refs.customers_select.selected_customer,
                    invoice_number: this.invoice_number,
                    due_date: this.due_date,
                    payment_term: this.payment_term,
                    currency: this.currency,
                    type: this.type,
                    items: this.$refs.invoiceItems.getItemsData()

                };
                const response = await axios.post("/api/invoices", data, {
                    headers: headers,
                });
                console.log(this.data);
                if (response.status === 200) {
                    console.log("Invoice created successfully!");
                    this.$router.push("/bills");
                } else {
                    console.error("Error creating Invoice:", response.data);
                }
            } catch (error) {
                console.error("Error creating Invoice:", error);
            }
        },
    },
};
</script>

<style scoped></style>