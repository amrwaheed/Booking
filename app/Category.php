<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'category_name', 'price'
    ];

    public function  user()
    {
        return $this->belongsToMany('\App\User', 'orders' ,'category_id','user_id'  );
    }

}
