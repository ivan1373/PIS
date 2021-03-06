<?php

namespace App\Http\Controllers;

use App\Note;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Room;
use DB;

class PagesController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('hr');
        date_default_timezone_set('Europe/Sarajevo');
    }
    //
    public function dashboard()
    {
        //za grafove
        $adminsCount = User::where('isadmin','1')->count();
        $recsCount = User::where('isadmin','0')->count();
        //$reservedCount = DB::select('SELECT count(DISTINCT room_id) FROM reservations');
        $reservedCount = DB::table('reservations')->count(DB::raw('DISTINCT room_id'));
        $freeRoomCount = Room::all()->count() - $reservedCount;

        //za blokove
        $users = User::all()->count();
        $rooms = Room::all()->count();
        $notes = Note::all()->count();
        $reservations = Reservation::where('zavrsena','0')->count();


        //godina
        $arrayOfResCount = array();
        $year = Carbon::now()->year;
        for ($i = 0;$i < 10;$i++)
        {
            $count = Reservation::whereYear('created_at',$year + $i)->count();
            array_push($arrayOfResCount,$count);
        }

        return view('dashboard',compact('adminsCount','recsCount','reservedCount','freeRoomCount','users','rooms','notes','reservations','arrayOfResCount'));
    }

    public function report()
    {

        $today = Carbon::now()->format('d-m-Y');
        $notesCount = Note::whereDate('created_at',Carbon::now())->count();
        $usersCount = User::whereDate('created_at',Carbon::now())->count();
        $reservationsCount = Reservation::whereDate('created_at',Carbon::now())->count();

        $freeRoomsCount = Room::all()->count() - (DB::table('reservations')->count(DB::raw('DISTINCT room_id')));
        $roomsCount = Room::all()->count();

        return view('izvjestaj.index',compact('today','notesCount','usersCount','reservationsCount','freeRoomsCount','roomsCount'));
    }

}
