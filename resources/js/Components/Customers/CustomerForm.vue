<template>
    <div>
        <a @click="showTable = !showTable" class="btn btn-warning">Customers</a>
        <div v-if="showTable">
            <table id="customers" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Contact Name</th>
                        <th>E-mail</th>
                        <th>VAT Number</th>
                        <th>Status</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" v-model="companyName" placeholder="Company Name"></td>
                        <td><input type="text" v-model="contactName" placeholder="Name for Contact"></td>
                        <td><input type="email" v-model="email" placeholder="E-mail Contact"></td>
                        <td><input type="number" v-model="vatNumber" placeholder="Cui Company"></td>
                        <td>
                            <select v-model="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </td>
                        <td>
                            <select v-model="type">
                                <option value="Business">Business</option>
                                <option value="Individual">Individual</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button @click="addUser" id="addUser" class="btn btn-primary">Add Customer</button>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            showTable: true,
            companyName: '',
            contactName: '',
            email: '',
            vatNumber: '',
            // status: 'Active',
            type: 'Business',
        };
    },
    methods: {
        async addUser() {
            try {
                const csrfMeta = document.head.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.content : null;

                const headers = {
                    'Content-Type': 'application/json',
                };

                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken;
                }

                const response = await axios.post("http://127.0.0.1:8000/customers/create", {
                    companyName: this.companyName,
                    contactName: this.contactName,
                    email: this.email,
                    vatNumber: this.vatNumber,
                    status: this.status,
                    // type: this.type,
                }, {
                    headers: headers,
                });

                if (response.status === 200) {
                    console.log("Customer created successfully!");
                } else {
                    console.error("Error creating customer:", response.status);
                }
            } catch (error) {
                console.error("Error creating customer:", error);
            }
        },
    },
};
</script>
  
<style scoped>
/* Stilurile specifice pot fi adăugate aici */
</style>
  