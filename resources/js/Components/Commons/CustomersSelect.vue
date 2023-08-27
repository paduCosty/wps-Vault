<template>
    <div class="col-sm-7 flex-column d-flex">
        <label class="form-control-label px-3">Customer<span class="text-danger"></span></label>
        <select v-model="selected_customer" class="form-control">
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
    props: {
        selected_customer_id: '',
    },
    data() {
        return {
            selected_customer: '',
            customers: [],
        };
    },
    watch: {
        selected_customer_id(id) {
            this.selected_customer = id;
        },
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

    },
    mounted() {
        this.fetchCustomers();
        console.log(this.selected_customer_id)
    },
};
</script>
