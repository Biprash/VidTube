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
            {{-- @foreach ($array as $key=>$value) --}}
            @foreach ($videos as $key=>$video)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$video->thumbnail) }}" class="img-fluid thumbnail-table" alt="">
                    </td>
                    <td><a href="{{ route('video.show', $video) }}" class="text-decoration-none">{{ $video->title }}</a></td>
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

            @if ( count($videos) == 0 )
                <tr>
                    <td></td>
                    <td style="text-align: center">No data found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="row justify-content-center my-4">
        <div class="col-3">
            {{ $videos->links() }}
        </div>
    </div>
@endsection