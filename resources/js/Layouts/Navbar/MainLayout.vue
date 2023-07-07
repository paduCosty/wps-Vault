<template>
    <div class="">
        <header>
            <div class="">
                <div>
                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                        <router-link to="/" class="nav-link">
<!--                            <ApplicationLogo/>-->
                            <text id="WebPad-Solution" class="text-logo">WebPad-Solution</text>
                        </router-link>
                        <li>
                            <router-link to="/customers" class="nav-link">
                                Home
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/about" class="nav-link">
                                About
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/portfolio" class="nav-link">
                                Portfolio
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/contact" class="nav-link">
                                Contact
                            </router-link>
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
// import ApplicationLogo from "../Components/ApplicationLogo.vue";
// import "../Assets/navbar.css"

export default {
    name: 'App',
    // components: {ApplicationLogo}
}
</script>
