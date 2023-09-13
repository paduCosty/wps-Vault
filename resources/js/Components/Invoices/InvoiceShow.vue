<template>
    <h1 class="Invoice top-header">Invoice</h1>
    <div class="invoice-border">
        <div class="invoice-show">
            <label class="INum ">Invoice Number--{{ invoice.invoice_number }}</label>
            <div class="container mt-4">
                <form class="form">
                    <div class="row mb-3">

                        <div class="col-md-4 right">
                            <label class="UBus form-label">Business Name:</label>
                            <div class="UBus1 form-control">{{ invoice.user ? invoice.user.business_name : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4 right">
                            <label class="UVat form-label">Vat Numer:</label>
                            <div class="UVat1 form-control">{{ invoice.user ? invoice.user.vat_number : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="UAdr form-label">Addres:</label>
                            <div class="UAdr1 form-control">{{ invoice.user ? invoice.user.address : 'N/A' }}</div>
                        </div>
                        <div class="col-md-4 right">
                            <label class="UCon form-label">Contact Name:</label>
                            <div class="UCon1 form-control">{{ invoice.user ? invoice.user.contact_name : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="UEmail form-label">E-mail:</label>
                            <div class="UEmail1 form-control">{{ invoice.user ? invoice.user.email : 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="Cos form-label">Customer Name:</label>
                            <div class="Cos1 form-control">{{ invoice.customer ? invoice.customer.contact_name : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="Com form-label">CompanyName:</label>
                            <div class="Com1 form-control">{{ invoice.customer ? invoice.customer.company_name : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="Vat form-label">VatNumber:</label>
                            <div class="Vat1 form-control">{{ invoice.customer ? invoice.customer.vat_number : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="Email form-label">Email:</label>
                            <div class="Email1 form-control">{{ invoice.customer ? invoice.customer.email : 'N/A' }}</div>
                        </div>

                        <div class="Due col-md-4">
                            <label class="form-label">Due Date:</label>
                            <div class="form-control">{{ invoice.due_date }}</div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button @click="ToInvoices" class="btn btn-secondary">Back to Invoices</button>
                        </div>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in invoice_items" :key="index">
                                    <td class="item-number">{{ index + 1 }}.</td>
                                    <td class="item-type">
                                        <label>Type:</label>
                                        <div class="form-label">{{ invoice.type }}</div>
                                    </td>
                                    <td class="item-currency">
                                        <label>Currency:</label>
                                        <div class="form-label">{{ invoice.currency }}</div>
                                    </td>
                                    <td class="item-amount">
                                        <label>Amount:</label>
                                        <div class="form-label">{{ item.amount }}</div>
                                    </td>
                                    <td class="item-description">
                                        <label>Description:</label>
                                        <div class="form-label">{{ item.description }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>





                </form>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            invoice: {
                customer: '',
                invoice_number: "",
                due_date: "",
                amount: '',
                description: '',
                payment_term: "",
                currency: "",
                type: "general",
                itens: [],
                id: null,

            },
            customer: [],
            invoice_items: [],
        };
    },
    methods: {
        async fetchInvoices(id) {
            try {
                const response = await axios.get(`/api/invoices/${id}`);
                this.invoice = response.data;
                this.user = response.data;
                this.invoice_items = this.invoice.invoice_items;

            } catch (error) {
                console.error("Error fetching invoice:", error);
            }
        },
        // Method for redirection to "Customers";
        ToInvoices() {
            this.$router.push("/bills");
        },
    },

    created() {
        const invoicesId = this.$route.params.id;
        this.fetchInvoices(invoicesId);
    },
};
</script>


<style scoped>
@import '@/Assets/Components/invoices.css';

.for {
    border: 3px solid #080606;
    border-radius: 10px;
    padding: 60px;
    margin-right: 9000x;
    display: flex;
}

.custom-border {
    border: 3px solid #080606;
    border-radius: 10px;
    padding: 100px;
    width: 1086px;
    max-width: none;
    position: relative;
    top: -180px;
    padding-left: 1100px;
    margin-left: -119px;
}



/* Show Invoices */
.invoice-show {
    max-width: 1200px;
    height: 20px;
    margin: 0 auto;
    padding: 100px;
    border: 3px solid #080606;
    border-radius: 10px;
    background-color: #fcfafa;
}

.form-control {
    border: none;
}

button.btn.btn-secondary {
    position: relative;
    top: -195px;
    margin-left: -110px;
}


.Invoice {
    /*Title Invoice  */
    margin-top: -100;
    position: absolute;
    margin-left: 540px;
    font-size: 50px;
}

.UBus {
    /* User Business name */
    position: relative;
    top: -143px;
    margin-left: -88px;
}

.UBus1 {
    /* User Business name */
    position: relative;
    top: -180px;
    margin-left: 29px;
    font-size: 13px;

}

.UVat {
    /* User Vat Number */
    position: relative;
    top: -112px;
    margin-left: -420px;
}

.UVat1 {
    /* User Vat Number */
    position: relative;
    top: -148px;
    margin-left: -302px;
    font-size: 13px;
}

.UAdr {
    /* User Adress */
    position: relative;
    top: -80px;
    margin-left: -750px;
}

.UAdr1 {
    /* User Adress */
    position: relative;
    top: -116px;
    margin-left: -633px;
    font-size: 13px;
}

.UCon {
    /* User Contact Name */
    position: relative;
    top: -114px;
    margin-left: -86px;
}

.UCon1 {
    /* User Contact Name */
    position: relative;
    top: -148px;
    margin-left: 30px;
    font-size: 13px;
}

.UEmail {
    /* User Email */
    position: relative;
    top: -80px;
    margin-left: -418px;
}

.UEmail1 {
    /* User Email */
    position: relative;
    top: -116px;
    margin-left: -302px;
    font-size: 13px;
}

.Cos {
    /* User Email */
    position: relative;
    top: -208px;
    margin-left: -22px;
}

.Cos1 {
    /* User Email */
    position: relative;
    top: -243px;
    margin-left: 109px;
    font-size: 13px;
}

.Com {
    /* User Email */
    position: relative;
    top: -241px;
    margin-left: 642px;
}


.Com1 {
    /* User Email */
    position: relative;
    top: -275px;
    margin-left: 770px;
    font-size: 13px;
}

.Vat {
    /* Vat Number Customer */
    position: relative;
    top: -209px;
    margin-left: 312px;
}

.Vat1 {
    /* Vat Number Customer */
    position: relative;
    top: -243px;
    margin-left: 440px;
    font-size: 13px;
}

.Email {
    /* E-mail Customer */
    position: relative;
    top: -175px;
    margin-left: -19px;
}

.Email1 {
    /* E-mail Customer */
    position: relative;
    top: -211px;
    margin-left: 107px;
    font-size: 13px;
}

.Due {
    /* Due Date Customr */
    position: initial;
    margin-top: -220px;
    margin-left: 336px;
}

.INum {
    position: relative;
    margin-top: 80;
    margin-left: 348px;
}

.INum1 {
    position: relative;
    margin-top: 240;
    margin-left: 480px;
}



.invoice-details {
    border: 3px solid #080606;
    border-radius: 20px;
    padding: 100px;
    width: 1200px;
    max-width: none;
    position: relative;
    top: -180px;
    margin-left: -113px;
}

.invoice-item {
    display: flex;
    justify-content: space-between;
    align-items: top;
    padding: 1px 0;
    border-bottom: 0px solid #000;
}

.item-number {
    font-weight: bold;
    margin-right: 40px;
    margin-top: -90px;
    margin-left: -50px;
}

.item-type,
.item-currency,
.item-amount,
.item-description {
    flex-grow: 10;
}



.invoice-details {
    border: 3px solid #080606;
    border-radius: 20px;
    padding: 20px;
    /* Reducem padding-ul pentru a face aspectul mai compact */
    width: 1200px;
    max-width: none;
    position: relative;
    top: -180px;
    margin-left: -113px;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
}

.invoice-table th,
.invoice-table td {
    border: 1px solid #000;
    padding: 10px;
    text-align: left;
}

.item-number {
    font-weight: bold;
}

.item-type,
.item-currency,
.item-amount,
.item-description {
    flex-grow: 1;
}

.item-type label,
.item-currency label,
.item-amount label,
.item-description label {
    display: block;
    font-weight: bold;
}

.item-type .form-label,
.item-currency .form-label,
.item-amount .form-label,
.item-description .form-label {
    margin-top: 5px;
}

.item-number,
.item-type,
.item-currency,
.item-amount,
.item-description {
    vertical-align: top;
}
</style>