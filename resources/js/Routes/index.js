import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import MainLayout from "../Layouts/Navbar/MainLayout.vue";
import CustomerList from "../Components/Customers/CustomerList.vue";
import CustomerForm from "../Components/Customers/CustomerForm.vue";
import CustomerEditForm from "../Components/Customers/CustomerEditForm.vue";
import CustomerShowForm from "../Components/Customers/CustomerShowForm.vue";
// End components

// Import invoices
import InvoiceEdit from "../Components/Invoices/InvoiceEdit.vue";
import InvoiceForm from "../Components/Invoices/InvoiceForm.vue";
import InvoiceList from "../Components/Invoices/InvoiceList.vue";
import InvoiceShow from "../Components/Invoices/InvoiceShow.vue";
// End invoices

// Inport User Profile
import UserProfile from "../Components/Commons/UserProfile.vue";
// End Users

const router = createRouter({
    history: createWebHistory(),
    routes: [


        { path: '/bills/', component: InvoiceList },
        { path: '/bills/create', component: InvoiceForm },
        { path: '/invoices/edit/:id', component: InvoiceEdit },
        { path: '/invoices/put/:id', component: InvoiceEdit },
        { path: '/invoices/show/:id', component: InvoiceShow },



        { path: '/', component: InvoiceList },
        { path: '/customers', component: CustomerList },
        { path: '/customers/create', component: CustomerForm },
        { path: '/customers/edit/:id', component: CustomerEditForm },
        { path: '/customers/put/:id', component: CustomerEditForm },
        { path: '/customers/show/:id', component: CustomerShowForm },


        { path: '/user-profile', component: UserProfile },
        // { path: '/logout', name: 'logout', component: Logout, },

        // { path: '/portfolio', component: Portfolio },
        // { path: '/contact', component: Contact },

    ]
});

const app = createApp(MainLayout);
app.config.globalProperties.$appUrl = import.meta.env.APP_URL;
app.use(router);
app.mount('#app');