<?php

namespace App\Http\Controllers;

use App\Http\Requests\Distributor\CreateDistributorRequest;
use App\Http\Requests\Distributor\UpdateDistributorRequest;
use App\Models\Movie;
use App\Models\MovieDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $distributors = MovieDistributor::query()->paginate(10);

        return view('distributor.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDistributorRequest $request)
    {
        $body = $request->all();
        $distributor = MovieDistributor::create([
            'nom' => $body['nom'],
            'telephone' => $body['telephone'],
            'adresse' => $body['adresse'],
            'cpostal' => $body['cpostal'],
            'ville' => $body['ville'],
            'pays' => $body['pays'],
        ]);

        return redirect()->route('distributors.show', $distributor);
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieDistributor $distributor)
    {
        $distributor = MovieDistributor::query()->findOrFail($distributor->id_distributeur);
        $movies = Movie::query()->where('id_distributeur', $distributor->id_distributeur)->get();
        return view('distributor.show', compact('distributor', 'movies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $distributor = MovieDistributor::findOrFail($id);

        return view('distributor.edit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistributorRequest $request, string $id)
    {
        $body = $request->all();
        $distributor = MovieDistributor::findOrFail($id);
        $body = $request->all();
        $distributor->update([
            'nom' => $body['nom'],
            'telephone' => $body['telephone'],
            'adresse' => $body['adresse'],
            'cpostal' => $body['cpostal'],
            'ville' => $body['ville'],
            'pays' => $body['pays'],
        ]);

        return redirect()->route('distributors.show', $distributor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $distributor = MovieDistributor::findOrFail($id);
        $distributor->delete();
        return redirect()->route('distributors.index');
    }
}
