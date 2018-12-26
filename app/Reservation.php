<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $table = 'reservations';
    public $timestamps = true;

    protected $fillable = [
        'gost', 'pocetak', 'kraj', 'dorucak', 'zavrsena', 'naplacena', 'iznos'
    ];
}
