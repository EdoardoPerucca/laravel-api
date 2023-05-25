@extends('layouts/admin')

@section('content')

<div class="container">


  <div class="py-5">
    
      <h1>{{$project->title}}</h1>

      <h6>Categoria: {{$project->type->name ?? 'nessuna'}}</h6>
  
      <hr>
  
      <p>{{$project->content}}</p>
      
  </div>
  
  <div class="d-flex gap-5">
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