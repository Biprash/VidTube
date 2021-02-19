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
                    <span id="SQL-date">{{ $video->created_at }}</span>
                </div>
                <div class="ml-auto d-flex">
                    <div class="border-bottom border-info d-flex">
                        <div class="px-1 d-flex align-items-center">
                            {{-- <img src="{{ asset('svg/thumb_up.svg') }}" style="color: white" alt="" class="px-1"> --}}
                            <span>
                                <form action="/like/store/{{ $video->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="like" value="like">  
                                        <button type="submit" class="btn-transparent">
                                            <span class="px-1 @if (!empty($like)) @if ($like  === false)                                            
                                            active-svg @endif @endif">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M2 20h2c.55 0 1-.45 1-1v-9c0-.55-.45-1-1-1H2v11zm19.83-7.12c.11-.25.17-.52.17-.8V11c0-1.1-.9-2-2-2h-5.5l.92-4.65c.05-.22.02-.46-.08-.66-.23-.45-.52-.86-.88-1.22L14 2 7.59 8.41C7.21 8.79 7 9.3 7 9.83v7.84C7 18.95 8.05 20 9.34 20h8.11c.7 0 1.36-.37 1.72-.97l2.66-6.15z"/></svg>
                                            </span>
                                        </button>
                                </form>
                            </span>
                                {{-- <span class="px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M2 20h2c.55 0 1-.45 1-1v-9c0-.55-.45-1-1-1H2v11zm19.83-7.12c.11-.25.17-.52.17-.8V11c0-1.1-.9-2-2-2h-5.5l.92-4.65c.05-.22.02-.46-.08-.66-.23-.45-.52-.86-.88-1.22L14 2 7.59 8.41C7.21 8.79 7 9.3 7 9.83v7.84C7 18.95 8.05 20 9.34 20h8.11c.7 0 1.36-.37 1.72-.97l2.66-6.15z"/></svg>
                                </span> --}}
                            <span>{{ $like_count }}</span>
                        </div>
                        <div class="px-1 d-flex align-items-center">
                            {{-- <img src="{{ asset('svg/thumb_down.svg') }}" alt="" class="px-1"> --}}
                            {{-- <span class="px-1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M22 4h-2c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h2V4zM2.17 11.12c-.11.25-.17.52-.17.8V13c0 1.1.9 2 2 2h5.5l-.92 4.65c-.05.22-.02.46.08.66.23.45.52.86.88 1.22L10 22l6.41-6.41c.38-.38.59-.89.59-1.42V6.34C17 5.05 15.95 4 14.66 4h-8.1c-.71 0-1.36.37-1.72.97l-2.67 6.15z"/></svg>
                            </span> --}}
                            <form action="/like/store/{{ $video->id }}" method="post">
                                @csrf
                                <input type="hidden" name="like" value="unlike">  
                                    <button type="submit" class="btn-transparent">
                                        <span class="px-1 @if (!empty($like)) @if ($like  === false)                                            
                                        active-svg @endif @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M22 4h-2c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h2V4zM2.17 11.12c-.11.25-.17.52-.17.8V13c0 1.1.9 2 2 2h5.5l-.92 4.65c-.05.22-.02.46.08.66.23.45.52.86.88 1.22L10 22l6.41-6.41c.38-.38.59-.89.59-1.42V6.34C17 5.05 15.95 4 14.66 4h-8.1c-.71 0-1.36.37-1.72.97l-2.67 6.15z"/></svg>
                                        </span>
                                    </button>
                            </form>
                            <span>{{ $unlike_count }}</span>
                        </div>
                    </div>
                    <div class="px-1">
                        {{-- <img src="{{ asset('svg/share.svg') }}" alt="" class="px-1"> --}}
                        <span class="px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg>
                        </span>
                        <span>Share</span>
                    </div>
                </div>
            </div>

            <div class="row my-3 align-items-center">
                <div class="col-2 col-md-2 col-lg-2">
                    <img src="{{ asset('storage/'.$video->user->image) }}" alt="" class="img-fluid avatar-video rounded-circle">
                </div>
                <div class="col-6 col-md-7 col-lg-8">
                    <h5><a href="{{route('video.index', ['id' => $video->user->id]) }}">{{ $video->user->name }}</a></h5>
                    <span class="text-muted">{{ $subscriber_count }} Subscriber</span>
                </div>
                <div class="col-4 col-md-3 col-lg-2">
                    <form action="/subscribe/store/{{ $video->id }}" method="post">
                        @csrf
                        <input type="hidden" name="like" value="like">
                        @if (empty($subscribe_status))
                            <input type="submit" value="Subscribe" class="btn btn-primary w-100 text-white">
                        @else
                            @if (!$subscribe_status)             
                            <input type="submit" value="Subscribe" class="btn btn-primary w-100 text-white">
                            @else
                            <input type="submit" value="Unsubscribe" class="btn btn-info w-100">            
                            @endif  
                            
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
            <form action="{{route('comment.store', ['id' => $video->id])}}" method="post" class="inline-form">
                @csrf
                <div class="form-group row">
                    <div class="col-9">
                        <input type="text" name="content" placeholder="Add a comment" class="form-control border-0">
                    </div>
                    <input type="submit" value="Comment" class="btn btn-primary text-white col-3">
                </div>
            </form>
            <br>
            <ul class="list-unstyled">
                @foreach ($comments as $comment)
                <li class="media my-2">
                    <img src="https://th.bing.com/th/id/OIP.EaTug7E3jcaapFVnI3ccIQHaEK?pid=Api&rs=1" class="mr-3 avatar-comment rounded-circle" alt="...">
                    <div class="media-body">
                    <h6 class="mt-0 mb-1 font-weight-bold">{{ $comment->user->name }}</h6>
                    <p>{{ $comment->content }}</p>
                  </div>
                </li>
                @endforeach
                {{-- <li class="media">
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
                </li> --}}
              </ul>
        </div>
        <div class="col-md-12 col-lg-4">
            @foreach ($recommended as $video)
            <div class="row mb-3">
                <div class="col-4 col-sm-4 col-md-3 col-lg-5">
                    <a href="{{ route('video.show', $video) }}">
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="col-8 col-sm-8 col-md-9 col-lg-7">
                    <a href="{{ route('video.show', $video) }}">
                        <h5 class="mb-1 text-truncate">{{ $video->title }}</h5>
                    </a>
                    <a href="{{route('video.index', ['id' => $video->user->id]) }}">
                        <p class="m-0 text-info">{{ $video->user->name}}</p>
                    </a>
                    <div class="text-info">
                        <span>12M views</span>
                        <span class="font-weight-bolder">.</span>
                        <span>2 days ago</span>
                    </div>
                </div>
            </div>
            @endforeach
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