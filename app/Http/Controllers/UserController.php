<?php

namespace App\Http\Controllers;

use App\Note;
use App\Reservation;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $users = DB::table('users')->orderBy('isadmin','desc')->get();
        return view('korisnici.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        $reservations = Reservation::where('user_id',$user->id)->get();
        $notes = Note::where('user_id',$user->id)->get();

        return view('korisnici.show',compact('reservations','user','notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $user = User::findOrFail($id);

        $this->authorize('update',$user);

        return view('korisnici.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $this->authorize('update',$user);

        $request->validate([
            'lozinka' => 'required',
            'lozinkaP' => 'same:lozinka'
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('lozinka'));
        $user->isadmin = $request->get('vrsta');
        $user->save();

        $request->session()->flash('update','Korisnički podaci uspješno izmijenjeni!');
        return redirect('admin/korisnici');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //$this->authorize('delete',$id);
        abort_if($id==Auth::id());
        $user = User::findOrFail($id);

        $user->delete();
        session()->flash('delete','Korisnik je izbrisan!');
        return back();
    }
}
