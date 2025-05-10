<script setup>
import { reactive, getCurrentInstance } from 'vue'

const { proxy } = getCurrentInstance()

const credentials = reactive({
  email: '',
  password: '',
})

function login() {

  proxy.$http.post(`login`, {
    ...credentials
  })
    .then(response => {
      localStorage.setItem(
        "access_token",
        response.data["access-token"]
      );
      window.location.replace(window.location.origin);

      alert("You are logged in");
    })
    .catch(error => {
      if (error.response.status === 422) {
        let errors = "";
        Object.values(error.response.data.errors).forEach(value => {
          errors += value[0] + " "
        })

        alert(errors)
      }
      if (error.response.status === 401) {

        alert("Password wrong!")
      }
      if (error.response.status === 403) {

        alert("You already logged in!")
      }
    })
}

</script>

<template>
  <h1>Login Here</h1>

  <form class="view">
    <input v-model="credentials.email" placeholder="Email" type="email" /><br>
    <input v-model="credentials.password" placeholder="Password" type="password" /><br>
    <v-btn @click="login()">Login</v-btn>
  </form>
</template>