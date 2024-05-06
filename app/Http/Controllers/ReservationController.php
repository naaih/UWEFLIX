<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Role;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'show_id' => ['required', Rule::exists(\App\Models\Show::class, 'id')],
            'selected_seats' => ['array'],
        ]);

        // create the reservations of the requested seats
        foreach ($attr['selected_seats'] as $seat) {
            Reservation::create([
                'show_id' => $attr['show_id'],
                'user_id' => auth()->id(),
                'seat_number' => $seat,
            ]);
        }

        // decrement the remaining_seats of the specific show
        $show = Show::find($attr['show_id']);
        $show->remaining_seats = $show->remaining_seats - sizeof($attr['selected_seats']);
        $show->save();
    }

    public function printTicket(Reservation $reservation)
    {
        // Retrieve reservation details
        $show = $reservation->show;
        $user = $reservation->user;
        $seatNumber = $reservation->seat_number;

        // Create new Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content for the ticket
        $html = view('components.ticket', compact('show', 'user', 'seatNumber'))->render();

        // Load HTML into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper([0, 0, 400, 400]);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF
        return $dompdf->stream('ticket_' . $reservation->id . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        // increment show's remaining seats
        $reservation->show->remaining_seats++;
        $reservation->show->save();

        // delete reservation itself from db
        $reservation->delete();

        return redirect('dashboard')->with([
            'flash' => 'success',
            'message' => 'Successfully canceled your reservation. You will be refunded the ticket\'s amount.',
        ]);
    }
}
