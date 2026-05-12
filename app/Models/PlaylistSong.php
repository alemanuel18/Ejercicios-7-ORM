namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PlaylistSong extends Model {
    protected $table = 'playlist_song';
    protected $fillable = ['playlist_id', 'song_id'];
}