<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $fillable = [
        'nama_genre',
        'bobot',
        'tipe',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
