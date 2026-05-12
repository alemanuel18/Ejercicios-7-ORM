<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Playlist;
class Song extends Model {
    use HasFactory;
    protected $fillable = ['title', 'duration_seconds', 'album_id', 'genre_id'];
    protected $casts = ['duration_seconds' => 'integer'];

    public function album() { return $this->belongsTo(Album::class); }
    public function genre() { return $this->belongsTo(Genre::class); }
    public function playlists() { return $this->belongsToMany(Playlist::class); }
}