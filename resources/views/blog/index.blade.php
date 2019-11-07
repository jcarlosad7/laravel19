@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{route('blog.buscar')}}" method="get">
    
        <div class="card mb-4">
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" name="texto" id="texto" placeholder="Buscar..." value="{{$texto}}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                </div>
            </div>
        </form>
        </div>
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
                        <p class="card-text">{{ \Carbon\Carbon::parse($entrada->created_at)->isoFormat('DD MMMM, YYYY - hh:mm A')}}</p>
                        <a href="{{route('blog.mostrar',['id'=>$entrada->id])}}" class="btn btn-success">Leer más</a>
                    </div>
                </div>
            @endforeach
            {{$entradas->links()}}
        @endif
        
    </div>   
@endsection
