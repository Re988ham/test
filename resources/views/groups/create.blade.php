@extends('layouts.base')

@section('content')
<div class="container">
    <h1>Groups</h1>
    <div class="row">
        <div class="col-md-12">
            <h2>Create a new group</h2>
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
 @endsection
