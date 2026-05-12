class User extends Model {
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password']; // Seguridad

    public function profile() { return $this->hasOne(Profile::class); }
    public function playlists() { return $this->hasMany(Playlist::class); }
    public function subscription() { return $this->hasOne(Subscription::class); }
    public function listens() { return $this->hasMany(Listen::class); }
}