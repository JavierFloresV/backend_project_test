@extends('base')
@section('title') Post @endsection
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="btn btn-sm btn-primary" href="{{ route('post.create') }}">+ add</a>
        </li>
      </ul>
      <form action="{{ route('post.search') }}" method="POST" class="d-flex">
        {{ csrf_field() }}
        <div class="input-group">
            <input class="form-control" type="text" name="search" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-light" type="submit"><span class="fas fa-search" aria-hidden="true">Search</span></button>
            </span>
        </div>
      </form>
    </div>
  </div>
</nav>
    <table class="table">
        <thead>
            <tr>
                <th>{{ "ID" }}</th>
                <th>{{ "IMAGEN" }}</th>
                <th>{{ "CATEGORY" }}</th>
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
                        <td scope="row"> <img src="{{ asset('storage').'/'.$post->image }}" width="80" height="80"></td>
                        <td scope="row">{{ $post->category->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td>
                            <a href="{{ route("post.edit", $post->id) }}" class="btn btn-sm btn-secondary">EDITAR</a>
                            <form action="{{ route("post.destroy", $post->id )}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('delete the entry?')">DELETE</button>
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
