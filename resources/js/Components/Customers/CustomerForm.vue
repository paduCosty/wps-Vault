<script setup>
 
</script>

<template>
//Aici facem tabelul Costumers

    <div>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Contact Name</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>VAT Number</th>
                    <th>Status</th>
                    <th>Type</th>
                </tr>
            </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.user_id">
          <td>{{ customer.user_id }}</td>
          <td>{{ customer.contact_name }}</td>
          <td>{{ customer.company_name }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.vat_number }}</td>
          <td>{{ customer.status }}</td>
          <td>{{ customer.type }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

th {
  font-weight: bold;
}
</style>
<template>
  


