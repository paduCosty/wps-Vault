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
        <div class="form-group custom-background"><strong class="custom-label">Status:</strong></div>
        <div class="form-control">{{ customer.status }}</div>
      </div>

      <div class="col-md-5">
        <div class="form-group custom-background"><strong class="custom-label">Type:</strong></div>
        <div class="form-control">{{ customer.type }}</div>
      </div>
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

        const response = await axios.get(`http://127.0.0.1:8000/api/customers/${id}`);
        this.customer = response.data;
      } catch (error) {
        console.error("Error fetching customer:", error);
      }
    },
  },
  created() {
    const customerId = this.$route.params.id;
    this.fetchCustomer(customerId);
  },
};
</script>

<style scoped>
.custom-label {
  color: #555;
  font-weight: bold;
}

.custom-value {
  color: #ef9c76;
}

.custom-background {
  background-color: #f2f2f2;
  /* Culorea gri deschis */
  padding: 10px;
  /* Adăugăm o mică margine în jurul elementului pentru a delimita fundalul */
}

.form {
  margin-left: 550px;
}
</style>
