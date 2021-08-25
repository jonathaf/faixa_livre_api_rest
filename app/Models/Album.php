<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'year',
        'artist',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
  
    }

    public function album_likes()
    {
        return $this->has_many('AlbumLike');
    }
}
