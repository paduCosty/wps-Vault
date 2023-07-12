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
