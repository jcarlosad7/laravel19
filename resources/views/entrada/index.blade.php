@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{route('entrada.index')}}" method="get">
    
        <div class="card mb-4">
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" name="texto" id="texto" placeholder="{{Lang::get('main.search')}}" value="{{$texto}}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">@lang('main.search')</button>
                    </span>
                </div>
            </div>
        </form>
        </div>
        @if(Session::has('mensaje'))
        <div class="mb-4">
                <div class="alert alert-warning">
                    {{Session::get('mensaje')}}
                </div>
        </div>        
        @endif
        @if (count($entradas) <= 0)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">@lang('main.no-records')</h5>
                    <p class="card-text">@lang('main.no-records')</p>                    
                </div>
            </div>
        @else
            @foreach ($entradas as $entrada)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{$entrada->titulo}}</h5>
                        <p class="card-text">{{$entrada->contenido}}...</p>
                        <a href="{{route('entrada.show',['entrada'=>$entrada->id])}}" class="btn btn-success">Leer más</a>
                        <a href="{{route('entrada.edit',['entrada'=>$entrada->id])}}" class="btn btn-primary ml-2">Actualizar</a>
                        <a href="" data-target="#modal-delete-{{$entrada->id}}" data-toggle="modal"><button class="btn btn-danger ml-2">Eliminar</button></a>
                    </div>
                </div>
                @include('entrada.modal')
            @endforeach
            {{$entradas->links()}}
        @endif
        
    </div>   
@endsection
