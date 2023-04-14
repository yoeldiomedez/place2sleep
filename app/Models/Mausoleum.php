<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mausoleum extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    public function pavilion()
    {
        return $this->belongsTo(Pavilion::class);
    }
    
    /**
     * Get the niche's bury info.
     */
    public function buries()
    {
        return $this->morphMany(Inhumation::class, 'buriable');
    }
}
