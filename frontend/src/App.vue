<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { getCurrentInstance } from 'vue'

const { proxy } = getCurrentInstance()

</script>

<template>

  <nav class="navbar">
    <RouterLink to="/">Booking Portal</RouterLink>
    <RouterLink to="/admin">Admin portal</RouterLink>
    <RouterLink to="/login">Login</RouterLink>
  </nav>

  <div class="view">
    <RouterView />
  </div>
</template>
