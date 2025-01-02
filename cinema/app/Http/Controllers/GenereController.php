<?php

namespace App\Http\Controllers;

use App\Http\Requests\Type\CreateTypeRequest;
use App\Http\Requests\Type\UpdateTypeRequest;
use App\Models\Movie;
use App\Models\MovieType;

class GenereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generes = MovieType::query()->paginate(10);

        return view('genere.index', compact('generes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genere.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTypeRequest $request)
    {
        $body = $request->all();

        $genere = MovieType::create([
            'nom' => $body['nom'],
        ]);

        return redirect()->route('genere.show', $genere);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genere = MovieType::query()->findOrFail($id);
        $movies = Movie::query()->where('id_genre', $genere->id_genere)->get();

        return view('genere.show', compact('genere', 'movies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genere = MovieType::query()->findOrFail($id);

        return view('genere.edit', compact('genere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, string $id)
    {
        $body = $request->all();

        $genere = MovieType::query()->findOrFail($id);
        $genere->update([
            'nom' => $body['nom'],
        ]);

        return redirect()->route('genere.index', $genere);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genere = MovieType::query()->findOrFail($id);
        $genere->delete();

        return redirect()->route('genere.index');
    }
}
