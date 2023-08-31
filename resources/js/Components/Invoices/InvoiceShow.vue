<template>
    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <h2 class="text-center"></h2>
        <form class="form">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">User Id:</strong>
                    </div>
                    <div class="form-control">{{ invoice.user_id }}</div>
                </div>
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Customer Id</strong>
                    </div>
                    <div class="form-control">{{ invoice.customer_id }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Invoice Number:</strong>
                    </div>
                    <div class="form-control">{{ invoice.invoice_number }}</div>
                </div>
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Due Date:</strong>
                    </div>
                    <div class="form-control">{{ invoice.due_date }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Payment Term:</strong>
                    </div>
                    <div class="form-control">{{ invoice.payment_term }}</div>
                </div>
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Currency:</strong>
                    </div>
                    <div class="form-control">{{ invoice.currency }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Type:</strong>
                    </div>
                    <div class="form-control">{{ invoice.type }}</div>
                </div>

                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Amount:</strong>
                    </div>
                    <div class="form-control">{{ invoice.amount }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Description:</strong>
                    </div>
                    <div class="form-control">{{ invoice.description }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group custom-background">
                        <strong class="custom-label">Items:</strong>
                    </div>
                    <div class="form-control custom-background">
                        <ul>
                            <li v-for="(item, index) in invoice_items" :key="index">
                                Amount: {{ item.amount }}, Description: {{ item.description }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-5">
                    <button @click="ToInvoices" class="btn btn-secondary">Back to Invoices</button>
                </div>
            </div>
        </form>
    </div>
</template>
  

<script>
import axios from 'axios';
    export default {
        data() {
            return {
                invoice: {
                    user_id: "",
                    customer_id: "",
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
                invoice_items: [],
            };
        },
        methods: {
            async fetchInvoices(id) {
                try {
                    const response = await axios.get(`/api/invoices/${id}`);
                    this.invoice = response.data;
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
