<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile;
use App\Models\Playlist;
use App\Models\Subscription;
use App\Models\Listen;
class User extends Model {
    use HasFactory;
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password']; // Seguridad

    public function profile() { return $this->hasOne(Profile::class); }
    public function playlists() { return $this->hasMany(Playlist::class); }
    public function subscription() { return $this->hasOne(Subscription::class); }
    public function listens() { return $this->hasMany(Listen::class); }
}