class Playlist extends Model {
    protected $fillable = ['name', 'is_public', 'user_id'];
    protected $casts = ['is_public' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
    public function songs() { return $this->belongsToMany(Song::class); }
}