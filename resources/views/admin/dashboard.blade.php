@extends('layouts/admin')

@section('content')

    <h1>Sei nella tua area personale</h1>

    <a href="{{route('admin.projects.index')}}"><button>Visita i progetti</button></a>
    
@endsection