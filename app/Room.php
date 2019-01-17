<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $table = 'rooms';
    public $timestamps = true;

    protected $fillable = [
        'naziv', 'status',  'rtype_id'
    ];

    public function room_type()
    {
        return $this->belongsTo('App\RoomType', 'rtype_id');
    }

    public function reservations()
    {
        return $this->belongsTo(Reservation::class,'res_id');
    }
}
