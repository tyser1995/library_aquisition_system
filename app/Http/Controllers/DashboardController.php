<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Document;
use App\Models\Media;
use App\Models\ContentType;
use App\Models\Contact;
use App\Models\Region;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Hotel;
use App\Models\HotelGroup;
use App\Models\Role;
use App\Models\ContentDetailTab;

use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totals = [
        'usercount' => User::count(),
        'documentcount' => 23,
        'mediacount' => 2,
        'contentcount' => 3,
        'contactcount' => 5,
        'regioncount' => 2,
        'countrycount' => 3,
        'nationalitycount' => 2,
        'hotelcount' => 10,
        'hotelgroupcount' => 1,
        'userlastupdate' => 1,
        'documentlastupdate' => 2,
        'medialastupdate' => 3,
        'contentlastupdate' => 3,
        'contactlastupdate' => 5,
        'regionlastupdate' => 5,
        'countrylastupdate' => 5,
        'nationalitylastupdate' => 1,
        'hotellastupdate' => 23,
        'hotelgrouplastupdate' => 54,
        ];


        if (view()->exists("pages.dashboard")) {
            return view("pages.dashboard", compact('totals'));
        }

        return abort(404);
    }
}
