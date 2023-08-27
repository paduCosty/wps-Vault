<template>
    <div class="col-sm-7 flex-column d-flex">
        <label class="form-control-label px-3">Customer<span class="text-danger"></span></label>
        <select v-model="test" class="form-control" @change="emitCustomerSelected">
            <option value="" disabled>Select a customer</option>
            <option v-for="customer in customers.data" :key="customer.id" :value="customer.id">
                {{ customer.contact_name }}
            </option>
        </select>
        {{ test }}
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: [
        'selectedCustomerId' 
    ],
    data() {
        return {
            selectedCustomer: '',
            test: this.selectedCustomerId,
            customers: [],
        };
    },
    methods: {
        async fetchCustomers() {
            try {
                const response = await axios.get("/api/customers");
                this.customers = response.data;


                if (response.status === 200) {
                    this.customers = response.data;
                } else {
                    console.error("Error fetching customers:");
                }
            } catch (error) {
                console.error("Error fetching customers:", error);
            }
        },

        async emitCustomerSelected() {
            const selectedCustomer = this.customers.data.find(customer => customer.id === this.selectedCustomerId);
            if (selectedCustomer) {
                this.$emit('customer-selected', selectedCustomer.id, selectedCustomer.contact_name);
            }
        }
    },
    mounted() {
        this.fetchCustomers();
        // console.log("Selected Customer ID received:", this.selectedCustomerId);
        this.test = this.selectedCustomerId;

    },
};
</script>
