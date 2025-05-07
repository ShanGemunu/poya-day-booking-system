<template>
    <v-card class="mx-auto" max-width="344" variant="outlined" hover>
        <v-card-text>
        
            <p class="text-h4 font-weight-bold">Poya Day</p>

            <p class="text-h6">Month 2025</p>

            <v-chip color="green">
                <p class="text-subtitle-1 font-weight-bold">Available</p>
    </v-chip>
    <v-chip color="red">
                <p class="text-subtitle-1 font-weight-bold">Available</p>
    </v-chip>
    <v-chip color="orange">
                <p class="text-subtitle-1 font-weight-bold">Available</p>
    </v-chip>

        </v-card-text>

        <v-card-actions>
            <v-btn class="flex-grow-1" color="blue" text="Book Now" variant="flat" ></v-btn>
            <v-btn class="flex-grow-1" color="grey" text="Already Booked" variant="flat" disabled></v-btn>
        </v-card-actions>
    </v-card>
</template>