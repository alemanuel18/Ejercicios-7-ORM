<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class Profile extends Model {
    protected $fillable = ['user_id', 'avatar_url', 'bio'];

    public function user() { return $this->belongsTo(User::class); }
}