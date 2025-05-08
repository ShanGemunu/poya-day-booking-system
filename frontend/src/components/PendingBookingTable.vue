<script setup>
import { ref, onMounted } from 'vue';

// Reactive state for snackbar visibility
const snackbar = ref(false);
const isActive = ref(false);

// Show snackbar function
function showSnackbar() {
  snackbar.value = true;
}

function test(){
    isActive.value = false
    showSnackbar()
}

const headers = [
    { title: 'ID', key: 'id', align: 'start' },
    { title: 'Name', key: 'name' },
    { title: 'Dept', key: 'department' },
    { title: 'Role', key: 'role' },
    { title: 'Salary($)', key: 'salary', align: 'end' },
    { title: 'HireDate', key: 'hireDate' },
    { title: 'Hours/Wk', key: 'hoursPerWeek', align: 'end' },
    { title: 'Location', key: 'location' },
    { title: 'Status', key: 'status' },
    { title: '', key: 'score', align: 'end' },
]
const employees = [
    {
        id: 'E001',
        name: 'Alice Johnson',
        department: 'Engineering',
        role: 'Software Dev',
        salary: 95000,
        hireDate: '2020-03-15',
        hoursPerWeek: 40,
        location: 'New York',
        status: 'Full-Time',
        score: 4.5,
    },
    {
        id: 'E001',
        name: 'Alice Johnson',
        department: 'Engineering',
        role: 'Software Dev',
        salary: 95000,
        hireDate: '2020-03-15',
        hoursPerWeek: 40,
        location: 'New York',
        status: 'Full-Time',
        score: 4.5,
    },
]

const clickFunc = (itemScore) => alert(itemScore)

</script>


<template>
    <v-container>
    <!-- Trigger Button -->
    <v-btn @click="showSnackbar">Show snackbar</v-btn>

    <!-- Snackbar Alert -->
    <v-snackbar v-model="snackbar" :timeout="3000" color="red" location="top">
      ✅ Your name
    </v-snackbar>
  </v-container>
    <v-data-table :headers="headers" :items="employees" class="text-caption" density="compact" item-value="name"
        hide-default-footer hover>
        <template v-slot:item="{ item }">
            <tr class="text-no-wrap">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.department }}</td>
                <td>{{ item.role }}</td>
                <td :class="{
                    'text-end': true,
                    'bg-success': item.salary > 80000,
                    'bg-warning': item.salary > 70000 && item.salary <= 80000,
                    'bg-error': item.salary <= 70000
                }" v-text="`$${item.salary.toLocaleString()}`"></td>
                <td>{{ item.hireDate }}</td>
                <td class="text-end">{{ item.hoursPerWeek }}</td>
                <td>{{ item.location }}</td>
                <td>{{ item.status }}</td>
                <td class="text-end">
                    <v-chip :text="item.score.toFixed(2)" append-icon="mdi-open-in-new" size="x-small"></v-chip>
                    <v-btn class="flex-grow-1" color="blue" text="Book Now" variant="flat"
                        @click="clickFunc(item.score)"></v-btn>
                    <v-dialog v-model="isActive" max-width="500" >
                        <template v-slot:activator="{ props: activatorProps }">
                            <v-btn v-bind="activatorProps" color="surface-variant" text="Open Dialog"
                                variant="flat"></v-btn>
                        </template>

                        <template v-slot:default="{ isActive }">
                            <v-card title="Dialog">
                                <v-card-text>
                                    {{ item.name }}
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>

                                    <v-btn text="Yes" @click="test"></v-btn>
                                    <v-btn text="No" @click="test"></v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                    </v-dialog>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>

