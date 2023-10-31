<template>
    <h1 class="Invoice top-header">Invoice</h1>
    <div class="invoice-border">
        <div class="invoice-show">
            <label class="INum ">Invoice Number--{{ invoice.invoice_number }}</label>
            <div class="container mt-4">
                <form class="form">
                    <div class="row mb-3">

                        <div class="col-md-4 right">
                            <label class="UBus form-label">Business Name:</label>
                            <div class="UBus1 form-control">{{ invoice.user ? invoice.user.business_name : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4 right">
                            <label class="UVat form-label">Vat Numer:</label>
                            <div class="UVat1 form-control">{{ invoice.user ? invoice.user.vat_number : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="UAdr form-label">Addres:</label>
                            <div class="UAdr1 form-control">{{ invoice.user ? invoice.user.address : 'N/A' }}</div>
                        </div>
                        <div class="col-md-4 right">
                            <label class="UCon form-label">Contact Name:</label>
                            <div class="UCon1 form-control">{{ invoice.user ? invoice.user.contact_name : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="UEmail form-label">E-mail:</label>
                            <div class="UEmail1 form-control">{{ invoice.user ? invoice.user.email : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="Cos form-label">Customer Name:</label>
                            <div class="Cos1 form-control">{{ invoice.customer ? invoice.customer.contact_name : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="Com form-label">CompanyName:</label>
                            <div class="Com1 form-control">{{ invoice.customer ? invoice.customer.company_name : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="Vat form-label">VatNumber:</label>
                            <div class="Vat1 form-control">{{ invoice.customer ? invoice.customer.vat_number : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="Email form-label">Email:</label>
                            <div class="Email1 form-control">{{ invoice.customer ? invoice.customer.email : 'N/A' }}</div>
                        </div>

                        <div class="Due col-md-4">
                            <label class="form-label">Due Date:</label>
                            <div class="form-control">{{ invoice.due_date }}</div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button @click="ToInvoices" class="btn btn-secondary">Back to Invoices</button>
                        </div>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in invoice_items" :key="index">
                                    <td class="item-number">{{ index + 1 }}.</td>
                                    <td class="item-type">
                                        <div class="form-label">{{ invoice.type }}</div>
                                    </td>
                                    <td class="item-currency">
                                        <div class="form-label">{{ invoice.currency }}</div>
                                    </td>
                                    <td class="item-amount">
                                        <div class="form-label">{{ item.amount }}</div>
                                    </td>
                                    <td class="item-description">
                                        <div class="form-label">{{ item.description }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
    export default {
        props: {
            InvoiceShow: '',
        },
        data() {
            return {
                invoice: {
                    customer: '',
                    invoice_number: "",
                    due_date: "",
                    amount: '',
                    description: '',
                    payment_term: "",
                    currency: "",
                    type: "general",
                    itens: [],
                    id: null,

                },
                customer: [],
                invoice_items: [],
            };
        },
        methods: {
            async fetchInvoices(id) {
                try {
                    const response = await axios.get(`/api/invoices/${id}`);
                    this.invoice = response.data;
                    this.user = response.data;
                    this.invoice_items = this.invoice.invoice_items;

                } catch (error) {
                    console.error("Error fetching invoice:", error);
                }
            },
            // Method for redirection to "Customers";
            ToInvoices() {
                this.$router.push("/bills");
            },
        },

        created() {
            const invoicesId = this.$route.params.id;
            this.fetchInvoices(invoicesId);
        },
    };
</script>


<style scoped>
    @import '@/Assets/Components/invoices.css';
</style>