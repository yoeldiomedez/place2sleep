<?php

namespace App\Http\Controllers;

use App\Models\Niche;
use App\Models\Exhumation;
use Illuminate\Http\Request;
use App\Http\Controllers\ExhumationController;

class ExhumationNicheController extends ExhumationController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( $request->ajax() ) {

                if ( $request->pavilion_id ) {

                    return datatables()->eloquent(

                        Exhumation::with(['inhumation.buriable.pavilion', 'inhumation.deceased'])
        
                            ->whereHas('inhumation', function ($inhumations) use ($request) {
        
                                $inhumations->whereHasMorph('buriable', Niche::class, function ($niches) use ($request) {
        
                                    $niches->where( function ($niche) use ($request) {
        
                                        $niche->WhereHas('pavilion', function ($pavilions) use ($request) {
        
                                            $pavilions->where('cemetery_id', auth()->user()->cemetery_id)
                                                      ->where('pavilion_id', $request->pavilion_id);
        
                                        });
                                    });
                                });
                            })
                    )
                    ->addColumn('buttons', 'exhumations.buttons.option')
                    ->rawColumns(['buttons'])
                    ->toJson();
                }

                return datatables()->eloquent(

                    Exhumation::with(['inhumation.buriable.pavilion', 'inhumation.deceased'])
    
                        ->whereHas('inhumation', function ($inhumations) use ($request) {
    
                            $inhumations->whereHasMorph('buriable', Niche::class, function ($niches) use ($request) {
    
                                $niches->where( function ($niche) use ($request) {
    
                                    $niche->WhereHas('pavilion', function ($pavilions) use ($request) {
    
                                        $pavilions->where('cemetery_id', auth()->user()->cemetery_id);
    
                                    });
                                });
                            });
                        })
                )
                ->addColumn('buttons', 'exhumations.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
        }
        
        return view('exhumations.niche.index');
    }
}
