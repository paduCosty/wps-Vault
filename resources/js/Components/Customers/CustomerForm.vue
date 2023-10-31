<template>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <form  class="form-card">

                        <div class="row justify-content-between text-left">
                            <div class="col-sm-6 flex-column d-flex">
                                <ErrorMessages :errors="[company_nameError]" />

                                <label class="form-control-label px-3">Company Name<span class="text-danger"></span></label>
                                <input type="text" v-model="company_name" placeholder="Company Name" @input="validateForm">
                            </div>


                            <div class="col-sm-6 flex-column d-flex">
                                <ErrorMessages :errors="[contact_nameError]" />
                                <label class="form-control-label px-3">Contact Name<span class="text-danger"></span></label>
                                <input type="text" v-model="contact_name" placeholder="Contact Name" @input="validateForm">
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">E-mail<span class="text-danger"></span></label>
                                <input type="email" v-model="email" placeholder="E-mail" @input="validateForm">
                                <ErrorMessages :errors="[emailError]" />
                            </div>


                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Vat Number<span class="text-danger"></span></label>
                                <input type="number" v-model="vat_number" placeholder="Cuiul Firmei" @input="validateForm">
                                <ErrorMessages :errors="[vat_numberError]" />
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Type<span class="text-danger"></span></label>
                                <select v-model="type" @blur="validateForm">
                                    <option value="Business">Business</option>
                                    <option value="Individual">Individual</option>
                                </select>
                                <ErrorMessages :errors="[typeError]" />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6">
                                <input value="Add customer" type="button" @click="addCustomer" id="addCustomer"
                                    class="btn-block btn-danger">
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
import ErrorMessages from '../Commons/ErrorMessages.vue';


    export default {
        components: {
            ErrorMessages,
        },
        data() {
            return {
                showTable: true,
                company_name: '',
                contact_name: '',
                email: '',
                vat_number: '',
                type: '',
                company_nameError: '', 
                contact_nameError: '', 
                emailError: '', // 
                vat_numberError: '', 
                typeError: '', 
                formErrors: [],
            };
        },
        methods: {
        validateForm() {
            this.formErrors = [];

            const fields = {
                company_name: 'Company Name',
                contact_name: 'Contact Name',
                email: 'E-mail',
                vat_number: 'VAT Number',
                type: 'Type',
            };
            
            for (const field in fields) {
                if (!this[field]) {
                    this[`${field}Error`] = `The ${fields[field]} field is required`; // Schimbare aici
                    this.formErrors.push(this[`${field}Error`]); // Schimbare aici
                } else {
                    this[`${field}Error`] = ''; // Resetarea mesajului de eroare
                }
            }
        },
            async addCustomer() {
                try {
                    const csrfMeta = document.head.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfMeta ? csrfMeta.content : null;

                    const headers = {
                        'Content-Type': 'application/json',
                    };

                    if (csrfToken) {
                        headers['X-CSRF-TOKEN'] = csrfToken;
                    }

                    const response = await axios.post("/api/customers", {
                        company_name: this.company_name,
                        contact_name: this.contact_name,
                        email: this.email,
                        vat_number: this.vat_number,
                        type: this.type,
                    }, {
                        headers: headers,
                    });

                    if (response.status === 200) {
                        console.log("Customer created successfully!");
                        this.$router.push("/customers");
                    } else {
                        console.error("Error creating customer:");
                    }
                } catch (error) {
                    console.error("Error creating customer:", error);
                }
            },
        },
    };
</script>