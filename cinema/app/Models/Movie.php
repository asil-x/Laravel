<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property ?string $poster
 */
class Movie extends Model
{
    protected $table = 'films';

    protected $primaryKey = 'id_film';

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(MovieDistributor::class, 'id_distributeur');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(MovieType::class, 'id_genre');
    }

    protected $fillable = [
        'id_film',
        'id_genre',
        'id_distributeur',
        'titre',
        'resum',
        'date_debut_affiche',
        'date_fin_affiche',
        'duree_minutes',
        'annee_production',
    ];

    public $timestamps = false;

}
