<template>
    <div>
        <a href="/logout" @click="logout">Logout</a>
    </div>
</template>
  


<script>
    export default {
        methods: {
        logout() {
            this.$router.push({ name: 'login' });
            },
        },
    };
</script> 