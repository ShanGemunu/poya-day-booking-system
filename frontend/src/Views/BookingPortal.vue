<script setup>
import { ref, getCurrentInstance } from 'vue'
import PoyaDayCard from '../components/PoyaDayCard.vue'

const { proxy } = getCurrentInstance()

const poyaDays = ref([])

const getPoyaDays = () => {
  proxy.$http.post(`poya-days`)
    .then(response => {
      let tempPoyaDaysDetails = proxy.$globalVariables.poyaAndMonthNames;

      for (let keyOne of Object.keys(response.data.poyaDays)) {
        for (let keyTwo of Object.keys(tempPoyaDaysDetails)) {
          if (keyOne === keyTwo) {
            tempPoyaDaysDetails[keyTwo].status = response.data.poyaDays[keyOne]
          }
        }
      }

      poyaDays.value = Object.entries(tempPoyaDaysDetails).map(([key, value]) => ({
        id: Number(key),
        ...value
      }));

    })
    .catch(error => {

    })
}

getPoyaDays()

</script>

<template>
  <div class="header-banner">
    <h1>Booking Portal</h1>
    <h3 class="sub-title">Book your sermons for the upcoming Poya days</h3>
  </div>
  
  <div class="container">
    
      <PoyaDayCard v-for="(poyaDay, index) in poyaDays" :key="poyaDay.id" :poyaDay="poyaDay" />
  
  </div>

</template>
