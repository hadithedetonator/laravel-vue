<template>
    <div>
      <h2 v-if="!editing">Add User</h2>
      <h2 v-else>Edit User</h2>
      <form @submit.prevent="submit">
        <div>
          <label for="name">Name</label>
          <input type="text" v-model="form.name" required>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="form.email" required>
        </div>
        <button type="submit">{{ editing ? 'Update' : 'Create' }}</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref, watch } from 'vue';
  import axios from 'axios';
  
  export default {
    props: ['user'],
    setup(props, { emit }) {
      const form = ref({
        name: props.user ? props.user.name : '',
        email: props.user ? props.user.email : '',
      });
      const editing = ref(!!props.user);
  
      const submit = async () => {
        if (editing.value) {
          await axios.put(`/api/users/${props.user.id}`, form.value);
        } else {
          await axios.post('/api/users', form.value);
        }
        emit('userAdded'); // Notify UserList to refresh
        form.value.name = '';
        form.value.email = '';
      };
  
      watch(() => props.user, (newUser) => {
        if (newUser) {
          form.value.name = newUser.name;
          form.value.email = newUser.email;
        }
      });
  
      return { form, editing, submit };
    },
  };
  </script>
  