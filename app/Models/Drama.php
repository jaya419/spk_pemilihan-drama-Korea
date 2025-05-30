<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drama extends Model
{
    use HasFactory;

    protected $table = 'dramas';

    protected $fillable = [
        'nama_drama',
        'deskripsi',
        'tahun',
        'poster',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
