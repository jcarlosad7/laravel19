<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Requests\EntradaFormRequest;
use App\Http\Requests\ComentarioFormRequest;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Gate;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texto=trim($request->get('texto'));
        $entradas=DB::table('entradas')
            ->select('id','titulo',\DB::raw('SUBSTRING(contenido, 1, 100) as contenido'))
            ->where('titulo','LIKE','%'.$texto.'%')
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('id','desc')
            ->paginate(10);  
        return view('entrada.index',compact('entradas','texto'));
        
        /*
        $texto = $request->get('texto');

        if($request->get('texto')){
            $entradas = Entrada::where("titulo", "LIKE", "%{$request->get('texto')}%")
                ->paginate(5);
        }else{
            $entradas = Entrada::paginate(5);
        }        

        return view('entrada.index',compact('entradas','texto'));
        */
    }

    public function lista($texto)
    {       
        //dd($texto);
        $entradas=DB::table('entradas')
            ->select('id','titulo','contenido')
            ->where('titulo','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(10);  
        return view('entrada.index',compact('entradas','texto'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('entrada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntradaFormRequest $request)
    {
        $entrada = new Entrada();
        $entrada->titulo=$request->text('titulo');
        $entrada->contenido=$request->input('contenido');
        $entrada->user_id=$request->user()->id;
        $entrada->save();
        return $entrada->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        $comentarios = DB::table('comentarios')
        ->join('users', 'comentarios.user_id','=', 'users.id')
        ->where('comentarios.entrada_id','=',$entrada->id)
        ->select('users.email','comentarios.contenido','comentarios.created_at')
        ->orderBy('comentarios.id','desc')
        ->get();

        return view('entrada.show',compact('entrada','comentarios'));
    }
    public function comentarioGuardar(ComentarioFormRequest $request){
        $comentario = new Comentario();
        $comentario->contenido=$request->input('contenido');
        $comentario->entrada_id=$request->input('entrada_id');
        $comentario->user_id=Auth::user()->id;
        $comentario->save();
        return redirect()
                ->route('entrada.show',['entrada'=>$request->input('entrada_id')])
                ->with('mensaje',trans('main.registered-data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entrada=Entrada::find($id);
        return view('entrada.edit',compact('entrada'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(EntradaFormRequest $request, Entrada $entrada)
    {
        if(Auth::user()->cant('update',$entrada)){
            return redirect()->route('entrada.edit',['entrada'=>$entrada])
                    ->with('mensaje','No tienes permisos para realizar esta acción.');
        }
        else{
        $entrada->titulo=$request->input('titulo');
        $entrada->contenido=$request->input('contenido');
        $entrada->save();
        return redirect()
                ->route('entrada.edit',['entrada'=>$entrada])
                ->with('mensaje','Entrada actualizada');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        if (Gate::denies('deleteEntrada',$entrada)){
            return redirect()->route('entrada.index')
                    ->with('mensaje','No tienes permisos para realizar esta acción.');
        }
        $entrada->delete();
        return redirect()->route('entrada.index');
        
    }
}
