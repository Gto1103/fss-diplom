<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Seat;
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
        $seance = Session::with(['movie', 'hall'])->get()->findOrFail($id);

        return view('client.payment', ['seance' => $seance]);
    }

    public function ticket(Request $request, int $id)
    {
        $seance = Session::with(['movie', 'hall'])->get()->findOrFail($id);

        return view('client.ticket', ['seance' => $seance]);
    }
}
