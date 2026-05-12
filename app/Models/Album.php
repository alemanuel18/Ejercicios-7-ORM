namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Album extends Model {
    protected $fillable = ['title', 'release_year', 'artist_id'];
    protected $casts = ['release_year' => 'integer'];

    public function artist() { return $this->belongsTo(Artist::class); }
    public function songs() { return $this->hasMany(Song::class); }
}