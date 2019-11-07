<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        //dd(trim($request->get('texto')));
        $texto=trim($request->get('texto'));

        $entradas=DB::table('entradas')
            ->select('id','titulo','created_at',\DB::raw('SUBSTRING(contenido, 1, 100) as contenido'))
            ->where('titulo','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(10);
         
        return view('blog.index',compact('entradas','texto'));
    }

    public function show($id)
    { 
        $comentarios = DB::table('comentarios')
        ->join('users', 'comentarios.user_id','=', 'users.id')
        ->where('comentarios.entrada_id','=',$id)
        ->select('users.email','comentarios.contenido','comentarios.created_at')
        ->orderBy('comentarios.id','desc')
        ->get();

        $entrada=Entrada::find($id);
        return view('blog.show',compact('entrada','comentarios'));
    }
}
