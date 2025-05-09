<script setup>
import { ref, getCurrentInstance } from 'vue';

const { proxy } = getCurrentInstance()

const showDialog = ref(false)

// choose or not to approve
const isChooseToApprove = ref(false)

const pendingBookings = ref([])

const getPendingBookings = () => {
    proxy.$http.post(`pending-bookings`)
        .then(response => {
            pendingBookings.value = response.data.pendingBookings
        })
        .catch(error => {
            if (error.response.status === 401) {
                alert("You need to login as Admin to view this page!")
            }
        })
}

getPendingBookings()

// open dialog before appove or reject booking
const openDialog = (argIsChooseToApprove) => {
    // choose or not to approve
    isChooseToApprove.value = argIsChooseToApprove

    // pop up dialog
    showDialog.value = true
}

// close dialog right after approve or reject booking
const closeDialog = (isConfirm) => {
    // if action confirmed  
    if(isConfirm){
        // if choose to approve
        if(isChooseToApprove.value){
            alert("approved")
            // close dialog
            showDialog.value = false

            return
        }
        // if choose to reject
        alert("rejected")
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
                            @click="openDialog(true)"></v-btn>
                        <v-btn class="flex-grow-1" size="small" color="red" text="Reject" variant="flat"
                            @click="openDialog(false)"></v-btn>
                    </v-card-actions>
                    <v-dialog v-model="showDialog" max-width="400">
                        <v-card>
                            <v-card-title>Are sure want to</v-card-title>
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
