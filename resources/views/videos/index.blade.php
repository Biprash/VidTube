@extends('layouts.app')

@section('content')

<div class="bg-dark">
    <div class="container">
    <div class="row align-items-center">
        <div class="col col-md-3 col-lg-2 py-3">
            <img src="{{ asset('storage/'.$channel->image) }}" alt="" class="img-fluid subscribed-avatar rounded-circle">
        </div>
        <div class="col col-md-6 col-lg-8">
            <h4>{{$channel->name}}</h4>
            <span class="text-muted">{{ $subscriber_count }} Subscriber</span>
        </div>
        <div class="col col-md-3 col-lg-2">
            <form action="/subscribe/store/{{ $channel->id }}" method="post">
                @csrf
                <input type="hidden" name="like" value="like">
                    @if (!$subscribe_status)            
                    <input type="submit" value="Subscribe" class="btn btn-primary w-100 text-white">
                    @else
                    <input type="submit" value="Unsubscribe" class="btn btn-info w-100">            
                    @endif     
            </form>
        </div>
    </div>
</div>
</div>

<div class="container">

    <div class="row mt-3">

        @foreach ($videos as $video)
        <div class="col-6 col-md-4 col-lg-3 d-flex flex-column">
            <a href="{{route('video.show', ['id' => $video->id])}}">
                <img src="{{ asset('storage/'.$video->thumbnail) }}" style="height: 155px; width:100%;" alt="" class="img-fluid">
             </a>
            <div class="row py-3">
                <div class="col-12 d-flex flex-column">
                    <h6 class="mb-1 overflow-hidden text-truncate"><a href="{{route('video.show', ['id' => $video->id])}}">{{ $video->title }}</a></h6>
                    <div class="text-info">
                        <span>12M views</span>
                        <span class="font-weight-bolder">.</span>
                        <span>{{ $video->created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- <h1> Channel name -{{$channel->name}} | Subscriber Count - {{ $subscriber_count }}</h1>
    
        <form action="/subscribe/store/{{ $channel->id }}" method="post">
            @csrf
            <input type="hidden" name="like" value="like">
                @if (!$subscribe_status)            
                <input type="submit" value="Subscribe" class="btn btn-primary">
                @else
                <input type="submit" value="Unsubscribe" class="btn btn-danger">            
                @endif     
        </form>
    @foreach ($videos as $video)
    <div class="col-4 p-0 m-2 card">
        <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="thumbnail" class="card-img">
        <div class="card-body">
            <h5 class="card-title">{{ $video->title }}</h5>
            <p class="card-text">
                {{$video->description}}
            </p>
            <a class="btn btn-primary" href="{{route('video.show', ['id' => $video->id])}}">Detail</a>
        </div>
    </div>
    @endforeach --}}
</div>
@endsection