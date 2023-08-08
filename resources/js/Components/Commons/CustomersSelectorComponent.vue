<template>
    <div class="col-sm-7 flex-column d-flex">
        <label class="form-control-label px-3">Customer<span class="text-danger"></span></label>
        <select v-name="customer_id" v-model="selectedCustomer" class="form-control" @change="fetchCustomerDetails">
            <option value="" disabled>Select a customer</option>
            <option v-for="customer in customers.data" :key="customer.id" :value="customer.id" v-name="customer_id">
                {{ customer.contact_name }}
            </option>
        </select>
    </div>
</template>

  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            selectedCustomer: '',
            customer_id: '',
            customers: [],
        };
    },
    methods: {
        async fetchCustomers() {
            try {
                const response = await axios.get("/api/customers");
                if (response.status === 200) {
                    this.customers = response.data;
                } else {
                    console.error("Error fetching customers:");
                }
            } catch (error) {
                console.error("Error fetching customers:", error);
            }
        },
        async fetchCustomerDetails() {
            try {
                const response = await axios.get(`/api/customers/${this.selectedCustomer}`);
                if (response.status === 200) {
                    const customer = response.data;
                    console.log("Selected customer details:", this.customers, 'aici este ');
                } else {
                    console.error("Error fetching customer details:");
                }
            } catch (error) {
                console.error("Error fetching customer details:", error);
            }
        }
    },
    mounted() {
        this.fetchCustomers();
    },
};
</script>
