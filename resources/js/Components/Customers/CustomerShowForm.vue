<template>
  <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
    <h2 class="text-center">{{ customer.contact_name }}</h2>
      <form class="form">

        <div class="col-md-5">
          <div class="form-group custom-background"><strong class="custom-label">Company Name:</strong></div>
          <div class="form-control">{{ customer.company_name }}</div>
        </div>

        <div class="col-md-5">
          <div class="form-group custom-background"><strong class="custom-label">Contact Name:</strong></div>
          <div class="form-control">{{ customer.contact_name }}</div>
        </div>

        <div class="col-md-5">
          <div class="form-group custom-background"><strong class="custom-label">Email:</strong></div>
          <div class="form-control">{{ customer.email }}</div>
        </div>

        <div class="col-md-5">
          <div class="form-group custom-background"><strong class="custom-label">VAT Number:</strong></div>
          <div class="form-control">{{ customer.vat_number }}</div>
        </div>

        <div class="col-md-5">
          <div class="form-group custom-background"><strong class="custom-label">Type:</strong></div>
          <div class="form-control">{{ customer.type }}</div>
        </div>

        <button @click="goToCustomers" class="btn btn-secondary">Back to Customers</button>
  
    </form>
  </div>
</template>


<script>
import axios from 'axios';
    export default {
      data() {
        return {
          customer: {},
        };
      },
      methods: {
        async fetchCustomer(id) {
          try {
            const response = await axios.get(`/api/customers/${id}`);
            this.customer = response.data;
          } catch (error) {
            console.error("Error fetching customer:", error);
          }
        },
        // Method for redirection to "Customers";
        goToCustomers() {
          this.$router.push("/customers");
        },
      },
      created() {
        const customerId = this.$route.params.id;
        this.fetchCustomer(customerId);
      },
    };
</script>

<style scoped>
  @import '@/Assets/Components/customers.css';
</style>