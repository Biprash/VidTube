@extends('layouts.app')

@section('content')
<div class="container">
    @if (request()->get('search'))
        <h5 class="mb-3">Search result for '{{ request()->get('search') }}'</h5>
    @endif
    <div class="row">
        @foreach ($videos as $video)
        <div class="col-6 col-md-4 col-lg-3 d-flex flex-column">
            <a href="{{ route('video.show', $video) }}">
               <img src="{{ asset('storage/'.$video->thumbnail) }}" alt=""  style="height: 155px;  width:100%;" class="img-fluid">
            </a>
            <div class="row py-3">
                <div class="col-2">
                    <a href="{{route('video.index', ['id' => $video->user->id]) }}">
                        <img src="{{ asset('storage/'.$video->user->image) }}" alt="" class="avatar rounded-circle">
                    </a>
                </div>
                <div class="col-10 d-flex flex-column">
                    <h6 class="mb-1 overflow-hidden text-truncate"><a href="{{ route('video.show', $video) }}" class="text-decoration-none">{{ $video->title }}</a></h6>
                    <p class="m-0 text-info"><a href="{{ route('video.index', ['id' => $video->user->id]) }}" class="text-decoration-none">{{ $video->user->name }}</a></p>
                    <div class="text-info">
                        <span>{{ $video->getTotalViews() }} views</span>
                        <span class="font-weight-bolder">.</span>
                        {{-- <span>2 days ago</span> --}}
                        <span id="SQL-date">{{ $video->created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- @foreach ($videos as $video)
        <div class="col-4 p-0 m-2 card">
            <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="thumbnail" class="card-img">
            <div class="card-body">
                <a href="{{route('video.index', ['id' => $video->user->id]) }}" class="card-title">{{ $video->user->name }}</a>
                <h5 class="card-title">{{ $video->title }}</h5>
                <p class="card-text">
                    {{$video->description}}
                </p>
                <a class="btn btn-primary" href="{{route('video.show', ['id' => $video->id])}}">Detail</a>
            </div>
        </div>
    @endforeach --}}
    @if ( count($videos) == 0 )
        <h4 class="py-4">No data found</h4>
    @endif
    @if (method_exists($videos, 'links'))    
        <div class="row justify-content-center my-4">
            <div class="col-3">
                {{ $videos->links() }}
            </div>
        </div>
    @endif
</div>
@endsection







{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

