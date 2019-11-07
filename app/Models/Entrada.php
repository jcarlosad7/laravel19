<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'contenido', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }
}
