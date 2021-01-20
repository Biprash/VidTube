@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" controls>
                    <source src="{{ asset('storage/'.$video->videoURL) }}" type="video/mp4">
                    Yout browser doesnot support embeded video.
                </video>
            </div>
            <h2 class="my-3">{{ $video->title }}</h2>
            <div class="text-info border-bottom border-info d-flex">
                <div class="mr-auto pb-2">
                    <span>12M views</span>
                    <span class="font-weight-bolder">.</span>
                    <span>3 months ago</span>
                </div>
                <div class="ml-auto d-flex">
                    <div class="border-bottom border-info d-flex">
                        <div class="px-1">
                            <img src="{{ asset('svg/thumb_up.svg') }}" alt="" class="px-1">
                            <span>12K</span>
                        </div>
                        <div class="px-1">
                            <img src="{{ asset('svg/thumb_down.svg') }}" alt="" class="px-1">
                            <span>2K</span>
                        </div>
                    </div>
                    <div class="px-1">
                        <img src="{{ asset('svg/share.svg') }}" alt="" class="px-1">
                        <span>Share</span>
                    </div>
                </div>
            </div>

            <div class="row my-3 align-items-center">
                <div class="col-2 col-md-2 col-lg-2">
                    <img src="https://th.bing.com/th/id/OIP.EaTug7E3jcaapFVnI3ccIQHaEK?pid=Api&rs=1" alt="" class="img-fluid avatar-video rounded-circle">
                </div>
                <div class="col-7 col-md-7 col-lg-8">
                    <h5><a href="{{route('video.index', ['id' => $video->user->id]) }}">{{ $video->user->name }}</a></h5>
                    <span class="text-muted">12M Subscriber</span>
                </div>
                <div class="col-3 col-md-3 col-lg-2">
                    <form action="/subscribe/store/{{ $video->id }}" method="post">
                        @csrf
                        <input type="hidden" name="like" value="like">
                            @if (!$like)            
                            <input type="submit" value="Subscribe" class="btn btn-primary w-100 text-white">
                            @else
                            <input type="submit" value="Unsubscribe" class="btn btn-info w-100">            
                            @endif     
                    </form>
                </div>
            </div>
            <div class="row border-bottom border-info">
                <div class="col-2 col-md-2 col-lg-2"></div>
                <div class="col-9 col-md-7 col-lg-8">
                    <p>{{$video->description}}</p>
                </div>
                <div class="col-md-3 col-lg-2"></div>
            </div>

            <h4 class="py-2">Comments</h4>
            <ul class="list-unstyled">
                <li class="media">
                    <img src="https://th.bing.com/th/id/OIP.EaTug7E3jcaapFVnI3ccIQHaEK?pid=Api&rs=1" class="mr-3 avatar-comment rounded-circle" alt="...">
                    <div class="media-body">
                    <h6 class="mt-0 mb-1">List-based media object</h6>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                  </div>
                </li>
                <li class="media my-4">
                    <img src="https://th.bing.com/th/id/OIP.EaTug7E3jcaapFVnI3ccIQHaEK?pid=Api&rs=1" class="mr-3 avatar-comment rounded-circle" alt="...">
                    <div class="media-body">
                    <h6 class="mt-0 mb-1">List-based media object</h6>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                  </div>
                </li>
                <li class="media">
                    <img src="https://th.bing.com/th/id/OIP.EaTug7E3jcaapFVnI3ccIQHaEK?pid=Api&rs=1" class="mr-3 avatar-comment rounded-circle" alt="...">
                    <div class="media-body">
                    <h6 class="mt-0 mb-1">List-based media object</h6>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                  </div>
                </li>
              </ul>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="row mb-3">
                <div class="col-4 col-sm-4 col-md-3 col-lg-5">
                    <img src="https://th.bing.com/th/id/OIP.EaTug7E3jcaapFVnI3ccIQHaEK?pid=Api&rs=1" alt="" class="img-fluid">
                </div>
                <div class="col-8 col-sm-8 col-md-9 col-lg-7">
                    <h5 class="mb-1 text-truncate">The way to wisdom on the buddha's boat by Rabindra nath Baidya</h5>
                    <p class="m-0 text-info">Aniplex</p>
                    <div class="text-info">
                        <span>12M views</span>
                        <span class="font-weight-bolder">.</span>
                        <span>2 days ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container">
    <h1>Video Details</h1>
    
    <div class="card p-0 col-12">
        <video controls>
            <source src="{{ asset('storage/'.$video->videoURL) }}" type="video/mp4">
            Yout browser doesnot support embeded video.
        </video>
        <div class="card-body">
            <form action="/like/store/{{ $video->id }}" method="post">
                @csrf
                <input type="hidden" name="like" value="like">
                    @if (!$like)            
                    <input type="submit" value="Like" class="btn btn-primary">
                    @else
                    <input type="submit" value="Unlike" class="btn btn-danger">            
                    @endif     
            </form>
            <h5 class="card-title">{{ $video->title }}</h5>
            <p class="card-text">
                {{$video->description}}
            </p>
        </div>
    </div>
    <br>
    <a class="btn btn-primary" href="{{route('video.edit', ['id' => $video->id])}}">Edit</a>
    <form class="form-inline" action="{{route('video.destroy', ['id' => $video->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete</button>
    </form>    

    <br>
    <form action="{{route('comment.store', ['id' => $video->id])}}" method="post">
        @csrf
        <label for="comment">comment</label>
        <input type="text" name="content" id="comment">
        <input type="submit" value="post">
    </form>
    <br>
    @foreach ($comments as $comment)
        <div class="card">
            <p class="cart-text">{{$comment->content}}</p>
        </div>
        <br>
    @endforeach
</div> --}}
@endsection