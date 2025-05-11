<script setup>
import { ref, getCurrentInstance } from 'vue';

const { proxy } = getCurrentInstance()

const showDialog = ref(false)

// choose or not to approve booking
const isChooseToApprove = ref(false)

// booking id to be approved or rejcted
const bookingId = ref(null)

const pendingBookings = ref([])

// get pending bookings
const getPendingBookings = () => {
    proxy.$http.post(`pending-bookings`)
        .then(response => {
            let tempBookings = response.data.pendingBookings;

            response.data.pendingBookings.forEach((booking, index) => {
                for (let key of Object.keys(proxy.$globalVariables.poyaAndMonthNames)) {
                    if (parseInt(key) === booking.poya_day_id) {
                        tempBookings[index].poyaDay = proxy.$globalVariables.poyaAndMonthNames[key].poyaName
                    }
                }
            });

            pendingBookings.value = tempBookings
        })
        .catch(error => {
            if (error.response.status === 401) {
                alert("You need to login as Admin to view this page!")
            }
        })
}

getPendingBookings()


// approve a booking, <argApproval> -> 'approve' or 'reject'
const approveBooking = (argApproval) => {
    proxy.$http.post(`approve-bookings`, {
        bookingId: bookingId.value,
        approval: argApproval
    })
        .then(response => {
            alert("Booking " + argApproval + " successfully.")
            getPendingBookings()
        })
        .catch(error => {
            if (error.response.status === 401) {
                alert("You need to login as Admin to view this page!")
            }
            if (error.response.status === 422) {
                let errors = "";
                Object.values(error.response.data.errors).forEach(value => {
                    errors += value[0] + " "
                })
                alert(errors)
            }
        })
}

// open dialog before appove or reject booking
const openDialog = (argIsChooseToApprove, argBookingId) => {
    // choose or not to approve
    isChooseToApprove.value = argIsChooseToApprove

    //set booking id to be approved or rejected
    bookingId.value = argBookingId

    // pop up dialog
    showDialog.value = true
}

// close dialog right after approve or reject booking
const closeDialog = (isConfirm) => {
    // if action confirmed  
    if (isConfirm) {
        // if choose to approve
        if (isChooseToApprove.value) {
            approveBooking("approved")
            // close dialog
            showDialog.value = false

            return
        }
        // if choose to reject
        approveBooking("rejected")
    }

    // close dialog
    showDialog.value = false
}

const headers = [
    { title: 'Poya Day', key: 'poyaDay' },
    { title: 'Name', key: 'name' },
    { title: 'Email', key: 'email' },
    { title: 'Phone', key: 'phone' },
    { title: 'Notes', key: 'notes' },
    { title: 'Created', key: 'created_at' },
    { title: '', key: 'approval' },
]

</script>


<template>
    <v-data-table :headers="headers" :items="pendingBookings" class="text-caption" density="compact" item-value="name"
        hide-default-footer hover>
        <template v-slot:item="{ item }">
            <tr class="text-no-wrap">
                <td>{{ item.poyaDay }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.phone }}</td>
                <td>{{ item.notes }}</td>
                <td>{{ item.created_at }}</td>
                <td class="text-end">
                    <v-card-actions>
                        <v-btn class="flex-grow-1" size="small" color="green" text="Approve" variant="flat"
                            @click="openDialog(true, item.id)"></v-btn>
                        <v-btn class="flex-grow-1" size="small" color="red" text="Reject" variant="flat"
                            @click="openDialog(false, item.id)"></v-btn>
                    </v-card-actions>
                    <v-dialog v-model="showDialog" max-width="400">
                        <v-card>
                            <v-card-title>Are sure want to do this?</v-card-title>
                            <v-card-text>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn @click="closeDialog(true)">Confirm</v-btn>
                                <v-btn @click="closeDialog(false)">Cancel</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>
