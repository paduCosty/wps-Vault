<template>
    <div id="app">
        <div class="row" v-for="(input, k) in inputs" :key="k">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" v-model="input.amount">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" class="form-control" v-model="input.description">
                </div>
            </div>
        </div>

        <div class="button1">
            <span class="MyAddRemove">
                <i class="my-custom-button btn-outline-success btn-sm mr-2 center-align" @click="remove()">Remove</i>
                <i class="my-custom-button btn-outline-success btn-sm mr-2 center-align" @click="add()">Add fields</i>
            </span>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            invoice_items: Array,
        },
        data() {
            return {
                inputs: [],
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