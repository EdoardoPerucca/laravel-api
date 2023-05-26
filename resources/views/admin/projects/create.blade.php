@extends('layouts.admin')

@section('content')

<h1>Crea un progetto</h1>

<div class="container">
    <form action="{{route('admin.projects.store')}}" method="POST">
    @csrf

        <div class="mb-3">
            <label for="title">Titolo</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
            @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>     
            @enderror
        </div>

        <div class="mb-3">
            <label for="repo">Repo</label>
            <input type="text" name="repo" id="repo" class="form-control @error('repo') is-invalid @enderror" value="{{old('repo')}}">
            @error('repo')
                <div class="invalid-feedback">
                    {{$message}}
                </div>     
            @enderror
        </div>

        <div class="mb-3">
            <label for="content">Contenuto del progetto</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{$message}}
                </div>          
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id">Tipo progetto</label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Nessuna</option>
                    
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
                    @endforeach

                </select>

            @error('content')
            <div class="invalid-feedback">
                {{$message}}
            </div>
                
            @enderror
        </div>

        <div class="mb-3" form-group>
            <h4>Tecnologie</h4>

            <div class="form-check">
                @foreach ($technologies as $technology)
                    <input id="technology_{{$technology->id}}" name="technologies[]" type="checkbox" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
                    <label for="technology_{{$technology->id}}">{{$technology->name}}</label>   
                @endforeach
            </div>
            @error('technologies')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Aggiungi
        </button>
    </form>
</div>
    
@endsection