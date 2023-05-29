@extends('layouts/admin')

@section('content')

<div class="container">


  <div class="py-5">
    
        <h1>Progetto: {{$project->title}}</h1>
        <h4>Tipologia: {{$project->type ? $project->type->name : 'nessuna'}}</h4>
        <h5>Tecnologie: 
          @foreach ($project->technologies as $technology)
            <span class="badge rounded-pill bg-primary mx-1" style="background-color: {{$technology->color}}">{{$technology->name . ' '}}</span>
          @endforeach</h5>


      <hr>

      <div class="card">
        <div class="card-title p-3"><h3>Repo:</h3></div>
        <div class="card-body">
          <a href="{{$project->repo}}" target="_blank">Github</a>
        </div>
      </div>

      <hr>
  
      <p>{{$project->content}}</p>
      
  </div>
  
  <div class="d-flex justify-content-around">
      <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary">Modifica il progetto</a>
  
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Elimina il progetto
        </button>
        
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il progetto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Sei sicuro di voler eliminare il progetto: <br> "{{$project->title}}"
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
            
              <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                  @csrf
                  @method('delete')
              
                  <button type="submit" class="btn btn-danger">Elimina il progetto</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  
  
  </div>

</div>


    
@endsection