<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
    protected $table = 'images';
    //Relación One To Many/ de una a muchos
    public function comments(){
        return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
    }

    //Relacion One To Mamny
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    // Relación de Muchos a Uno
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
