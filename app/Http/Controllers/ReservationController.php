<?php

namespace App\Http\Controllers;

use App\Res_Room;
use App\Reservation;
use Carbon\Carbon;
use App\Room;
use Auth;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;
use DB;

class ReservationController extends Controller
{

    public function __construct()
    {
        Carbon::setLocale('hr');
        date_default_timezone_set('Europe/Sarajevo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reservations = Reservation::all();



        $reservations->map(function($item){
            $item->datum_od=Carbon::parse($item->datum_od)->format('d-m-Y');
            $item->datum_do=Carbon::parse($item->datum_do)->format('d-m-Y');
        });


        return view('rezervacije.index',compact('reservations'));
    }

    public function precheck()
    {
        return view('rezervacije.check');
    }


    public function check(Request $request)
    {
        $request->validate([
            'datum1' => 'required',
            'datum2' => 'required|after:datum1'
        ]);

        $start = $request->get('datum1');
        $end = $request->get('datum2');

        $rooms = DB::select("
        SELECT *
        FROM rooms
        WHERE id NOT IN
        (SELECT room_id 
        FROM reservations
        WHERE
        (datum_od <= '$start' AND datum_do >= '$start') OR
        (datum_od <= '$end' AND datum_do >= '$end') OR
        (datum_od >= '$start' AND datum_do <= '$end'))
        ");

       

       if(!empty($rooms))
        {
            return view('rezervacije.create',compact('rooms','start','end'));
        }
        else
        {
            $request->session()->flash('date', 'Ne postoji niti jedna soba dostupa u tome datumu!');
            return back();
        }    
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($rooms)
    {   
        //$rooms = Room::where('status','0')->get();
        /*$rooms = DB::raw("
        SELECT *
        FROM rooms
        WHERE room.id NOT IN  (
                                SELECT room_id
                                FROM reservations
                                WHERE reservations.begintime <= '{$datum1}'
                                AND reservations.endtime >= '{$datum2}'
                                )
        ");*/

       

        //return view('rezervacije.create',compact('rooms'));
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $reservation = new Reservation();

        $request->validate([
            'gost' => 'required',
            'datum1' => 'required',
            'datum2' => 'required|after:datum1',
            'dorucak' => 'required'
        ]);

        $reservation->gost = $request->get('gost');
        $reservation->datum_od = $request->get('datum1');
        $reservation->datum_do = $request->get('datum2');
        $reservation->dorucak = $request->get('dorucak');
        $reservation->user_id = Auth::id();

        $reservation->room_id = $request->get('soba');
       
        $reservation->save();

        
        $request->session()->flash('create', 'Rezervacija je uspješno stvorena!');

        return redirect('admin/rezervacije');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
        return view('rezervacije.edit',compact('reservation'));

    }

    public function invoice(Reservation $reservation)
    {
        $rooms = Room::where('res_id',$reservation->id)->get();

        $startDate = Carbon::parse($reservation->datum_od)->format('d-m-Y');
        $endDate = Carbon::parse($reservation->datum_do)->format('d-m-Y');

        $diff = Carbon::parse($reservation->datum_od)->diffInDays(Carbon::parse($reservation->datum_do));

        $today = Carbon::now()->format('d-m-Y');

        $amount = 0.0;
        foreach ($rooms as $room)
        {
            $amount += $room->room_type->cijena * $diff;
        }

        $total = $amount + $amount*0.17;

        return view('rezervacije.invoice',compact('reservation','startDate','endDate','amount','total','today','diff'));
    }

    public function checkOut(Reservation $reservation)
    {
        $room = Room::where('id',$reservation->room_id)->get();
        $amount = 0.0;

        $diff = Carbon::parse($reservation->datum_od)->diffInDays(Carbon::parse($reservation->datum_do));

        $amount = $room->room_type->cijena * $diff;


        $total = $amount + $amount*0.17;
        $reservation->naplacena = '1';
        $reservation->iznos = $total;

        $reservation->save();

        session()->flash('invoice','Rezervacija uspješno naplaćena!');
        return redirect('admin/rezervacije');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
        $request->validate([
            'gost' => 'required',
            'datum1' => 'required',
            'datum2' => 'required|after:datum1',
            'dorucak' => 'required'
        ]);

        $res = Reservation::findOrFail($reservation->id);

        $res->gost = $request->get('gost');
        $res->datum_od = $request->get('datum1');
        $res->datum_do = $request->get('datum2');
        $res->dorucak = $request->get('dorucak');

        $res->save();

        $request->session()->flash('update', 'Rezervacija je uspješno izmjenjena!');

        return redirect('admin/rezervacije');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
        $this->authorize('delete',$reservation);

        $reservation->room_id = null;

        $reservation->delete();
        session()->flash('delete','Rezervacija je uklonjena!');
        return back();
    }
}
