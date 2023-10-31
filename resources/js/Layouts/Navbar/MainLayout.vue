<template>
    <div class="">
        <header>
            <div class="">
                <div>
                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                        <router-link to="/" class="nav-link">
                            <text id="WebPad-Solution" class="text-logo"></text>
                        </router-link>
                        <li>
                            <router-link to="/customers" class="nav-link">
                                Customers
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/bills" class="nav-link">
                                Bills
                            </router-link>
                        </li>
                        <!--                        <li>-->
                        <!--                            <router-link to="/portfolio" class="nav-link">-->
                        <!--                                Portfolio-->
                        <!--                            </router-link>-->
                        <!--                        </li>-->
                        <!--                        <li>-->
                        <!--                            <router-link to="/contact" class="nav-link">-->
                        <!--                                Contact-->
                        <!--                            </router-link>-->
                        <!-- </li>
                        -->
                        <li class="nav-item ml-auto">
                            <div class="dropdown">
                                <router-link to="/user-profile" class="nav-link" role="button">
                                    <button ref="button" type="button" class="nav-link">
                                        {{ contact_name }}
                                    </button>
                                </router-link>
                                <form action="/logout" method="POST">
                                    <button type="submit">Logout</button>
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </header>

        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import UserProfile from '@/Components/Commons/UserProfile.vue';

// import ApplicationLogo from "../Components/ApplicationLogo.vue";
// import "../Assets/navbar.css"

export default {
    components:{
        UserProfile,
    },
    data() {
        return {
            users: [],
            contact_name: '',
        };
    },
    mounted() {
        axios.get('/api/user-profile').then((response) => {
            this.users = response.data;
            this.contact_name = this.users.contact_name;
        });
    },
    methods: {
        updateUser() {
            axios.put('/api/user-profile/update', this.user).then((response) => {
                this.user = response.data;
            });
        },
    },
};
</script>

<style>
@import '@/Assets/Components/UserProfile.css';
</style>
