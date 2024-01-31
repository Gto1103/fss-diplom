<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Session;
use App\Http\Requests\MovieStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MovieController extends Controller
{
    public function index(Request $request)
    {
    }

    public function addMovie(MovieStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Movie::create([
            'title' => Arr::get($validated, 'title'), //$validated['title']
            'description' => Arr::get($validated, 'description'), //$validated['description']
            'duration' => Arr::get($validated, 'duration'), //$validated['duration'],
            'country' => Arr::get($validated, 'country'), //$validated['country']
        ]);

        return redirect('admin/index');
    }

    public function deleteMovie(int $id): RedirectResponse
    {
       // $sessions = Session::all();
        //foreach ($sessions as $session) {
          //  if ($session->hall_id === $id) {
          //      Session::destroy($session->id);
          //  }
       // }
        Movie::destroy($id);

        return redirect('admin/index');
    }
}
