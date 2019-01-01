<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;

class PagesController extends Controller
{
    //
    public function dashboard()
    {
        $adminsCount = User::where('isadmin','1')->count();
        $recsCount = User::where('isadmin','0')->count();

        $reservedCount = Room::where('status','1')->count();
        $freeRoomCount = Room::where('status','0')->count();
        return view('dashboard',compact('adminsCount','recsCount','reservedCount','freeRoomCount'));
    }
}
