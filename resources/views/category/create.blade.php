@extends('base')
@section('title') Category Create @endsection
@section('content')
<form action="{{ route('category.store') }}" method="post">
    {{ csrf_field() }}
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
