<template>
    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
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
                            <label for="status">Status:</label>
                            <input class="form-control" type="text" id="status" v-model="customer.status" />
                        </div>

                        <div class="form-group custom-background">
                            <label for="type">Type:</label>
                            <input class="form-control" type="text" id="type" v-model="customer.type" />
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
                id: null, // Add id some propieti
                company_name: "",
                contact_name: "",
                email: "",
                vat_number: "",
                status: "",
                type: "",
            },
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
        async saveChanges() {
            try {
                const response = await axios.put(`http://127.0.0.1:8000/api/customers/${this.customer.id}`, this.customer);

                console.log("Changes saved:", response.data);
                this.$router.push("/customers"); //forwards to customers
            } catch (error) {
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
.rainbow-button {
    width: 650px;
    height: 40px;
    background-image: linear-gradient(90deg, #00C0FF 0%, #FFCF00 49%, #FC4F4F 80%, #00C0FF 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    border: none;
    margin-top: 10px;
}

.rainbow-button:hover {
    animation: slidebg 2s linear infinite;
}

@keyframes slidebg {
    to {
        background-position: 200px;
    }
}

.form {
    margin-left: 345px;
}

.custom-background {
    background-color: #f2f2f2;
    padding: 10px;
}
</style>