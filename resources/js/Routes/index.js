import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import InvoiceList from "../Components/Invoices/InvoiceList.vue";
import MainLayout from "../Layouts/Navbar/MainLayout.vue";
import CustomerList from "../Components/Customers/CustomerList.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [

        { path: '/', component: InvoiceList },
        { path: '/customers', component: CustomerList },
        // { path: '/portfolio', component: Portfolio },
        // { path: '/contact', component: Contact },

    ]
});

const app = createApp(MainLayout);
app.use(router);
app.mount('#app');
