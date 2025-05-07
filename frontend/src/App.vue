<script setup>
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
  <div>
    <nav>
      <RouterLink to="/">Booking Protal</RouterLink>
      <RouterLink to="/admin">Admin portal</RouterLink>
      <RouterLink to="/login">Login</RouterLink>
    </nav>
  </div>
  <RouterView/>
</template>


