<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contenido', 'user_id','entrada_id'
    ];
    protected $table = 'comentarios';
    protected $primaryKey = 'id';

    public function entrada(){
        return $this->belongsTo('App\Models\Entrada');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

}
