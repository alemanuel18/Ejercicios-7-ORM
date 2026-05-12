class Song extends Model {
    protected $fillable = ['title', 'duration_seconds', 'album_id', 'genre_id'];
    protected $casts = ['duration_seconds' => 'integer'];

    public function album() { return $this->belongsTo(Album::class); }
    public function genre() { return $this->belongsTo(Genre::class); }
    public function playlists() { return $this->belongsToMany(Playlist::class); }
}