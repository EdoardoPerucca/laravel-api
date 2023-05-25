@extends('layouts.admin')

@section('content')

<div class="container py-3">
    <h1>Tutti i progetti della tipologia {{$type->name}}</h1>

    @if(count($type->projects) > 0) 
    
        <Table class="mt-5 mb-5 table table-striped">
            <thead>
                <th>Titolo</th>
                <th>Contenuto</th>
                <th>Slug</th>

            </thead>

            <tbody>

                @foreach ($type->projects as $singleProject)
                    <tr>
                        <td>{{$singleProject->title}}</td>
                        <td>{{$singleProject->content}}</td>
                        <td>{{$singleProject->slug}}</td>

                        <td><a href="{{route('admin.projects.show', $singleProject->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                    </tr>     
                    
                @endforeach
            </tbody>
        </Table>
        
    @else

        <em>Nessun progetto in questa tipologia</em>
        
    @endif

   

    <div class="d-flex justify-content-around">
        <a href="{{route('admin.types.edit', $type)}}" class="btn btn-primary">Modifica la tipologia</a>
        
        
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Elimina
            </button>
    
    </div>

</div>
  
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Elimina la tipologia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Sei sicuro di voler eliminare la tipologia {{$type->name}}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
          
        <form action="{{route('admin.types.destroy', $type)}}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>

        </div>
      </div>
    </div>
  </div>
    
@endsection