<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $table = 'reservations';
    public $timestamps = true;

    protected $fillable = [
        'gost', 'datum_od', 'datum_do', 'dorucak', 'zavrsena', 'naplacena', 'iznos','room_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class,'room_id');
    }
}
