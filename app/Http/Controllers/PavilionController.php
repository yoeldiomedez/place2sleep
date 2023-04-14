<?php

namespace App\Http\Controllers;

use App\Models\Pavilion;
use Illuminate\Http\Request;

class PavilionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( $request->ajax() ) {

            return datatables()->eloquent(
                Pavilion::where('cemetery_id', auth()->user()->cemetery_id)
            )
            ->addColumn('buttons', 'pavilions.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }
        
        return view('pavilions.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pavilion = new Pavilion;

        $pavilion->cemetery_id = auth()->user()->cemetery_id;
        $pavilion->type        = $request->type;
        $pavilion->name        = $request->name;

        $pavilion->save();

        return $pavilion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pavilion  $pavilion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pavilion $pavilion)
    {
        $pavilion->type = $request->type;
        $pavilion->name = $request->name;

        $pavilion->update();

        return $pavilion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pavilion  $pavilion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pavilion $pavilion)
    {
        $pavilion->delete();

        return $pavilion;
    }
    
    /**
    * Display a listing of the resource API.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function get(Request  $request)
    {
        $term = $request->term;

        $data = Pavilion::select('id', 'name', 'type', 'cemetery_id')
                        ->where('cemetery_id', auth()->user()->cemetery_id)
                        ->where('type', $request->type)
                        ->where(function ($query) use ($term) {
                            $query->where('name', 'LIKE', '%'.$term.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
