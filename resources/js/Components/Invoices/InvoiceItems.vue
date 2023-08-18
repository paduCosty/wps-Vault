<template>
    <div>
        <label>Amount:</label>
        <input v-model="internalAmount" @input="emitinternalAmount" />

        <label>Description:</label>
        <input v-model="internalDescription" @input="emitinternalDescription" />
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            internalAmount: this.value ? this.value.amount : '',
            internalDescription: this.value ? this.value.description : '',
        };
    },
    watch: {
        emitinternalAmount(newAmount) {
            this.$emit('update:amount', newAmount);
        },
        emitinternalDescription(newDescription) {
            this.$emit('update:description', newDescription);
        },
    },
};
</script>
  
<style scoped>
/* Stiluri specifice pentru componenta */
</style>
  