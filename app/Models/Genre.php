namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Genre extends Model {
    protected $fillable = ['name'];

    public function songs() { return $this->hasMany(Song::class); }
}