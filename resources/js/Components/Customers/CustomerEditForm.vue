<template>
    <div class="flex justify-center mt-3 sm:items-center sm:justify-between">
        <div class="text-center">
            <h2 class="text-center">{{ customer.contact_name }}</h2>
            <form class="form">
                <div class=" row">
                    <div class="col-md-4">
                        <div class="form-group custom-background">
                            <label for=" company_name">Company Name:</label>
                            <input class="form-control" type="text" id="company_name" v-model="customer.company_name" />
                        </div>

                        <div class="form-group custom-background">
                            <label for="contact_name">Contact Name:</label>
                            <input class="form-control" type="text" id="contact_name" v-model="customer.contact_name" />
                        </div>

                        <div class="form-group custom-background">
                            <label for="email">E-mail:</label>
                            <input class="form-control" type="email" id="email" v-model="customer.email" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group custom-background">
                            <label for="vat_number">VAT Number:</label>
                            <input class="form-control" type="text" id="vat_number" v-model="customer.vat_number" />
                        </div>

                        <div class="form-group custom-background">
                            <label for="type">Type:</label>
                            <select class="form-control" id="type" v-model="customer.type">
                                <option value="Business">Business</option>
                                <option value="Individual">Individual</option>
                            </select>
                        </div>

                        <input type="hidden" id="customer_id" v-model="customer.id" />
                    </div>
                </div>

                <button @click.prevent="saveChanges" class="rainbow-button" alt="Button">Save
                    Changes</button>
            </form>
        </div>
    </div>
</template>


<script>
import axios from "axios";

    export default {
    data() {
        return {
            customer: {
                id: null,
                company_name: "",
                contact_name: "",
                email: "",
                vat_number: "",
                type: "",
            },
        };
    },
    // fecth the Customer
    methods: {
        async fetchCustomer(id) {
            try {
                const response = await axios.get(`/api/customers/${id}`);
                this.customer = response.data;
            }
            catch (error) {
                console.error("Error fetching customer:", error);
            }
        },
        async saveChanges() {
            try {
                const response = await axios.put(`/api/customers/${this.customer.id}`, this.customer);
                console.log("Changes saved:", response.data);
                this.$router.push("/customers"); //Push to back route
            }
            catch (error) {
                console.error("Error saving changes:", error);
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
/* Inport style  */
    @import '@/Assets/Components/customers.css';
</style>
