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
            'seats' => '[]',
        ]);

        return redirect('admin/index');
    }

    public function deleteHall(int $id): RedirectResponse
    {
        Session::query()->where(['hall_id' => $id])->delete();
        Hall::destroy($id);

        return redirect('admin/index');
    }

    public function updatePrice(Request $request, Hall $hall): RedirectResponse
    {
        $hall->price = +$request->input('price');
        $hall->vip_price = +$request->input('vip_price');
        $hall->save();

        return redirect('admin/index');
    }

    public function updateSeats(Request $request): RedirectResponse
    {
        $seatsData = json_decode($request->input('data-tables-seats'));

        foreach ($seatsData as $value) {
            $updatingHall = Hall::findOrFail($value->id);
            $updatingHall->rows = +$value->rows;
            $updatingHall->cols = +$value->cols;
            $updatingHall->seats = $value->seats;
            $updatingHall->save();
        }

        return redirect('admin/index');
    }

    public function updateSales(Request $request, Hall $hall): RedirectResponse
    {
        $hall->is_open = +$request->input('data-tables-sales');
        $hall->save();

        return redirect('admin/index');
    }

}
