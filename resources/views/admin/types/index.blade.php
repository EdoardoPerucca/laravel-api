@extends('layouts.admin')

@section('content')

    <div class="container py-3">
            <h1>Tipologie</h1>
            
        <Table class="mt-5 mb-5 table table-striped">
            <thead>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Slug</th>
                <th>n. tipologie</th>

            </thead>

            <tbody>
                
                @foreach ($types as $singleType)
                    <tr>
                        <td>{{$singleType->name}}</td>
                        <td>{{$singleType->description}}</td>
                        <td>{{$singleType->slug}}</td>
                        <td>{{count($singleType->projects)}}</td>

                        <td><a href="{{route('admin.types.show', $singleType)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                    </tr>     
                    
                @endforeach
            </tbody>
        </Table>
    
    </div>
@endsection