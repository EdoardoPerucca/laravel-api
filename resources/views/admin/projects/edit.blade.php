@extends('layouts.admin')

@section('content')

<h1>Modifica il Progetto</h1>

<div class="container">
    <form action="{{route('admin.projects.update', $project)}}" method="POST">
    @csrf
    @method('PUT')

        <div class="mb-3">
            <label for="title">Titolo</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $project->title}}">
            @error('title')
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
                        <option value="{{$type->id}}" {{$type->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$type->name}}</option>
                    @endforeach

                </select>

            @error('content')
            <div class="invalid-feedback">
                {{$message}}
            </div>
                
            @enderror
        </div>

        <div class="mb-3">
            <label for="repo">Repo</label>
            <input type="text" name="repo" id="repo" class="form-control @error('repo') is-invalid @enderror" value="{{old('repo', $project->repo)}}">
            @error('repo')
                <div class="invalid-feedback">
                    {{$message}}
                </div>     
            @enderror
        </div>

        <div class="mb-3 form-group">
            <h4>Tecnologie</h4>
            
         
            @foreach($technologies as $technology)
            <div class="form-check">
                
                
                @if($errors->any())
                  <input type="checkbox" id="technology-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
                
                  @else
                  <input type="checkbox" id="technology-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked($project->technologies->contains($technology->id))>
                @endif
      
                <label for="technology-{{$technology->id}}">{{$technology->name}}</label>
            </div>
            @endforeach

            @error('technologies') 
              <div class="text-danger">
                {{$message}}
              </div>
            @enderror
      
          </div>

        <div class="mb-3">
            <label for="content">Contenuto del progetto</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{old('content') ?? $project->content}}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Modifica</button>
    </form>
</div>
    
@endsection