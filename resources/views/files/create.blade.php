@extends('layouts.base')

@section('content')
    <form action="{{url('files.store')}}" method="POST" enctype="multipart/form-data" class="container">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">File name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="file name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">File description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="file description">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Choose file</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection
