<template>
    <div class="TableUser">
        <h2 class="Pragraf v-cloak">{{ user.contact_name }}</h2>

        <form @submit.prevent="updateUser" class="user-profile-form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_name">Contact Name:</label>
                        <div @click="emitContactName" class="form-control">{{ user.contact_name }}</div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="form-control">{{ user.email }}</div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" v-model="user.phone" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="business_name">Business Name:</label>
                        <input type="text" class="form-control" v-model="user.business_name" required>
                    </div>

                    <div class="form-group">
                        <label for="vat_number">VAT Number(Cui):</label>
                        <input type="text" class="form-control" v-model="user.vat_number" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" v-model="user.address" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios';

export default {

    name: 'UserProfile',
    data() {
        return {
            user: Object,
            contact_name: '',
        };
    },
    mounted() {
        axios.get('/api/user-profile').then((response) => {
            this.user = response.data;
        });

    },
    methods: {
        updateUser() {
            axios.put('/api/user-profile/update', this.user).then((response) => {
                this.user = response.data;
                this.$router.push('/bills');
            });
        },
    },
    navigateToUserProfile() {
        this.$router.push({ name: 'user-profile', params: { user: this.user } });
    },
};
</script>

<style>
@import '@/Assets/Components/UserProfile.css';
</style>
