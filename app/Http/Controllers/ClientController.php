<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $halls = Hall::query()->where(['is_open' => true])->get();
        $movies = Movie::with('sessions')->get();
        $seances = Session::all();

        return view('client.index', [
            'halls' => $halls,
            'movies' => $movies,
            'seances' => $seances,
        ]);
    }

    public function hall(int $id): View
    {
        $seance = Session::findOrFail($id);
        $movie = Movie::findOrFail($seance->movie_id);
        $hall = Hall::findOrFail($seance->hall_id);
        Seat::query()->create([
            'session_id' => $seance->id,
            'seance_seats' => [],
            'selected_seats' => [],
        ]);
        $seats = Seat::where('session_id', $seance->id)->first();
        if ($seats->seance_seats == []) {
            $seats->seance_seats = $hall->seats;
        }
        $seats->save();

        return view('client.hall', [
            'seance' => $seance,
            'movie' => $movie,
            'hall' => $hall,
            'seats' => json_decode($seats->seance_seats),
        ]);
    }

    public function payment(Request $request, int $id)
    {
        $seanceSeats = ($request['data-tables-seance-seats']);
        $selectedSeats = ($request['data-tables-selected-seats']);
        $totalPrice = +($request['data-tables-total-price']);

        //var_dump($seanceSeats, $selectedSeats, $totalPrice);
        //exit;

        $seance = Session::findOrFail($id);
        $movie = Movie::findOrFail($seance->movie_id);
        $hall = Hall::findOrFail($seance->hall_id);
        $seats = Seat::where('session_id', $seance->id)->first();
        $seats->seance_seats = $seanceSeats;
        $seats->selected_seats = $selectedSeats;
        $seats->save();

        $ticket = Ticket::query()->create([
            'session_id' => $seance->id,
            'title_movie' => $movie->title,
            'selected_seats' => $selectedSeats,
            'name_hall' => $hall->name,
            'total_price' => $totalPrice,
        ]);

        return view('client.payment', [
            'seance' => $seance,
            'ticket' => $ticket,
        ]);
    }

    public function ticket(int $id)
    {
        $ticket = Ticket::findOrFail($id);
        $seance = Session::findOrFail($ticket->session_id);

        return view('client.ticket', [
            'seance' => $seance,
            'ticket' => $ticket,
        ]);
    }
}
