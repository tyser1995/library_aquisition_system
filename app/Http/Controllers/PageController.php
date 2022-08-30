<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Symfony\Component\Intl\Currencies;
use App\Helpers\GlobalHelper;

use DB;
use Route;

use App\Models\User;
use App\Models\RaffleEvent;
use App\Models\EventImage;
use App\Models\EventParticipant;


class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.dashboard")) {
            return view("pages.dashboard");
        }

        return abort(404);
    }

    public function view_raffle(Request $request) {
        $route = Route::current();
        $params = $route->parameters();

        $user = User::where('account_code','=',$params['account_code'])->get()->first();
        if(!$user){
            return abort(404);
        }
        //dd($user);
        //dd($params);
        $raffle_event = RaffleEvent::select( 'raffle_events.*', 'users.account_code', 'users.name', DB::raw('(SELECT COUNT(*) FROM event_participants where event_participants.raffle_event_id = raffle_events.id) as total_participants') )
            ->leftJoin('users','users.id','=','raffle_events.user_id')
            ->where('raffle_events.slug','=',$params['slug'])
            ->where('raffle_events.user_id','=',$user->id)->get()->first();
        if(!$raffle_event){
            // redirect to search page using the slug in original form
            return abort(404);
        }

        $raffle_images = EventImage::where('raffle_event_id','=', $raffle_event->id )->get();

        $symbol = Currencies::getSymbol(Auth::user()->currency_symbol); // => '₹'

        $raffle_participants = [];
        $rp = EventParticipant::where('raffle_event_id','=',$raffle_event->id)->get();
        foreach($rp as $val){
            $raffle_participants[$val->slot_number] = $val->toArray();
        }

        return view("pages.raffle_event.view_raffle" , [
            'creator_id' => $user->id,
            'raffle_event' => $raffle_event,
            'symbol' => $symbol,
            'raffle_images' => $raffle_images,
            'raffle_participants' => $raffle_participants
        ]);
    }

    public function load_raffle_participants(Request $request) {
        $route = Route::current();
        $params = $route->parameters();

        $raffle_id = Hashids::decode($params['id'])[0];

        $raffle_event = RaffleEvent::select( 'raffle_events.*', 'users.account_code', 'users.name' )
            ->leftJoin('users','users.id','=','raffle_events.user_id')
            ->where('raffle_events.id','=',$raffle_id)
            ->get()->first();
        if(!$raffle_event){
            // redirect to search page using the slug in original form
            return abort(404);
        }

        $raffle_participants = [];
        $rp = EventParticipant::where('raffle_event_id','=',$raffle_event->id)->get();
        foreach($rp as $val){
            $raffle_participants[$val->slot_number] = $val->toArray();
        }

        $is_even = false;
        $slot_col_a = 0;
        $slot_col_b = 0;
        if($raffle_event->slot %2 == 0){
            $is_even = true;
            $slot_col_a = $raffle_event->slot / 2;
            $slot_col_b = $raffle_event->slot / 2;
        }else{
            $slot_col_b = floor($raffle_event->slot / 2);
            $slot_col_c = ceil($raffle_event->slot / 2);
        }
        //dd($raffle_participants);
        return view("pages.raffle_event.raffle_participants",[
            'raffle_event' => $raffle_event,
            'raffle_participants' => $raffle_participants,
            'slot_col_a' => $slot_col_a,
            'slot_col_b' => $slot_col_b
        ]);
    }
}
