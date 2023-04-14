<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inhumation extends Model
{
    use HasFactory;
    
    /**
     * Get the inhumation's full agreement.
     *
     * @return string
     */
    public function getAgreementAttribute($value)
    {
       switch ($value) {
           case 'C':
               return 'Compra';
               break;
           case 'R':
               return 'Renovacion';
               break;
            case 'I':
               return 'Traslado Interno';
               break;
            case 'E':
                return 'Traslado Externo';
                break;
           default:
               return 'Otro';
               break;
       }
    }

    /**
     * Get the owning buriable model.
     */
    public function buriable()
    {
        return $this->morphTo();
    }
    
    public function deceased()
    {
        return $this->belongsTo(Deceased::class);
    }

    public function relative()
    {
        return $this->belongsTo(Relative::class);
    }

    public function pavilion()
    {
        return $this->buriable->pavilion;
    }
    
    public function cemetery()
    {
        return $this->pavilion->cemetery;
    }
}
