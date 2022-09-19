<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];
    
    
    public function temporada()
    {
        return $this->hasMany(Temporada::class, 'series_id');    
    }

    public static function booted()
    {
        self::addGlobalScope('ordered', function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome');

        });
    }
}

