<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="form.email" required>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" v-model="form.password" required>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    setup() {
      const form = ref({
        email: '',
        password: '',
      });
  
      const login = async () => {
        try {
          await axios.post('/login', form.value);
          // Redirect to home page
        } catch (error) {
          console.error(error.response.data);
        }
      };
  
      return { form, login };
    },
  };
  </script>
  