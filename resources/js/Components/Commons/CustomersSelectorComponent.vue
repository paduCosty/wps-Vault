<template>
    <div class="col-sm-7 flex-column d-flex">
        <label class="form-control-label px-3">Customer<span class="text-danger"></span></label>
        <select v-model="selectedCustomer" class="form-control" @change="emitCustomerSelected">
            <option value="" disabled>Select a customer</option>
            <option v-for="customer in customers.data" :key="customer.id" :value="customer.id">
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

        emitCustomerSelected() {
            this.$emit('customer-selected', this.selectedCustomer);
        }
    },
    mounted() {
        this.fetchCustomers();
    },
};
</script>
