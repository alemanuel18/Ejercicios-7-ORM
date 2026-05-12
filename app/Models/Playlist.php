<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Song;
class Playlist extends Model {
    use HasFactory;
    protected $fillable = ['name', 'is_public', 'user_id'];
    protected $casts = ['is_public' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
    public function songs() { return $this->belongsToMany(Song::class); }
}