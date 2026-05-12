class Listen extends Model {
    protected $fillable = ['user_id', 'song_id', 'listened_at'];
    protected $casts = ['listened_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class); }
    public function song() { return $this->belongsTo(Song::class); }
}