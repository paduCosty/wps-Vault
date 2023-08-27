<template>
    <div class="flex justify-center mt-3 sm:items-center sm:justify-between">
        <div class="text-center">
            <h2 class="text-center">Edit Invoice</h2>
            <form class="form">
                <div class="row">
                    <div class="col-md-4">

                        <CustomersSelect :selectedCustomerId="invoice.customer_id"
                            @customer-selected="handleCustomerSelected" />

                        <div class="form-group custom-background">
                            <label for="invoice_number">Invoice Number:</label>
                            <input class="form-control" type="number" id="invoice_number"
                                v-model="invoice.invoice_number" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group custom-background">
                            <label for="due_date">Due Date:</label>
                            <input class="form-control" type="date" id="due_date" v-model="invoice.due_date" />
                        </div>

                        <div class="form-group custom-background">
                            <label for="payment_term">Payment Term:</label>
                            <select class="form-control" id="payment_term" v-model="invoice.payment_term">
                                <option value="7">7 days</option>
                                <option value="12">12 days</option>
                                <option value="14">14 days</option>
                            </select>
                        </div>

                        <div class="form-group custom-background">
                            <label for="currency">Currency:</label>
                            <select class="form-control" id="currency" v-model="invoice.currency">
                                <option value="usd">USD</option>
                                <option value="ron">RON</option>
                                <option value="eur">EURO</option>
                            </select>
                        </div>

                        <div class="form-group custom-background">
                            <label for="type">Type:</label>
                            <select class="form-control" id="type" v-model="invoice.type">
                                <option value="general">General</option>
                            </select>
                        </div>


                        <div v-for="(item, index) in invoice.items" :key="index">
                            <h4>{{ item.amount }}</h4>
                            {{ item.description }}
                            <input v-model="item.amount" />
                            <input v-model="item.description" />
                        </div>

                    </div>
                </div>

                <input value="Save Changes" @click.prevent="saveChanges" class="rainbow-button btn btn-danger" alt="Button">
            </form>
        </div>
    </div>
</template>



<script>
import axios from "axios";
import CustomersSelect from "../Commons/CustomersSelect.vue";

export default {
    components: {
        CustomersSelect,
    },
    data() {
        return {
            invoice: {
                customer_id: '',
                invoice_number: '',
                due_date: '',
                payment_term: '',
                currency: '',
                type: 'general',
                customers: [],
                items: [],
            },
        };
    },
    methods: {
        handleCustomerSelected(selectedCustomer) {
            console.log('Selected customer:', selectedCustomer);
            this.invoice.customer_id = selectedCustomer;
        },
        async fetchInvoice(id) {
            try {
                const response = await axios.get(`/api/invoices/${id}/edit`);
                this.invoice = response.data;

            } catch (error) {
                console.error("Error fetching invoice:", error);
            }
        },
        async saveChanges() {
            try {
                const response = await axios.put(`/api/invoices/${this.invoice.id}`, this.invoice);
                console.log("Changes saved:", response.data);

                this.$router.push("/bills"); // Redirect to back route

            } catch (error) {
                console.error("Error saving changes:", error);
            }
        }
    },
    async created() {
        const invoiceId = this.$route.params.id;
        await this.fetchInvoice(invoiceId);
        this.selectedCustomer = this.invoice.customer_id;
    }
};
</script>

<style scoped>
@import '@/Assets/Components/invoices.css';
</style>
