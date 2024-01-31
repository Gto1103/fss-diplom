<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallStoreRequest;
use App\Models\Hall;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HallController extends Controller
{
    public function addHall(HallStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Hall::query()->create([
            'name' => $validated['name'],
            'seats' => '[]'
        ]);

        return redirect('admin/index');
    }

    public function deleteHall(int $id): RedirectResponse
    {
        $sessions = Session::all();
        foreach ($sessions as $session) {
            if ($session->hall_id === $id) {
                Session::destroy($session->id);
            }
        }
        Hall::destroy($id);

        return redirect('admin/index');
    }

    public function updatePrice(Request $request): RedirectResponse
    {
        $updatingHall = Hall::findOrFail($request->id);
        $updatingHall->price = +$request['price'];
        $updatingHall->vip_price = +$request['vip_price'];
        $updatingHall->save();

        return redirect('admin/index');
    }

    public function updateSeats(Request $request): RedirectResponse
    {
        $seatsData = json_decode($request['data-tables-seats']);

        foreach ($seatsData as $value) {
            $updatingHall = Hall::findOrFail($value->{'id'});
            $updatingHall->rows = +$value->{'rows'};
            $updatingHall->cols = +$value->{'cols'};
            $updatingHall->seats = $value->{'seats'};
            $updatingHall->save();
        }

        return redirect('admin/index');
    }
}
