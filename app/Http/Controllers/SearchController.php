<?php

namespace App\Http\Controllers;

use App\Models\Niche;
use App\Models\Mausoleum;
use App\Models\Inhumation;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('search.index');
    }

    public function niche(Request $request)
    {
        if ( $request->ajax() ) {

            return datatables()->eloquent(

                Inhumation::with(['buriable.pavilion.cemetery', 'deceased'])
                      ->whereHasMorph('buriable', Niche::class)

            )->toJson();
        }

        return view('search.niche');
    }

    public function mausoleum(Request $request)
    {
        if ( $request->ajax() ) {
            
            return datatables()->eloquent(

                Inhumation::with(['buriable.pavilion.cemetery', 'deceased'])
                      ->whereHasMorph('buriable', Mausoleum::class)

            )->toJson();
        }

        return view('search.mausoleum');
    }
}
