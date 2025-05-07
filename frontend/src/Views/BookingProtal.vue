<script setup>
import { ref } from 'vue'
import { getCurrentInstance } from 'vue'
import PoyaDayCard from '../components/PoyaDayCard.vue'

const { proxy } = getCurrentInstance()
const data = ref(null)

const getPoyaDays = (value) => {
    proxy.$http.post(`poya-days`)
    .then(response => { 
      data.value = response.data.poyaDays[value]
    })
    .catch(error => {
      console.log(error)
    })
  }

getPoyaDays(2)

</script>

<template>

  <h1>Booking Protal</h1>

  <button type="button" @click="getData(count)">get data</button>

    <PoyaDayCard/><br>
    <PoyaDayCard/> <br>
    <PoyaDayCard/> <br>
    <PoyaDayCard/> <br>

</template>


