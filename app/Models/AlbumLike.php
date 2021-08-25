<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'album_id',
    ];
    
    public function users()
    {
        return $this->belongs_to('User');
    }

    public function albums()
    {
        return $this->belongs_to('Album');
    }

}
