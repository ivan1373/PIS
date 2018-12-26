<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Room::all();
        return view('sobe.index',compact('rooms'));
    }

    public function roomtypes()
    {
        $types = RoomType::all();
        $typesCount = RoomType::all()->count();
        return view('sobe.roomtype',compact('types','typesCount'));
    }

    public function store_roomtypes(Request $request)
    {
        $type = new RoomType;

        $request->validate([
            'br_kreveta' => 'required|numeric|lt:5|unique:room_types',
            'cijena' => 'required|numeric'
        ]);

        $type->br_kreveta = $request->get('br_kreveta');
        $type->cijena = $request->get('cijena');
        $type->save();

        $request->session()->flash('status', 'Vrsta sobe uspješno stvorena!');

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $types = RoomType::all();
        return view('sobe.create', compact('types'));
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
        $room = new Room;

        $request->validate([
           'naziv' => 'required|min:5|unique:rooms'
        ]);

        $room->naziv = $request->get('naziv');
        $room->rtype_id = $request->get('vrsta');

        //soba je inicijalno slobodna
        $room->status = 0;

        $room->save();
        $request->session()->flash('status', 'Soba je uspješno stvorena!');

        return redirect('admin/sobe');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
