<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatRequest;
use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SeatController extends Controller
{

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): string
    {
        return Seat::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeatRequest $request): Seat
    {
        return Seat::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Seat $seat
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        return response()->json([Seat::findOfFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Seat $seat
     * @return \Illuminate\Http\Response
     */
    public function update(SeatRequest $request, Seat $seat): bool
    {
        $seat->fill($request->validated());
        return $seat->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Seat $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat): ?Response
    {
        if ($seat->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }

    public function create(SeatRequest $request): RedirectResponse
    {
        $hall = Hall::all();
        $numbers = $hall->rows * $hall->cols;

        if ($numbers !== 0) {
            for ($i = 1; $i < $numbers + 1; $i++) {
                Seat::query()->create([
                    'hall_id' => $hall->id,
                    'number' => $i,
                    'type_seat' => 'standart',
                ]);
            }
        }

        return redirect()->back();
    }

    public function updateSeats(Request $request, int $id)
    {
        Seat::query()->where(['hall_id' => $id])->delete();
        $newSeats = $request->json();
        foreach ($newSeats as $newSeat) {
            Seat::query()->create($newSeat);
        }
        $seats = Seat::all();
        return response()->json($seats);
    }
}
