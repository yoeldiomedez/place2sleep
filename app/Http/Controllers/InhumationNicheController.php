<?php

namespace App\Http\Controllers;

use App\Models\Niche;
use App\Models\Inhumation;
use Illuminate\Http\Request;

class InhumationNicheController extends Controller
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
            // Filter all niches of a specific pavilion
            if ( $request->pavilion_id ) {
                return datatables()->eloquent(

                    Inhumation::with(['buriable.pavilion', 'deceased', 'relative'])
                      ->whereHasMorph('buriable', Niche::class, function ($niches) use ($request) {

                            $niches->where( function ($niche) use ($request) {

                                $niche->WhereHas('pavilion', function ($pavilions) use ($request) {

                                    $pavilions->where('cemetery_id', auth()->user()->cemetery_id)
                                              ->where('pavilion_id', $request->pavilion_id);
                                });
                            });
                    })
                )
                ->addColumn('buttons', 'inhumations.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }
            // Default List
            return datatables()->eloquent(

                Inhumation::with(['buriable.pavilion', 'deceased', 'relative'])
                  ->whereHasMorph('buriable', Niche::class, function ($niches) {

                    $niches->where( function ($niche) {

                        $niche->WhereHas('pavilion', function ($pavilions) {

                            $pavilions->where('cemetery_id', auth()->user()->cemetery_id);

                        });
                    });
                })
            )
            ->addColumn('buttons', 'inhumations.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('inhumations.niche.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inhumation = new Inhumation;

        $inhumation->deceased_id = $request->deceased_id;
        $inhumation->relative_id = $request->relative_id;
        $inhumation->ric         = $request->ric;
        $inhumation->agreement   = $request->agreement;
        $inhumation->notes       = $request->notes;
        $inhumation->discount    = $request->discount;
        $inhumation->additional  = $request->additional;

        $niche = Niche::findOrFail($request->niche_id);
        $niche->state = 'O';
        $niche->update();

        $inhumation->amount = (($niche->price + $request->additional) - $request->discount);

        $inhumation->buriable()->associate($niche)->save();

        return $inhumation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inhumation  $inhumation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inhumation $inhumation)
    {
        $inhumation->deceased_id = $request->deceased_id;
        $inhumation->relative_id = $request->relative_id;
        $inhumation->ric         = $request->ric;
        $inhumation->agreement   = $request->agreement;
        $inhumation->notes       = $request->notes;
        $inhumation->discount    = $request->discount;
        $inhumation->additional  = $request->additional;

        if ($inhumation->buriable_id != $request->niche_id) {

            $old_niche = Niche::findOrFail($inhumation->buriable_id);
            $old_niche->state = 'D';
            $old_niche->update();
            
            $new_niche = Niche::findOrFail($request->niche_id);
            $new_niche->state = 'O';
            $new_niche->update();

            $inhumation->amount = (($new_niche->price + $request->additional) - $request->discount);

            $inhumation->buriable()->associate($new_niche)->update();
        }

        $inhumation->update();

        return $inhumation->load(['buriable.pavilion', 'deceased', 'relative']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inhumation  $inhumation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inhumation $inhumation)
    {
        $niche = Niche::findOrFail($inhumation->buriable_id);
        $niche->state = 'D';
        $niche->update();
        
        $inhumation->delete();

        return $inhumation;
    }

    /**
    * Display a listing of the resource API.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function get(Request $request)
    {
        // Obtener solo los Nichos ocupados ("inhumados")
        $niches = Niche::select('id')->whereHas('pavilion', function ($query) {
                        $query->where('cemetery_id', auth()->user()->cemetery_id);
                    })->where('state', 'O')
                      ->get();

        // Obtener datos de la Inhumación (Difunto, Nicho, Pavellón) para su filtración
        $term = $request->term;

        $data = Inhumation::with(['deceased', 'buriable', 'buriable.pavilion'])->where( function ($query) use ($term) {

                $query->whereHas('deceased', function ($deceaseds) use ($term)  {

                        $deceaseds->where( function ($deceased) use ($term) {

                            $deceased->where('names', 'LIKE', '%'.$term.'%')
                                    ->orWhere('surnames', 'LIKE', '%'.$term.'%')
                                    ->orWhere('document_numb', 'LIKE', '%'.$term.'%');
                        });

                })->orwhereHasMorph('buriable', Niche::class, function ($niches) use ($term)  {

                    $niches->where( function ($niche) use ($term) {

                        $niche->where('row_x', 'LIKE', '%'.$term.'%')
                            ->orwhere('col_y', 'LIKE', '%'.$term.'%');

                        $niche->orWhereHas('pavilion', function ($pavilions) use ($term) {
            
                            $pavilions->where( function ($pavilion) use ($term) {
            
                                $pavilion->where('name', 'LIKE', '%' . $term . '%');
            
                            });
                        });
                    });
                    
                });

            })->whereIn('buriable_id', $niches)
                ->where('buriable_type', 'App\Models\Niche')
                ->orderBy('id', 'desc')
                ->paginate(10);
        
        $data->appends(['term' => $term]);

        return $data;
    }
}
