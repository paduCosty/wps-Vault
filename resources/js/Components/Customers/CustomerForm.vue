<<<<<<< HEAD
<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: []
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      axios.get('/api/customers')
        .then(response => {
          this.users = response.data.data;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>


<template>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Company Name</th>
                <th>Contact Name</th>
                <th>Email</th>
                <th>VAT Number</th>
                <th>Status</th>
                <th>Type</th>
                <th>Order Count</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.user_id">
                <td>{{ user.user_id }}</td>
                <td>{{ user.company_name }}</td>
                <td>{{ user.contact_name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.vat_number }}</td>
                <td>{{ user.status }}</td>
                <td>{{ user.type }}</td>
                <td>{{ user.orderCount }}</td>
            </tr>
        </tbody>
    </table>
</template>
=======
<template>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <form class="form-card">
                        <div class="row justify-content-between text-left">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Company Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" v-model="company_name" placeholder="Company Name">
                            </div>
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Contact Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" v-model="contact_name" placeholder="Contact Name">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">E-mail<span class="text-danger">*</span></label>
                                <input type="email" v-model="email" placeholder="E-mail">
                            </div>
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Vat Number<span class="text-danger">*</span></label>
                                <input type="number" v-model="vat_number" placeholder="Cuiul Firmei">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Status<span class="text-danger">*</span></label>
                                <select v-model="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Type<span class="text-danger">*</span></label>
                                <select v-model="type">
                                    <option value="Business">Business</option>
                                    <option value="Individual">Individual</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6">
                                <button @click="addUser" id="addUser"  class="btn-block btn-danger">Add Customer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
    export default {
        data() {
            return {
                showTable: true,
                company_name: '',
                contact_name: '',
                email: '',
                vat_number: '',
                status: '',
                type: '',
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
                    company_name: this.company_name,
                    contact_name: this.contact_name,
                    email: this.email,
                    vat_number: this.vat_number,
                    status: this.status,
                    type: this.type,
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
  
>>>>>>> Costumers/User
