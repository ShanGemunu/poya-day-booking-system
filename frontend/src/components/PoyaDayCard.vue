<script setup>
import { computed, ref, reactive, getCurrentInstance } from 'vue'
import FormDialog from './FromDialog.vue'

const { proxy } = getCurrentInstance()

const props = defineProps({
    poyaDay: Object,
})

const chip = computed(() => {
    const map = {
        approved: { color: 'red', label: 'Booked' },
        pending: { color: 'orange', label: 'Pending' },
        open: { color: 'green', label: 'Available' }
    }
    return map[props.poyaDay.status] || { color: 'grey', label: 'Unknown' }
})

const button = computed(() => {
    const map = {
        approved: { color: 'grey', label: 'Already Booked' },
        pending: { color: 'grey', label: 'Pending' },
        open: { color: 'blue', label: 'Book Now' }
    }
    return map[props.poyaDay.status] || { color: 'grey', label: 'Unknown' }
})

// form values
const form = reactive({
    name: '',
    email: '',
    phone: '',
    notes: ''
})

const showDialog = ref(false)

function makeBooking(isConfirmed) {
    if (isConfirmed) {
        proxy.$http.post(`make-booking`, {
            poyaDayId: props.poyaDay.id,
            ...form
        })
            .then(response => {
                alert("Booking created successfully. Navigate back to booking portal or Reload page to see new changes.");
            })
            .catch(error => {
                if (error.response.status === 422) {
                    let errors = "";
                    Object.values(error.response.data.errors).forEach(value => {
                        errors += value[0] +" " 
                    })
                    alert(errors)
                }
            })
    }
    showDialog.value = false
}

</script>

<template>
    <v-card class="mx-auto poya-card" max-width="344" variant="outlined" hover>
        <v-card-text>

            <p class="text-h5 font-weight-bold">{{ poyaDay.poyaName }} Poya</p>

            <p class="text-h6">{{ poyaDay.month }} 2025</p>

            <v-chip :color="chip.color">
                <p class="text-subtitle-1 font-weight-bold">{{ chip.label }}</p>
            </v-chip>

        </v-card-text>

        <v-card-actions>
            <v-btn class="flex-grow-1" :color="button.color" :text="button.label" variant="flat"
                @click="showDialog = true" :disabled="button.color === 'grey'"></v-btn>
        </v-card-actions>

    </v-card>

    <v-dialog v-model="showDialog" max-width="400">
        <v-card>
            <v-card-title>Book Dhamma Sermon</v-card-title>
            <v-card-text>
                <form>
                    <input v-model="form.name" placeholder="Name" /><br>
                    <input v-model="form.email" placeholder="Email" /><br>
                    <input v-model="form.phone" placeholder="Phone" /><br>
                    <textarea v-model="form.notes" rows="4" cols="45" placeholder="text.."></textarea>
                </form>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="makeBooking(true)">Confirm</v-btn>
                <v-btn @click="makeBooking(false)">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
