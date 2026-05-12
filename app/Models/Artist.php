class Artist extends Model {
    protected $fillable = ['name', 'country'];

    public function albums() { return $this->hasMany(Album::class); }
    
    // Relación avanzada: Acceder a canciones directamente desde el artista
    public function songs() { return $this->hasManyThrough(Song::class, Album::class); }
}