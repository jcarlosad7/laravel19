@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$entrada->titulo}}
                    </h5>
                    <p class="card-text">{{$entrada->contenido}}
                    </p>
                    <p class="card-text">{{ \Carbon\Carbon::parse($entrada->created_at)->isoFormat('DD MMMM, YYYY - hh:mm A')}}</p>
                    <a href="javascript:history.back()"> Volver Atrás</a>
                </div>
            </div>
        </div>         
    </div>
    <div class="row justify-content-center">
        @if(Session::has('mensaje'))
        <div class="col-sm-6">
            <div class="alert alert-success">
                {{Session::get('mensaje')}}
            </div>
        </div>
        @endif
        @if ($errors->any())
        <div class="col-sm-6">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="{{route('comentario.guardar')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <input type="hidden" name="entrada_id" id="entrada_id" value="{{$entrada->id}}">
                <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="4">
                {{old('contenido')}}
                </textarea>
                <button class="btn btn-primary btn-block" type="submit">Enviar</button>
            </div>
            </form>
        </div>
    </div>
    @if (count($comentarios) <= 0)
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                    <h5 class="card-title">@lang('main.no-records')</h5>
                    <p class="card-text">@lang('main.no-records')</p>
            </div>
        </div>
    </div>
    @else
        @foreach ($comentarios as $comentario)
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <h5 class="card-title">{{$comentario->email}}</h5>
                    <p class="card-text">{{$comentario->contenido}}</p>
                    <p class="card-text">{{ \Carbon\Carbon::parse($comentario->created_at)->isoFormat('DD MMMM, YYYY - hh:mm A')}}</p>                        
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection

