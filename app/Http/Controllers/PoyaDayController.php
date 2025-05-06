<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;

class PoyaDayController extends Controller
{
    /**
     * send poya days indicating their own status as open, pending or booked
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function poyaDays()
    {
        // another way to get only poya days of 'pending' or 'approved' 
        $pendingOrApprovedBookingsArray = Booking::where('status', 'pending')
            ->orWhere('status', 'approved')
            ->get()
            ->toArray();

        $poyaDays = [
            1 => 'open',
            2 => 'open',
            3 => 'open',
            4 => 'open',
            5 => 'open',
            6 => 'open',
            7 => 'open',
            8 => 'open',
            9 => 'open',
            10 => 'open',
            11 => 'open',
            12 => 'open',
        ];

        // change 'open' to 
        foreach ($poyaDays as $key => $poyaDay) {
            foreach ($pendingOrApprovedBookingsArray as $booking) {
                if($booking['poya_day_id'] === $key)
                    $poyaDays[$key] = $booking['status'];
            }
        }
       
        return response()->json([
            'poyaDays' => $poyaDays
        ], 200);
    }

}
