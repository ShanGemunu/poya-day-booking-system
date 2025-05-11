<script setup>
import { getCurrentInstance } from 'vue'

const { proxy } = getCurrentInstance()

function logout() {
    proxy.$http.post(`logout`)
        .then(response => {
            localStorage.removeItem("access_token");
            window.location.replace(window.location.origin + "/login");

            alert("You are logged out");
        })
        .catch(error => {
            if (error.response.status === 401) {

                alert("You are not logged in to LOG OUT!")
            }
        })
}

</script>

<template>
    <v-btn @click="logout()">Logout</v-btn>
</template>
