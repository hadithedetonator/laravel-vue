<template>
    <div>
      <h2>Register</h2>
      <form @submit.prevent="register">
        <div>
          <label for="name">Name</label>
          <input type="text" v-model="form.name" required>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="form.email" required>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" v-model="form.password" required>
        </div>
        <div>
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" v-model="form.password_confirmation" required>
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  
  export default {
    setup() {
      const form = ref({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      });
  
      const register = async () => {
        try {
          await axios.post('/register', form.value);
          // Redirect or show success message
        } catch (error) {
          console.error(error.response.data);
        }
      };
  
      return { form, register };
    },
  };
  </script>
  