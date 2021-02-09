@extends('layouts.dashboard')

@section('content')
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $video)
                <tr>
                    <td>NaN</td>
                    <td>
                        <img src="{{ asset('storage/'.$video->thumbnail) }}" class="img-fluid thumbnail-table" alt="">
                    </td>
                    <td><a href="{{ route('video.show', ['id' => $video->id]) }}">{{ $video->title }}</a></td>
                    <td class="d-flex flex-row">
                        <a href="{{ route('video.edit', ['id' => $video->id]) }}" class="btn btn-warning mr-2">Edit</a>
                        <form action="{{ route('video.destroy', ['id' => $video->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection