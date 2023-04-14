<?php

namespace App\Http\Controllers;

use App\Models\Niche;
use App\Models\Pavilion;
use App\Models\Mausoleum;
use App\Models\Inhumation;
use App\Models\Exhumation;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pavilions = Pavilion::where('cemetery_id', auth()->user()->cemetery_id)->count();

        $niches = Inhumation::whereHasMorph('buriable', Niche::class, function ($niches) {
                $niches->where( function ($niche) {
                    $niche->WhereHas('pavilion', function ($pavilions) {
                        $pavilions->where('cemetery_id', auth()->user()->cemetery_id);
                    });
                });
            })->count();

        $mausoleums = Inhumation::whereHasMorph('buriable', Mausoleum::class, function ($mausoleums) {
                $mausoleums->where( function ($mausoleum) {
                    $mausoleum->WhereHas('pavilion', function ($pavilions) {
                        $pavilions->where('cemetery_id', auth()->user()->cemetery_id);
                    });
                });
            })->count();

        $exhumations = Exhumation::whereHas('inhumation', function ($inhumations) {
            $inhumations->whereHasMorph('buriable', '*', function ($query) {
                $query->where( function ($q) {
                    $q->WhereHas('pavilion', function ($pavilions) {
                        $pavilions->where('cemetery_id', auth()->user()->cemetery_id);
                    });
                });
            });
        })->count();

        return view('home', compact('pavilions', 'niches', 'mausoleums', 'exhumations'));
    }

    /**
     * Show cemetery choices.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function choice() 
    {
        return view('choice');
    }
    /**
     * Sets an specified cemetery on session vars.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select($id)
    {   
        $cemetery = auth()->user()->cemeteries()->where('cemetery_id', $id)->firstOrFail();

        session([
            'cemetery_id'          => $cemetery->id,
            'cemetery_appellation' => $cemetery->appellation
        ]);

        return redirect()->intended('home');
    }
}
