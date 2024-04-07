<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Session;

class SeanceController extends Controller
{
    public function updateSeances(Request $request): RedirectResponse
    {
        $idIn = [];
        $idDB = [];
        $seances = Session::all();
        $seancesData = json_decode($request->input('data-tables-seances'));

        foreach ($seancesData as $seanceData) {
            $idIn[] = $seanceData->id;
        }
        foreach ($seances as $seance) {
            $idDB[] = $seance->id;
        }

        foreach ($seancesData as $seanceData) {
            if (!in_array($seanceData->id, $idDB)) {
                Session::query()->create([
                    'start' => $seanceData->start,
                    'hall_id' => +$seanceData->hall_id,
                    'movie_id' => +$seanceData->movie_id,
                ]);
            }
        }
        foreach ($seances as $seance) {
            if (!in_array($seance->id, $idIn)) {
                Session::query()->where('id', '=', $seance->id)->delete();
            }
        }

        return redirect('admin/index');
    }

    public function addSeats(Request $request, Session $seance)
    {
        $seance = Session::query()->findOrFail($seance->id);
        $seance->selected_seats = $request->input('selected_seats');
        $seance->seance_seats = $request->input('seance_seats');
        $seance->save();
    }
}
