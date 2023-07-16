import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import InvoiceList from "../Components/Invoices/InvoiceList.vue";
import MainLayout from "../Layouts/Navbar/MainLayout.vue";
import CustomerList from "../Components/Customers/CustomerList.vue";
import CustomerForm from "../Components/Customers/CustomerForm.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [

        { path: '/', component: InvoiceList },
        { path: '/customers', component: CustomerList },
        { path: '/customers/create', component: CustomerForm },
        // { path: '/portfolio', component: Portfolio },
        // { path: '/contact', component: Contact },
       
    ]
});

const app = createApp(MainLayout);
app.use(router);
app.mount('#app');
