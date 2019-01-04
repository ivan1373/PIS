<?php

namespace App\Http\Controllers;

use App\Reservation;
use Carbon\Carbon;
use App\Room;
use Auth;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

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



        $reservations->map(function($item,$key){
            $item->datum_od=Carbon::parse($item->datum_od)->format('d-m-Y');
            $item->datum_do=Carbon::parse($item->datum_do)->format('d-m-Y');
        });

        /*
        foreach($reservations as $reservation)
        {
            $reservation->datum_od=Carbon::parse($reservation->datum_od)->format('d-m-Y');
            $reservation->datum_do=Carbon::parse($reservation->datum_do)->format('d-m-Y');
        }*/


        return view('rezervacije.index',compact('reservations'));
    }

    /*public function searchRooms()
    {
        $rooms = Room::where('status','0')->get();
        return view('rezervacije.roomList',$rooms);
    }
    */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$rooms = Room::where('status','0')->get();

        $rooms = Room::where('status','0')
            ->select('rooms.*')
            ->join('room_types', 'room_types.id', '=', 'rooms.rtype_id')
            ->orderBy('room_types.br_kreveta')
            ->get();

        return view('rezervacije.create',compact('rooms'));
    }

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
        $reservation->save();

        $sobe = $request->soba;
        //$sobe->push($request->get('soba'));
        //$sobe = $request->get('soba');
        foreach($sobe as $soba)
        {
            $room = Room::findOrFail($soba);
            $room->status = '1';
            $room->res_id = $reservation->id;
            $room->save();
        }

        //$reservation->rooms()->sync($id_sobe);


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
        $rooms = Room::where('res_id',$reservation->id)->get();
        $amount = 0.0;

        //$startDate = Carbon::parse($reservation->datum_od)->format('d-m-Y');
        //$endDate = Carbon::parse($reservation->datum_do)->format('d-m-Y');

        $diff = Carbon::parse($reservation->datum_od)->diffInDays(Carbon::parse($reservation->datum_do));

        foreach ($rooms as $room)
        {
            $amount += $room->room_type->cijena * $diff;
            $room->status = 0;
            $room->res_id = null;
            $room->save();
        }

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
        $rooms = Room::where('res_id',$reservation->id)->get();

        foreach ($rooms as $room)
        {
            $room->status = 0;
            $room->res_id = null;
            $room->save();
        }

        $reservation->delete();
        session()->flash('delete','Rezervacija je uklonjena!');
        return back();
    }
}
