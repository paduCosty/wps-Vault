<template>
    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <h2 class="text-center">Invoice Details</h2>
        <form class="form">
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
            <div class="col-md-5">
                <div class="form-group custom-background">
                    <strong class="custom-label">Type:</strong>
                </div>
                <div class="form-control">{{ invoice.type }}</div>
            </div>
            <button @click="ToInvoices" class="btn btn-secondary">Back to Invoices</button>
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
                payment_term: "",
                currency: "",
                type: "general",
                id: null,
            },
        };
    },
    methods: {
        async fetchInvoices(id) {
            try {
                console.log('intra');
                const response = await axios.get(`/api/invoices/${id}`);
                this.invoice = response.data;
            } catch (error) {
                console.error("Error fetching customer:", error);
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
