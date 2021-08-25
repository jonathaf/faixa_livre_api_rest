<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'track_id',
    ];

    public function users()
    {
        return $this->belongs_to('User');
    }

    public function tracks()
    {
        return $this->belongs_to('Track');
    }
}
