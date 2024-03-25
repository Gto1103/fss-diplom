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
        $seancesData = json_decode($request['data-tables-seances']);

        foreach ($seancesData as $seanceData) {
            array_push($idIn, $seanceData->{'id'});
        }
        foreach ($seances as $seance) {
            array_push($idDB, $seance->id);
        }

        foreach ($seancesData as $seanceData) {
            if (!in_array($seanceData->{'id'}, $idDB)) {
                Session::query()->create([
                    'start' => $seanceData->{'start'},
                    'hall_id' => +$seanceData->{'hall_id'},
                    'movie_id' => +$seanceData->{'movie_id'},
                ]);
            }
            //var_dump($seances->whereNotIn('id', $idIn));

            foreach ($seances as $seance) {
                if (!in_array($seance->id, $idIn)) {
                    Session::query()->where('id', '=', $seance->id)->delete();
                }
            }
        }
        return redirect('admin/index');
    }

    public function addSeats(Request $request, Session $seance)
    {
        $seance = Session::query()->findOrFail($id);
        $seance->selected_seats = $request->input('selected_seats');
        $seance->seance_seats = $request->input('seance_seats');
        $seance->save();
    }
}
