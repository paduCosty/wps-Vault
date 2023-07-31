import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import InvoiceList from "../Components/Invoices/InvoiceList.vue";
import MainLayout from "../Layouts/Navbar/MainLayout.vue";
import CustomerList from "../Components/Customers/CustomerList.vue";
import CustomerForm from "../Components/Customers/CustomerForm.vue";
import CustomerEditForm from "../Components/Customers/CustomerEditForm.vue";
import CustomerShowForm from "../Components/Customers/CustomerShowForm.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [

        { path: '/', component: InvoiceList },
        { path: '/customers', component: CustomerList },
        { path: '/customers/create', component: CustomerForm },
        { path: '/customers/edit/:id', component: CustomerEditForm },
        { path: '/customers/put/:id', component: CustomerEditForm },
        { path: '/customers/show/:id', component: CustomerShowForm },

        /*Modifica aici rutele pentru facturi vafi tot asa un crud*/
        // { path: '/bills', component: CustomerList },
        // { path: '/customers/create', component: CustomerForm },
        // { path: '/customers/edit/:id', component: CustomerEditForm },
        // { path: '/customers/put/:id', component: CustomerEditForm },
        // { path: '/customers/show/:id', component: CustomerShowForm },

        // { path: '/portfolio', component: Portfolio },
        // { path: '/contact', component: Contact },

    ]
});

const app = createApp(MainLayout);
app.config.globalProperties.$appUrl = import.meta.env.APP_URL;
app.use(router);
app.mount('#app');
