@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark">
                <div class="card-header m-auto font-weight-bold border-bottom border-primary">Create Post</div>

                <div class="card-body">
                    <form action="{{route('video.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf

                        {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $title ?? old('title') }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                {{-- <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required> --}}
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required cols="30" rows="5">{{ $description ?? old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="thumbnail" class="col-md-4 col-form-label text-md-right">Thumbnail</label>

                            <div class="col-md-6">
                                {{-- <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required> --}}
                                <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" id="thumbnail">
                                @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="video" class="col-md-4 col-form-label text-md-right">Video</label>

                            <div class="col-md-6">
                                {{-- <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required> --}}
                                <input class="form-control @error('video') is-invalid @enderror" type="file" name="video" id="video">
                                @error('video')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary text-white">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    <h1>Add VIdeos</h1>
    <form action="{{route('video.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input class="form-control" type="file" name="thumbnail" id="thumbnail">
        </div>
        <div class="form-group">
            <label for="video">Video</label>
            <input class="form-control" type="file" name="video" id="video">
        </div>
        <input class="btn btn-success" type="submit" value="Upload">
    </form>
</div> --}}
@endsection