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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('rezervacije.index');
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

        $sobe = collect([]);
        $sobe->push($request->get('soba'));
        //$sobe = $request->get('soba');
        foreach($sobe as $soba)
        {
            $room = Room::findOrFail($soba);
            $room->status = '1';
            $room->res_id = $reservation->id;
            $room->save();
        }

        //$reservation->rooms()->sync($id_sobe);




        return back();
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
    }
}
