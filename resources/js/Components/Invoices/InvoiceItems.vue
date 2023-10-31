<template>
    <div id="app">
        <div class="row" v-for="(input, k) in inputs" :key="k">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <ErrorMessages :errors="[amountError]" />
                    <input type="text" class="form-control" v-model="input.amount" @input="validateForm">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="details">Details</label>
                    <ErrorMessages :errors="[descriptionError]" />
                    <input type="text" class="form-control" v-model="input.description" @input="validateForm">
                </div>
            </div>
        </div>

        <div class="button1">
            <span class="MyAddRemove">
                <i class="my-custom-button btn-outline-danger btn-sm mr-2 center-align" @click="remove()">Remove</i>
                <i class="my-custom-button btn-outline-success btn-sm mr-2 center-align" @click="add()">Add fields</i>
            </span>
        </div>
    </div>
</template>


<script>
import ErrorMessages from '../Commons/ErrorMessages.vue';

    export default {
        components: {
            ErrorMessages,
        },
        props: {
            invoice_items: Array,
        },
        data() {
            return {
                inputs: [],
                amountError: '',
                descriptionError: '',
            }
        },
        watch: {
            invoice_items(newItems) {
                this.inputs = newItems.map(item => ({
                    amount: item.amount || '',
                    description: item.description || '',
                }));
            },
        },
        methods: {
            validateForm() {
                this.amountError = ''; 
                this.descriptionError = ''; 

                for (const input of this.inputs) {
                    if (!input.amount) {
                        this.amountError = 'The Amount field is required.';
                        break;
                    }
                    if (!input.description) {
                        this.descriptionError = 'The Description field is required.';
                        break; 
                    }
                }
                
            },
            add() {
                this.inputs.push({
                    amount: '',
                    description: ''
                })
                this.$emit('update:invoice_items', this.inputs);
            },

            remove(index) {
                this.inputs.splice(index, 1)
            },
            getItemsData() {

                const itemsData = this.inputs.map(input => ({
                    amount: input.amount,
                    description: input.description
                }));
                return itemsData;
            },
        },
    };
</script>

<style scoped>
.MyAddRemove {
    margin-left: 420px;
}
</style>