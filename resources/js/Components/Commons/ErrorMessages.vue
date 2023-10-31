<template>
    <div>
        <div class="error-messages">
            <div v-for="error in errors" :key="error.id">{{ error }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            errors: {
                error: [], 
                default: () => [], 
            },
        },
        
    };
</script>

<style scoped>
.error-messages{
    color: red;
}
</style>

