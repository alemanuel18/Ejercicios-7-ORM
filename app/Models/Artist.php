<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Album;
use App\Models\Song;
class Artist extends Model {
    use HasFactory;
    protected $fillable = ['name', 'country'];

    public function albums() { return $this->hasMany(Album::class); }
    
    // Relación avanzada: Acceder a canciones directamente desde el artista
    public function songs() { return $this->hasManyThrough(Song::class, Album::class); }
}