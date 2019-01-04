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
        $rooms = Room::select('rooms.*')
            ->join('room_types', 'room_types.id', '=', 'rooms.rtype_id')
            ->orderBy('room_types.br_kreveta')
            ->get();
        return view('sobe.index',compact('rooms'));
    }

    public function roomtypes()
    {
        $types = RoomType::all();
        return view('sobe.roomtype',compact('types'));
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

    public function edit_roomtypes($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('sobe.roomtypeEdit',compact('roomType'));
    }

    public function update_roomtypes(Request $request, $id)
    {

        $request->validate([
            'br_kreveta' => 'required|numeric|lt:5',
            'cijena' => 'required|numeric'
        ]);

        $roomType = RoomType::findOrFail($id);

        $roomType->br_kreveta = $request->get('br_kreveta');
        $roomType->cijena = $request->get('cijena');
        $roomType->save();

        $request->session()->flash('status1', 'Vrsta sobe uspješno izmijenjena!');

        return redirect('admin/sobe/vrste');

    }

    public function destroy_roomtypes($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
        session()->flash('delete', 'Vrsta sobe uspješno izbrisana');
        return redirect('admin/sobe/vrste');
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
        //$room->status = 0;

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
        $this->authorize('update',$room);
        $types = RoomType::all();
        return view('sobe.edit',compact('room','types'));
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
        $this->authorize('update',$room);
        if($room->naziv === $request->get('naziv'))
        {
            $request->validate([
                'naziv' => 'required'
            ]);

            $room->naziv = $request->get('naziv');
            $room->rtype_id = $request->get('vrsta');
            $room->save();
            $request->session()->flash('update', 'Soba je uspješno izmjenjena!');

            return redirect('admin/sobe');
        }
        else{
            $request->validate([
                'naziv' => 'required|unique:rooms'
            ]);

            $room->naziv = $request->get('naziv');
            $room->rtype_id = $request->get('vrsta');
            $room->save();
            $request->session()->flash('update', 'Soba je uspješno izmjenjena!');

            return redirect('admin/sobe');
        }
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
        $this->authorize('delete', $room);
        $room->delete();
        session()->flash('delete', 'Soba je uspješno izbrisana!');
        return back();

    }
}
