require('./bootstrap');

import { createApp } from 'vue';
import Register from './components/Auth/Register.vue';
import Login from './components/Auth/Login.vue';
import UserList from './components/User/UserList.vue';
import UserForm from './components/User/UserForm.vue';

const app = createApp({});

// Register components globally
app.component('register-component', Register);
app.component('login-component', Login);
app.component('user-list', UserList);
app.component('user-form', UserForm);

app.mount('#app');
