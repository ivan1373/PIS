<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    protected $table = 'room_types';
    public $timestamps = true;

    protected $fillable = [
        'br_kreveta', 'cijena'
    ];

    public function room()
    {
        return $this->hasMany('App\Room');
    }
}
