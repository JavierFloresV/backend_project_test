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
                        <td>
                            <a href="{{ route("post.edit", $post->id) }}" class="btn btn-sm btn-primary">EDITAR</a>
                            <form action="{{ route("post.destroy", $post->id )}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('delete the entry?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td scope="row"> {{ "no entries found" }} </td>
                </tr>
            @endif


        </body>
    </table>
@endsection
