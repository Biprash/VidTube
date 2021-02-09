@extends('layouts.dashboard')

@section('content')
<div class="row align-items-center justify-content-center">
    <div class="col col-md-4 col-lg-4">
        <div class="card bg-dark" style="height: 600px">
            <div class="card-header m-auto font-weight-bold border-bottom border-primary">About Me</div>
            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" class="card-img-rop">
            <div class="card-body">
                <h3>Danie Joe</h3>
                <h5>dannyjoe@demo.com</h5>
            </div>
        </div>
    </div>
    <div class="col col-md-8 col-lg-8">
        <div class="card bg-dark" style="height: 600px">
            <div class="card-header m-auto font-weight-bold border-bottom border-primary">Edit Profile</div>
            <div class="card-body">
                <form action="{{ route('profile.update', ['user' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="profile_pic">Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control" value="">
                    </div>
                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection