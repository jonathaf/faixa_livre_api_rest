<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'duration',
        'artist',
    ];

    public function album()
    {
    	return $this->belongsTo(Album::class);
    }

    public function track_likes()
    {
        return $this->has_many('TrackLike');
    }
}
