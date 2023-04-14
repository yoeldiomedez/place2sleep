<?php

namespace App\Http\Controllers;

use App\Models\Niche;
use App\Models\Pavilion;
use Illuminate\Http\Request;

class NicheController extends Controller
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
                    Niche::with('pavilion')->where('pavilion_id', $request->pavilion_id)
                )
                ->addColumn('buttons', 'niches.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }
            // Get all niches and pavilions from current cemetery selected
            $pavilions = Pavilion::select('id')
                                       ->where('cemetery_id', auth()->user()->cemetery_id)
                                       ->get();

            return datatables()->eloquent(
                Niche::with('pavilion')->whereIn('pavilion_id', $pavilions)
            )
            ->addColumn('buttons', 'niches.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('niches.index');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $niche = new Niche;

        $niche->pavilion_id = $request->pavilion_id;
        $niche->category    = $request->category;
        $niche->state       = $request->state;
        $niche->row_x       = $request->row_x;
        $niche->col_y       = $request->col_y;
        $niche->price       = $request->price;

        $niche->save();

        return $niche;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Niche  $niche
     * @return \Illuminate\Http\Response
     */
    public function show(Niche $niche)
    {
      return $niche;
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Niche  $niche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niche $niche)
    {   
        $niche->pavilion_id = $request->pavilion_id;
        $niche->category    = $request->category;
        $niche->state       = $request->state;
        $niche->row_x       = $request->row_x;
        $niche->col_y       = $request->col_y;
        $niche->price       = $request->price;

        $niche->update();

        return $niche->load('pavilion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Niche  $niche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niche $niche)
    {
        $niche->delete();

        return $niche;
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

        $data = Niche::with('pavilion')->where( function ($query) use ($term) { 

            $query->where('row_x', 'LIKE', '%'.$term.'%')
                ->orwhere('col_y', 'LIKE', '%'.$term.'%')
                ->orwhere('category', 'LIKE', '%'.$term.'%');

            $query->orWhereHas('pavilion', function($q) use ($term) {
                
                $q->where( function($q) use ($term) {

                    $q->where('name', 'LIKE', '%' . $term . '%');

                });
            });

        })->whereIn('pavilion_id', $pavilions)
            ->where('state', 'D')
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        $data->appends(['term' => $term]);

        return $data;
    }
}
