<template>
    <form id="app">
        <div id="app">
            <a @click="showTable" class="btn btn-warning">Customers</a>
            <div v-if="displayTable">
                <table id="customers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
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
                            <td><input type="number" v-model="newUser.userId" name="userId" placeholder="User Id"></td>
                            <td><input type="text" v-model="newUser.companyName" name="companyName"
                                    placeholder="Company Name"></td>
                            <td><input type="text" v-model="newUser.contactName" name="contactName"
                                    placeholder="Name for Contact"></td>
                            <td><input type="email" v-model="newUser.email" name="email" placeholder="E-mail Contact"></td>
                            <td><input type="number" v-model="newUser.vatNumber" name="vatNumber" placeholder="Cui Company">
                            </td>
                            <td>
                                <select v-model="newUser.status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </td>
                            <td>
                                <select v-model="newUser.type">
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
    </form>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            displayTable: true,
            newUser: {
                userId: '',
                companyName: '',
                contactName: '',
                email: '',
                vatNumber: '',
                status: 'Active',
                type: 'Business'
            }
        };
    },

    methods: {
        showTable() {
            // Nu este necesară nicio modificare în metoda showTable()
        },

        addUser() {
            // console.log(this.companyName, 'valoarea este buna');
            for (let key in this.newUser) {
                if (this.newUser.hasOwnProperty(key)) {
                    const value = this.newUser[key];
                }
            }

            axios.request({
                url: '/customers/create',
                method: 'GET',
                data: this.newUser
            })
                .then(response => {
                    console.log('User added successfully:', response.data);
                    this.resetForm();
                })
                .catch(error => {
                    console.error('Failed to add user:', error);
                });
        },

        resetForm() {
            this.newUser = {
                userId: '',
                contactName: '',
                companyName: '',
                email: '',
                vatNumber: '',
                status: 'Active',
                type: 'Business'
            };
        }
    }
};
</script>
  
<style scoped>
/* Stilurile dvs. specifice pot fi adăugate aici */
</style>
  