<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    protected $table = "ticket_user";

    protected $fillable = [
        'user_id' ,  'ticket_id'
    ];

    protected $guarded = [];
}
