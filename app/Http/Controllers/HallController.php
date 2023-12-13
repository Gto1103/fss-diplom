<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallStoreRequest;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HallController extends Controller
{

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): string
    {
        return Hall::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(HallStoreRequest $request): RedirectResponse
    {
        Hall::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        return response()->json([Hall::findOfFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function update(HallStoreRequest $request, Hall $hall): bool
    {
        $hall->fill($request->validated());
        return $hall->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall): ?Response
    {
        if ($hall->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }


    public function create(HallStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $hall = Hall::query()->create([
            'name' => $validated['name']
        ]);

        for ($i = 0; $i < 20; $i++) {
            Seat::query()->create([
                'hall_id' => $hall->id,
                'type_seat' => 'standart',
            ]);
        }

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
        Seat::query()->where(['hall_id' => $id])->delete();
        Hall::destroy($id);

        return redirect('admin/index');
    }

    /*
    public function update(Request $request, Hall $hall)
    {
        $hall->fill($request->all());
        $hall->save();

        return response()->json($hall);
    }
    */

    public function updatePrice(Request $request): RedirectResponse
    {
        $updatingHall = Hall::findOrFail($request->id);
        $updatingHall->price = +$request['price'];
        $updatingHall->vip_price = +$request['vip_price'];
        $updatingHall->save();

        return redirect('admin/index');
    }
}
