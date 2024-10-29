<template>
    <div>
      <h2>User List</h2>
      <ul>
        <li v-for="user in users" :key="user.id">
          {{ user.name }} ({{ user.email }})
          <button @click="editUser(user)">Edit</button>
          <button @click="deleteUser(user.id)">Delete</button>
        </li>
      </ul>
      <user-form @userAdded="fetchUsers" />
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import UserForm from './UserForm.vue';
  
  export default {
    components: { UserForm },
    setup() {
      const users = ref([]);
  
      const fetchUsers = async () => {
        const response = await axios.get('/api/users');
        users.value = response.data;
      };
  
      const deleteUser = async (userId) => {
        await axios.delete(`/api/users/${userId}`);
        fetchUsers();
      };
  
      const editUser = (user) => {
        // Logic to edit user (perhaps show UserForm with user data)
      };
  
      onMounted(fetchUsers);
  
      return { users, fetchUsers, deleteUser, editUser };
    },
  };
  </script>
  