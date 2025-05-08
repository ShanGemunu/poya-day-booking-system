<script setup>

const props = defineProps({
  name: String,
  age: Number,
})

const newAge =  props.age + 10

</script>

<template>
    <v-container>
        <!-- Trigger Button -->
        <v-btn @click="showSnackbar">Show snackbar</v-btn>

        <!-- Snackbar Alert -->
        <v-snackbar v-model="snackbar" :timeout="3000" color="red" location="top">
            ✅ Your name - {{ name }} and age - {{ newAge  }} 
        </v-snackbar>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            snackbar: false,
        };
    },
    methods: {
        showSnackbar() {
            this.snackbar = true;
        },
    },
};
</script>