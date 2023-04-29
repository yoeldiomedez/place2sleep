<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pavilion extends Model
{
    use HasFactory;

    /**
     * Get the pavilion's full type.
     *
     * @return string
     */
    public function getTypeAttribute($value)
    {
        return ($value == 'N') ? 'Nicho' : 'Mausoleo' ;
    }
    
    public function cemetery()
    {
        return $this->belongsTo(Cemetery::class);
    }
}
