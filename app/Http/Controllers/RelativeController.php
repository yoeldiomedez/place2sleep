<?php

namespace App\Http\Controllers;

use App\Models\Relative;
use Illuminate\Http\Request;

class RelativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            return datatables()->eloquent(
                Relative::query()
           )
           ->addColumn('buttons', 'relatives.buttons.option')
           ->rawColumns(['buttons'])
           ->toJson();
        }
        
        return view('relatives.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $relative = new Relative;

        $relative->names          = $request->names; 
        $relative->surnames       = $request->surnames;
        $relative->document_type  = $request->document_type;
        $relative->document_numb  = $request->document_numb;
        $relative->cellphone_numb = $request->cellphone_numb;
        $relative->address        = $request->address;

        $relative->save();

        return $relative;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relative $relative)
    {
        $relative->names          = $request->names; 
        $relative->surnames       = $request->surnames;
        $relative->document_type  = $request->document_type;
        $relative->document_numb  = $request->document_numb;
        $relative->cellphone_numb = $request->cellphone_numb;
        $relative->address        = $request->address;

        $relative->update();

        return $relative;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relative $relative)
    {
        $relative->delete();

        return $relative;
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

        $data = Relative::select('id', 'names', 'surnames', 'document_numb')
                        ->where('names', 'LIKE', '%'.$term.'%')
                        ->orWhere('surnames', 'LIKE', '%'.$term.'%')
                        ->orWhere('document_numb', 'LIKE', '%'.$term.'%')
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
