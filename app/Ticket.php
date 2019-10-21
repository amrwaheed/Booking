<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'ticket_name', 'price'
    ];

    public function  user()
    {
        return $this->belongsToMany('\App\User', 'ticket_user' ,'ticket_id','user_id'  );
    }
}
