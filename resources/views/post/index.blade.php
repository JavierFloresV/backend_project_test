@extends('base')
@section('title') Inicio @endsection
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ "ID" }}</th>
                <th>{{ "TITLE" }}</th>
                <th>{{ "AUTHOR" }}</th>
                <th>{{ "ACTIONS" }}</th>
            </tr>
        </thead>
        <body>
            @if (count($posts) >= 1)
                @foreach ($posts as $post)
                    <tr>
                        <td scope="row"> {{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td> editar | borrar </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td scope="row"> {{ "no se encontró resultados" }} </td>
                </tr>
            @endif


        </body>
    </table>
@endsection
