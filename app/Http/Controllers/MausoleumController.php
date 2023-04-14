<?php

namespace App\Http\Controllers;

use App\Models\Pavilion;
use App\Models\Mausoleum;
use Illuminate\Http\Request;

class MausoleumController extends Controller
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
                    Mausoleum::with('pavilion')->where('pavilion_id', $request->pavilion_id)
                )
                ->addColumn('buttons', 'mausoleums.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }
            // Get all mausoleums and pavilions from current cemetery selected
            $pavilions = Pavilion::select('id')
                                       ->where('cemetery_id', auth()->user()->cemetery_id)
                                       ->get();

            return datatables()->eloquent(
                Mausoleum::with('pavilion')->whereIn('pavilion_id', $pavilions)
            )
            ->addColumn('buttons', 'mausoleums.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('mausoleums.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mausoleum = new Mausoleum;

        $mausoleum->pavilion_id   = $request->pavilion_id;
        $mausoleum->name          = $request->name;
        $mausoleum->location      = $request->location;
        $mausoleum->doc           = $request->doc;
        $mausoleum->size          = $request->size;
        $mausoleum->availability  = $request->size;
        $mausoleum->extensions    = 0;
        $mausoleum->price         = $request->price;

        $mausoleum->save();

        return $mausoleum;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mausoleum  $mausoleum
     * @return \Illuminate\Http\Response
     */
    public function show(Mausoleum $mausoleum)
    {
      return $mausoleum;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mausoleum  $mausoleum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mausoleum $mausoleum)
    {
        $mausoleum->pavilion_id = $request->pavilion_id;
        $mausoleum->name        = $request->name;
        $mausoleum->location    = $request->location;
        $mausoleum->doc         = $request->doc;
        $mausoleum->price       = $request->price;

        if ($mausoleum->availability == 0) {

            $mausoleum->availability = $mausoleum->availability + $request->extensions;
            $mausoleum->extensions   = $mausoleum->extensions + $request->extensions;
        }

        $mausoleum->update();

        return $mausoleum->load('pavilion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mausoleum  $mausoleum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mausoleum $mausoleum)
    {
        $mausoleum->delete();

        return $mausoleum;
    }

    /**
    * Display a listing of the resource API.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function get(Request  $request)
    {
        $pavilions = Pavilion::select('id')
                                    ->where('cemetery_id', auth()->user()->cemetery_id)
                                    ->get();

        $term = $request->term;

        $data = Mausoleum::with('pavilion')->where( function ($query) use ($term) { 

                $query->where('name', 'LIKE', '%'.$term.'%')
                    ->orwhere('location', 'LIKE', '%'.$term.'%');

                $query->orWhereHas('pavilion', function($q) use ($term) {
                    
                    $q->where( function($q) use ($term) {

                        $q->where('name', 'LIKE', '%' . $term . '%');

                    });
                });

            })->whereIn('pavilion_id', $pavilions)
                ->where('availability', '>', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
