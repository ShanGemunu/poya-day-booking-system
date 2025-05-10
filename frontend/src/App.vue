<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { getCurrentInstance } from 'vue'
import Logout from './components/Logout.vue'

const { proxy } = getCurrentInstance()

</script>

<template>

  <nav class="navbar">
    <RouterLink to="/">Booking Portal</RouterLink>
    <RouterLink to="/admin">Admin portal</RouterLink>
    <div>
      <RouterLink to="/login">Login</RouterLink>
      <Logout/>
    </div>
  </nav>

  <div class="view">
    <RouterView />
  </div>
</template>
