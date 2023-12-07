@extends('layouts.base')

@section('content')
    <div class="container">
        <h1 align="center">Files</h1>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>File Url</th>
                    <th>File Name</th>
                    <th>Owner Name</th>
                    <th>Group Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <th>{{ $file->id }}</th>
                        <th>{{ $file->url }}</th>
                        <th>{{ basename($file->url) }}</th>
                        <td>{{ $file->owner->name }}</td>
                        <td>{{ $file->group->name }}</td>
                        <td>{{ $file->status }}</td>
                        <td>
                            <a href="{{ route('files.checkin', $file->id) }}">Checkin</a>
                            <button type="button" class="btn btn-warning">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
