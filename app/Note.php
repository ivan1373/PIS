<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Note extends Model
{
    //
    protected $table = 'notes';
    public $timestamps = true;

    protected $fillable = [
        'naslov', 'tijelo_nap', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id')->withDefault();
    }
}
