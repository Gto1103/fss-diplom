<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Movie;
use App\Models\Session;

class SeanceController extends Controller
{
	public function updateSeances(Request $request): RedirectResponse
	{
        $seanceData = json_decode($request['data-tables-seances']);
        //var_dump($seanceData);
        Session::query()->delete();
        foreach ($seanceData as $seance)
		{
            var_dump($seance->{'start'});
            var_dump($seance->{'hall_id'});
            var_dump($seance->{'movie_id'});

            $updatingSeance = Session::create([
                'start' => $seance->{'start'},
                //'hall_id' => +$seance->{'hall_id'},
                //'movie_id' => +$seance->{'movie_id'},
            ]);

            //$updatingSeance->save();
          //  Session::query()->create($seance);
		}
		//$seances = Session::with('movie')->get();

        return redirect('admin/index');
        exit;

		//все сеансы стираются и пересоздаются заново. При этом теряется инфо о купленных местах

		$seances = Session::all();
		Session::query()->delete();
		$seancesIn = $request->json();
		foreach ($seancesIn as $seanceIn) {
			foreach ($seances as $seance) {
				if ($seanceIn['id'] === $seance->id) {
					Session::query()->create($seanceIn);

					$s++;
				}
			}
			if ($s == 0) Session::query()->create($seanceIn);
			$s = 0;
		}
		$seancesOut = Session::all();
		//return response()->json($seancesOut);

	}

	public function addSeats(Request $request, Session $seance)
	{
		//$seance = Session::query()->findOrFail($id);
		$seance->selected_seats = $request->input('selected_seats');
		$seance->seance_seats = $request->input('seance_seats');
		$seance->save();
	}
}
