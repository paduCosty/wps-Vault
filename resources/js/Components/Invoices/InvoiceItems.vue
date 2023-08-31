<template>
    <div id=app>
        <div class="row justify-content-between text- mb-3" v-for="(input, k) in inputs" :key="k">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input id="input" type="text" class="form-control" v-model="input.amount">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" class="form-control" v-model="input.description">
                </div>
            </div>
        </div>

        <div class="button">
            <span>
                <i class="fas fa-minus-circle btn btn-warning mr-2" @click="remove()">Remove</i>
                <i class="fas fa-plus-circle btn btn-success" @click="add()">Add fields</i>
            </span>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        invoice_items_id: '',
    },
    data() {
        return {
            inputs: [{
                amount: '',
                description: '',
            }]
        }
    },
    watch: {
        invoice_items_id(newId) {
        this.inputs.forEach(input => {
            input.invoice_items = newId;
        });
        },
    },
    methods: {
        add() {
            this.inputs.push({
                amount: '',
                description: ''
            })
        },
        remove(index) {
            this.inputs.splice(index, 1)
        },

        getItemsData() {
            const itemsData = [];
            this.inputs.forEach(input => {
                itemsData.push({
                    amount: input.amount,
                    description: input.description
                });
            });
            console.log(itemsData);
            return itemsData;
        },
    },
};
</script>

<style scoped>
.button {
    margin-right: 400px;
    margin-top: -10px;
}
</style>