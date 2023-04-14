<?php

namespace App\Http\Controllers;

use App\Models\Exhumation;
use Illuminate\Http\Request;

class ExhumationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exhumation = new Exhumation;

        $exhumation->inhumation_id = $request->inhumation_id;
        $exhumation->ric           = $request->ric;
        $exhumation->doc           = $request->doc;
        $exhumation->notes         = $request->notes;

        $exhumation->save();

        return $exhumation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exhumation  $exhumation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exhumation $exhumation)
    {
        $exhumation->ric           = $request->ric;
        $exhumation->doc           = $request->doc;
        $exhumation->notes         = $request->notes;

        $exhumation->update();

        return $exhumation->load(['inhumation.buriable.pavilion', 'inhumation.deceased']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exhumation  $exhumation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exhumation $exhumation)
    {
        $exhumation->delete();

        return $exhumation;
    }
}
