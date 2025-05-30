<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'scores';

    protected $fillable = [
        'drama_id',
        'genre_id',
        'skor',
    ];

    public function drama()
    {
        return $this->belongsTo(Drama::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
