<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Res_Room extends Model
{
    //
    protected $table = 'res_rooms';
    protected $fillable = [
        'res_id', 'room_id'
    ];
}
