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

</div>
    
@endsection