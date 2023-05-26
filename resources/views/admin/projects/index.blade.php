@extends('layouts/admin')

@section('content')

<div class="container py-3">

    <h1>Tutti i progetti</h1>

    <Table class="mt-5 mb-5 table table-striped">
        <thead>
            <th>Titolo</th>
            <th>Contenuto</th>
            <th>Repo</th>
            <th>Slug</th>
            <th>Tipologie</th>
    
        </thead>
    
        <tbody>
    
            @foreach ($projects as $singleProject)
                <tr>
                    <td>{{substr($singleProject->title,0,20)."..."}}</td>
                    <td>{{substr($singleProject->content,0,150)."..."}}</td>
                    <td>{{$singleProject->repo}}</td>
                    <td>{{substr($singleProject->slug,0,20)."..."}}</td>
                    <td>{{$singleProject->type?->name}}</td>
    
    
                    <td><a href="{{route('admin.projects.show', $singleProject->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                </tr>     
                
            @endforeach
        </tbody>
    </Table>

</div>


    
@endsection