<?php

namespace App\Http\Controllers;

use App\Models\Mausoleum;
use App\Models\Inhumation;
use Illuminate\Http\Request;

class InhumationMausoleumController extends Controller
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
            // Filter all mausoleums of a specific pavilion
            if ( $request->pavilion_id ) {
                return datatables()->eloquent(

                    Inhumation::with(['buriable.pavilion', 'deceased', 'relative'])
                      ->whereHasMorph('buriable', Mausoleum::class, function ($mausoleums) use ($request) {

                        $mausoleums->where( function ($mausoleum) use ($request) {

                            $mausoleum->WhereHas('pavilion', function ($pavilions) use ($request) {

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
                  ->whereHasMorph('buriable', Mausoleum::class, function ($mausoleums) {

                    $mausoleums->where( function ($mausoleum) {

                        $mausoleum->WhereHas('pavilion', function ($pavilions) {

                            $pavilions->where('cemetery_id', auth()->user()->cemetery_id);

                        });
                    });
                })         
            )
            ->addColumn('buttons', 'inhumations.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('inhumations.mausoleum.index');
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

        $mausoleum = Mausoleum::findOrFail($request->mausoleum_id);
        $mausoleum->availability = $mausoleum->availability - 1;
        $mausoleum->update();

        $inhumation->amount = ((($mausoleum->price / $mausoleum->size) + $request->additional) - $request->discount);

        $inhumation->buriable()->associate($mausoleum)->save();

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

        if ($inhumation->buriable_id != $request->mausoleum_id) {

            $old_mausoleum = Mausoleum::findOrFail($inhumation->buriable_id);
            $old_mausoleum->availability = $old_mausoleum->availability + 1;
            $old_mausoleum->update();
            
            $new_mausoleum = Mausoleum::findOrFail($request->mausoleum_id);
            $new_mausoleum->availability = $new_mausoleum->availability - 1;
            $new_mausoleum->update();

            $inhumation->amount = ((($new_mausoleum->price / $new_mausoleum->size) + $request->additional) - $request->discount);

            $inhumation->buriable()->associate($new_mausoleum)->update();
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
        $mausoleum = Mausoleum::findOrFail($inhumation->buriable_id);
        $mausoleum->availability = $mausoleum->availability + 1;
        $mausoleum->update();
        
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
        // Obtener solo los Mausoleos ocupados ("inhumados")
        $mausoleums = Mausoleum::select('id')->whereHas('buries')
                             ->whereHas('pavilion', function ($query) {
                                $query->where('cemetery_id', auth()->user()->cemetery_id); 
                            })->get();

        // Obtener datos de la Inhumación (Difunto, Mausoleo, Pavellón) para su filtración
        $term = $request->term;

        $data = Inhumation::with(['deceased', 'buriable', 'buriable.pavilion'])->where( function ($query) use ($term) {

                $query->whereHas('deceased', function ($deceaseds) use ($term)  {

                        $deceaseds->where( function ($deceased) use ($term) {

                            $deceased->where('names', 'LIKE', '%'.$term.'%')
                                    ->orWhere('surnames', 'LIKE', '%'.$term.'%')
                                    ->orWhere('document_numb', 'LIKE', '%'.$term.'%');
                        });

                })->orwhereHasMorph('buriable', Mausoleum::class, function ($mausoleums) use ($term)  {

                    $mausoleums->where( function ($mausoleum) use ($term) {

                        $mausoleum->where('name', 'LIKE', '%'.$term.'%')
                                ->orwhere('location', 'LIKE', '%'.$term.'%');

                        $mausoleum->orWhereHas('pavilion', function ($pavilions) use ($term) {
            
                            $pavilions->where( function ($pavilion) use ($term) {
            
                                $pavilion->where('name', 'LIKE', '%' . $term . '%');
            
                            });
                        });
                    });
                    
                });

            })->whereIn('buriable_id', $mausoleums)
                ->where('buriable_type', 'App\Models\Mausoleum')
                ->orderBy('id', 'desc')
                ->paginate(10);
        
        $data->appends(['term' => $term]);

        return $data;
    }
}
