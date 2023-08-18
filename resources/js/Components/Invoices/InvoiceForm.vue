<template>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
      <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
        <div class="card">

          <form class="form-card" @submit.prevent="addInvoices">
            <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">

            <div class="row justify-content-between text-left mb-3">
              <div class="col-sm-6 flex-column d-flex">
                <label class="form-control-label px-3">Invoice Number<span class="text-danger"></span></label>
                <input v-model="invoice_number" placeholder="Invoice Number" class="form-control">
              </div>

              <div class="col-sm-6 flex-column d-flex custom-col">
                <CustomersSelectorComponent @customer-selected="handleOptionSelected" class="form-control-label">
                </CustomersSelectorComponent>
              </div>
            </div>

            <div class="row justify-content-between text-left mb-3">
              <div class="col-sm-6 flex-column d-flex">
                <label class="form-control-label px-3">Due Date<span class="text-danger"></span></label>
                <input type="date" v-model="due_date" class="form-control">
              </div>

              <div class="col-sm-6 flex-column d-flex">
                <label class="form-control-label px-3">Payment Term<span class="text-danger"></span></label>
                <select v-model="payment_term" class="form-select">
                  <option v-for="option in payment_term_options" :key="option" :value="option">
                    {{ option }}
                  </option>
                </select>
              </div>
            </div>

            <div class="row justify-content-between text-left mb-3">
              <div class="col-sm-6 flex-column d-flex">
                <label class="form-control-label px-3">Currency<span class="text-danger"></span></label>
                <select v-model="currency" class="form-select">
                  <option value="ron">RON</option>
                  <option value="eur">EUR</option>
                  <option value="usd">USD</option>
                </select>
              </div>

              <div class="col-sm-6 flex-column d-flex">
                <label class="form-control-label px-3">Type<span class="text-danger"></span></label>
                <select v-model="type" class="form-select">
                  <option value="general">General</option>
                </select>
              </div>
            </div>
            <div></div>

            <!-- <div class="row">
              <div class="col-md-5">
                <div class="form-group custom-background">
                  <strong class="custom-label">Amount</strong>
                </div>
                <div></div>
              </div>
            </div> -->

            <div v-for="(toggleItem, index) in toggleItems" :key="index">
              <div v-for="(item, itemIndex) in toggleItem.invoiceData" :key="itemIndex">
                <InvoiceItems class="1col-sm-6 flex-column d-flex" v-if="(index + 1) < toggleItems.length"
                  @amount-internal="updateAmount(index, itemIndex, $event)"
                  @description-internal="updateDescription(index, itemIndex, $event)">
                </InvoiceItems>
              </div>
            </div>

            <div class="form-group col-sm-6">
              <button type="button" class="btn-block btn-success" @click="addToggleItem">Toggle Items</button>
            </div>

            <div class="row justify-content-end">
              <div class="form-group col-sm-6">
                <button type="submit" class="btn-block btn-danger">Add New Invoices</button>
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
import CustomersSelectorComponent from '../Commons/CustomersSelectorComponent.vue';
import InvoiceItems from './InvoiceItems.vue';

export default {
  components: {
    CustomersSelectorComponent,
    // InvoiceItems,
  },
  data() {
    return {
      showTable: true,
      customer_id: '',
      invoice_number: '',
      due_date: '',
      payment_term: '',
      payment_term_options: ['7', '14', '30'],
      currency: 'ron',
      type: 'general',
      customers: [],
      // toggleItems: [{
      //   showItems: true,
      //   invoiceData: [{ amount: '', description: '' }]
      // }]
    };
  },
  methods: {
    handleOptionSelected(option) {
      this.customer_id = option;
    },
    initializePaymentTerm() {
      this.payment_term = this.payment_term_options[0];
    },
    showItemOne() {
      this.showItemOne = !this.showItemOne;
    },
    // addToggleItem() {
    //   this.toggleItems.push({
    //     showItems: true, // Inițializați cu true pentru a afișa imediat item-uri noi
    //     invoiceData: [{ amount: '', description: '' }],
    //   });
    // },
    // updateAmount(option) {
    //   this.amount = option;
    // },
    // updateDescription(option) {
    //   this.description = option;
    // },


    async addInvoices() {
      try {
        const csrfMeta = document.head.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfMeta ? csrfMeta.content : null;

        const headers = {
          'Content-Type': 'application/json',
        };

        if (csrfToken) {
          headers['X-CSRF-TOKEN'] = csrfToken;
        }

        const data = {
          customer_id: this.customer_id,
          invoice_number: this.invoice_number,
          due_date: this.due_date,
          payment_term: this.payment_term,
          currency: this.currency,
          type: this.type,
        };
        const response = await axios.post("/api/invoices", data, {
          headers: headers,
        });

        if (response.status === 200) {
          console.log("Invoice created successfully!");
          this.$router.push("/bills");
        } else {
          console.error("Error creating Invoice:", response.data);
        }
      } catch (error) {
        console.error("Error creating Invoice:", error);
      }
    },

    // toggleItems(index) {
    //   this.toggleItems[index].showItems = !this.toggleItems[index].showItems;
    // },

    // updateAmount(toggleIndex, itemIndex, newAmount) {
    //   this.toggleItems[toggleIndex].invoiceData[itemIndex].amount = newAmount;
    // },

    // updateDescription(toggleIndex, itemIndex, newDescription) {
    //   this.toggleItems[toggleIndex].invoiceData[itemIndex].description = newDescription;
    // },
  },
};
</script>

<style scoped>
@import '@/Assets/Components/invoices.css';
</style>
