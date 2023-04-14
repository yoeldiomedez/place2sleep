<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niche extends Model
{
    use HasFactory;

    /**
     * Get the niche's full category.
     *
     * @return string
     */
    public function getCategoryAttribute($value)
    {
       switch ($value) {
           case 'A':
               return 'Adulto';
               break;
           case 'P':
               return 'Parvulo';
               break;
            case 'O':
               return 'Osario';
               break;
            case 'D':
                return 'Dorado';
                break;
           default:
               return 'Otro';
               break;
       }
    }

    /**
     * Get the niche's full state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        switch ($value) {
            case 'D':
                return 'Disponible';
                break;
             case 'O':
                return 'Ocupado';
                break;
            default:
                return 'Otro';
                break;
        }
    }
    
    public function pavilion()
    {
        return $this->belongsTo(Pavilion::class);
    }

    /**
     * Get the niche's bury info.
     */
    public function bury()
    {
        return $this->morphOne(Inhumation::class, 'buriable');
    }
}
