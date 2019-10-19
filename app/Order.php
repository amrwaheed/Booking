<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'id', 'user_id', 'category_id','created_at', 'updated_at'
    ];





}
