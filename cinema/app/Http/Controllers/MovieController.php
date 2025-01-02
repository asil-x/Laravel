<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\CreateMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Models\Movie;
use App\Models\MovieDistributor;
use App\Models\MovieType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::query()
            ->select(['id_film', 'id_genre', 'id_distributeur', 'annee_production', 'titre', 'resum'])
            ->when($request->has('types'), function (Builder $query) use ($request) {
                $query->whereIn('id_genre', $request->get('types'));
            })
            ->orderByDesc('annee_production')
            ->with(['type', 'distributor'])
            ->paginate();

        $apiKey = env('OMDB_API_KEY');
        foreach ($movies as $movie) {
            $omdbMovie = Cache::rememberForever("movie_{$movie->id_film}", function () use ($apiKey, $movie) {
                return Http::get("http://www.omdbapi.com/?apikey={$apiKey}&s={$movie->titre}")->json('Search');
            });
            if ($omdbMovie && $omdbMovie[0] && array_key_exists('Poster', $omdbMovie[0]) && $omdbMovie[0]['Poster'] !== 'N/A') {
                $movie->poster = $omdbMovie[0]['Poster'];
            } else {
                $movie->poster = null;
            }
        }

        $types = MovieType::query()->get();

        // compact('movies', 'types') is equivalent to ['movies' => $movies, 'types' => $types]
        return view('movie.index', compact('movies', 'types'));
    }

    public function show(Movie $movie)
    {
        $apiKey = env('OMDB_API_KEY');
        $omdbMovie = Cache::rememberForever("movie_{$movie->id_film}", function () use ($apiKey, $movie) {
            return Http::get("http://www.omdbapi.com/?apikey={$apiKey}&s={$movie->titre}")->json('Search');
        });

        if ($omdbMovie && $omdbMovie[0] && array_key_exists('Poster', $omdbMovie[0]) && $omdbMovie[0]['Poster'] !== 'N/A') {
            $movie->poster = $omdbMovie[0]['Poster'];
        } else {
            $movie->poster = null;
        }

        $recommandations = Movie::query()
            ->whereRelation('type', 'id_genre', $movie->id_genre)
            ->whereKeyNot($movie->id_film)
            ->limit(5)
            ->get();

        foreach ($recommandations as $recommandation) {
            /** @var Movie $recommandation */
            $omdbMovie = Cache::rememberForever("movie_{$recommandation->id_film}", function () use ($apiKey, $recommandation) {
                return Http::get("http://www.omdbapi.com/?apikey={$apiKey}&s={$recommandation->titre}")->json('Search');
            });
            if ($omdbMovie && $omdbMovie[0] && array_key_exists('Poster', $omdbMovie[0]) && $omdbMovie[0]['Poster'] !== 'N/A') {
                $recommandation->poster = $omdbMovie[0]['Poster'];
            } else {
                $recommandation->poster = null;
            }
        }

        return view('movie.show', compact('movie', 'recommandations'));
    }

    public function create()
    {
        $types = MovieType::query()->get();
        $distributors = MovieDistributor::query()->get();

        return view('movie.create', compact('types', 'distributors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMovieRequest $request)
    {
        $body = $request->all();
        $movie = Movie::create([
            'titre' => $body['titre'],
            'resum' => $body['resum'],
            'date_debut_affiche' => $body['date_debut_affiche'],
            'date_fin_affiche' => $body['date_fin_affiche'],
            'duree_minutes' => $body['duree_minutes'],
            'annee_production' => $body['annee_production'],
            'id_genre' => $body['genre'],
            'id_distributeur' => $body['distributeur'],
        ]);

        return redirect()->route('movies.show', $movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $types = MovieType::query()->get();
        $distributors = MovieDistributor::query()->get();
        $movie = Movie::query()->findOrFail($id);

        return view('movie.edit', compact('types', 'distributors', 'movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, string $id)
    {
        $body = $request->all();
        $movie = Movie::query()->findOrFail($id);
        $movie->update([
            'titre' => $body['titre'],
            'resum' => $body['resum'],
            'date_debut_affiche' => $body['date_debut_affiche'],
            'date_fin_affiche' => $body['date_fin_affiche'],
            'duree_minutes' => $body['duree_minutes'],
            'annee_production' => $body['annee_production'],
            'id_genre' => $body['genre'],
            'id_distributeur' => $body['distributeur'],
        ]);

        return redirect()->route('movies.show', $movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::query()->findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
