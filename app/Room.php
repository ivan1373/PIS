<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $table = 'rooms';
    public $timestamps = true;

    protected $fillable = [
        'naziv',  'rtype_id'
    ];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class, 'rtype_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'room_id');
    }
}
