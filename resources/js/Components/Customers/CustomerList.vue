<template>
    <div>
        <a href="customers/create" class="btn btn-warning">Customers Create</a>
        <!-- <a href="customers/edit" class="btn btn-info">Customers Edit</a> -->
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Contact Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">VAT Number</th>
                        <th scope="col">Status</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>

                </thead>
                <tbody>
                    <tr v-for="customer in customers.data" :key="customer.id || index">
                        <td>{{ customer.id }}</td>
                        <td>{{ customer.company_name }}</td>
                        <td>{{ customer.contact_name }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.vat_number }}</td>
                        <td>{{ customer.status }}</td>
                        <td>{{ customer.type }}</td>
                        <td class="row gap-3">
                            <router-link :to="`/customers/show/${customer.id}`"
                                class="p-2 col border btn btn-warning">Show</router-link>
                            <router-link :to="`/customers/edit/${customer.id}`"
                                class="p-2 col border btn btn-info">Edit</router-link>
                            <button @click="deleteCustomer(customer.id)" type="button"
                                class="material-iconsp-3 col border btn btn-success">Delete</button>
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
            customers: [],
        };
    },
    methods: {
        async fetchCustomers() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/customers");
                this.customers = response.data;
            } catch (error) {
                console.error("Error fetching customers:", error);
            }
        },
        async deleteCustomer(id) {
            try {
                await axios.delete(`/api/customers/${id}`);
                this.customers = this.customers.filter(customer => customer.id !== id);
            } catch (error) {
                // console.error(error);
                if (Array.isArray(this.customers)) {
                    this.customers = this.customers.filter(customer => customer.id !== id);
                } else {
                    this.customers = [];
                }
            }
        },
    },
    created() {
        this.fetchCustomers();
        // console.log(this.customer.com);
    },
};
</script> 

<style scoped></style>
