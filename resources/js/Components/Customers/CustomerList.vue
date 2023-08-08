<template>
    <div>
        <a href="customers/create" class="btn btn-warning">Customers Create</a>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Contact Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">VAT Number</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="customer in customers.data" :key="customer.id || index">
                        <td scope="row">{{ customer.id }}</td>
                        <td>{{ customer.company_name }}</td>
                        <td>{{ customer.contact_name }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.vat_number }}</td>
                        <td>{{ customer.type }}</td>
                        <td class="row gap-3">
                            <router-link :to="`/customers/show/${customer.id}`" class=" btn btn-warning">Show</router-link>
                            <router-link :to="`/customers/edit/${customer.id}`" class="btn btn-info">Edit</router-link>
                            <button @click="confirmDelete(customer.id)" type="button"
                                class="btn btn-success">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
    export default {
        data() {
            return {
                customers: { data: [] }, // Initialize with an empty array
            };
        },
        methods: {
            async fetchCustomers() {
                try {
                const response = await axios.get("/api/customers");
                this.customers = response.data; // Assign the data from the response to customers
            } catch (error) {
                console.error("Error fetching customers:", error);
            }
        },
        confirmDelete(customerId) {
            if (window.confirm('Are you sure you want to delete this customer?')) {
                this.deleteCustomer(customerId);
            }
        },
        async deleteCustomer(customerId) {
            try {
                const csrfMeta = document.head.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.content : null;

                const headers = {
                    'Content-Type': 'application/json',
                };

                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken;
                }

                const response = await axios.delete(`/api/customers/${customerId}`, {
                    headers: headers,
                });

                if (response.status === 204) {
                    console.log("Customer deleted successfully!");
                    this.fetchCustomers(); // Refresh the list after deletion
                } else {
                    console.error("Error deleting customer:", response.data);
                }
            } catch (error) {
                console.error("Error deleting customer:", error);
            }
        },
    },
    created() {
        this.fetchCustomers(); // Call the fetchCustomers method when the component is created
    },
};
</script>
  
<style scoped></style>