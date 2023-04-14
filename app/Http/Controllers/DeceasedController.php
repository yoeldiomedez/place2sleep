<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\Inhumation;
use Illuminate\Http\Request;

class DeceasedController extends Controller
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
                Deceased::query()
           )
           ->addColumn('buttons', 'deceaseds.buttons.option')
           ->rawColumns(['buttons'])
           ->toJson();
        }
        
        return view('deceaseds.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deceased = new Deceased;

        $deceased->names          = $request->names; 
        $deceased->surnames       = $request->surnames;
        $deceased->gender         = $request->gender;
        $deceased->marital_status = $request->marital_status;
        $deceased->document_type  = $request->document_type;
        $deceased->document_numb  = $request->document_numb;
        $deceased->birth_date     = $request->birth_date;
        $deceased->death_date     = $request->death_date;
        $deceased->country_origin = $request->country_origin;

        $deceased->save();

        return $deceased;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deceased  $deceased
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deceased $deceased)
    {
        $deceased->names          = $request->names; 
        $deceased->surnames       = $request->surnames;
        $deceased->gender         = $request->gender;
        $deceased->marital_status = $request->marital_status;
        $deceased->document_type  = $request->document_type;
        $deceased->document_numb  = $request->document_numb;
        $deceased->birth_date     = $request->birth_date;
        $deceased->death_date     = $request->death_date;
        $deceased->country_origin = $request->country_origin;

        $deceased->update();

        return $deceased;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deceased  $deceased
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deceased $deceased)
    {
        $deceased->delete();

        return $deceased;
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

        $inhumations = Inhumation::select('deceased_id')->get();

        $data = Deceased::select('id', 'names', 'surnames', 'document_numb')
                    ->whereNotIn('id', $inhumations)
                    ->where(function ($query) use ($term) {
                        $query->where('names', 'LIKE', '%'.$term.'%')
                            ->orWhere('surnames', 'LIKE', '%'.$term.'%')
                            ->orWhere('document_numb', 'LIKE', '%'.$term.'%');
                    })
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
