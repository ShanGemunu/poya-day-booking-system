<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Booking;
use App\Models\PoyaDay;


class BookingController extends Controller
{

    /**
     * get and send all pending bookings
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function pendingBookings()
    {
        $pendingBookings = Booking::where('status', 'pending')
            ->get();

        return response()->json([
            'pendingBookings' => $pendingBookings
        ], 200);
    }

    /**
     * update booking's status into 'approved' or 'rejected' AND 
     * poya day booked if booking approved
     *
     * @param  Request  $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function approveBooking(Request $request)
    {
        $approveDetails = $request->validate([
            'bookingId' => ['required', 'int', 'exists:bookings,id'],
            'approval' => ['required', 'string', Rule::in(['approved', 'rejected'])]
        ]);

        $booking = Booking::where('id', $approveDetails['bookingId'])
            ->where('status', 'pending')
            ->first();

        // update booking's status only if it's current status is 'pending'
        if ($booking) {
            // update booking
            Booking::where('id', $approveDetails['bookingId'])
                ->update(['status' => $approveDetails['approval']]);

            // booked the poya day if <approval> is 'approved'
            if ($approveDetails['approval'] === 'approved') {
                // add booking to poya day
                PoyaDay::where('id', $booking->poya_day_id)
                    ->update(['booking_id' => $booking->id]);
            }

            return response()->json([
                'message' => "booking's status updated successfully" 
            ], 200);
        }

        return response()->json([
            'message' => 'invalid booking id provided.'
        ], 422);
    }


    /**
     * make a new booking 
     *
     * @param  Request  $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function makeBooking(Request $request)
    {
        $bookingDetails = $request->validate([
            'poyaDayId' => ['required', 'int', 'min:1', 'max:12'],
            'name' => ['required', 'string', 'min:2', 'max:10'],
            'email' => ['required', 'email', 'max:20'],
            'phone' => ['required', 'string', 'size:10'],
            'notes' => ['required', 'string', 'max:300'],
        ]);

        $bookingDetails = array_merge(['poya_day_id' => $bookingDetails['poyaDayId']], $bookingDetails);
        unset($bookingDetails['poyaDayId']);

        // ->first()  -> return null on no records found matchted 
        $booking = Booking::where('poya_day_id', $bookingDetails['poya_day_id'])
            ->first();

        // if no booking records for poya day
        if (!$booking) {
            $bookingDetails['status'] = 'pending';
            Booking::create($bookingDetails);

            return response()->json([
                'message' => 'booking created succssfully.'
            ], 200);
        }

        $pendingOrApprovedBooking = Booking::where('poya_day_id', $bookingDetails['poya_day_id'])
            ->whereIn('status', ['approved', 'pending'])
            ->first();

        // if no pending or approved booking records for poya day
        if (!$pendingOrApprovedBooking) {
            $bookingDetails['status'] = 'pending';
            Booking::create($bookingDetails);

            return response()->json([
                'message' => 'booking created succssfully.'
            ], 200);
        }

        return response()->json([
            'message' => 'invalid poya day provided.'
        ], 422);

    }

}
