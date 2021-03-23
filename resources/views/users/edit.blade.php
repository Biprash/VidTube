@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark">
                <div class="card-header m-auto font-weight-bold border-bottom border-primary">Edit User</div>

                <div class="card-body">
                    <form action="{{route('users.update', $user)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label text-md-right">Username:</div>
                            <div class="col-md-8 col-form-label"> {{ $user->name }}</div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-3 col-form-label text-md-right">Role</label>

                            <div class="col-md-8">
                                <select class="form-control" name="role" id="role">
                                    <option>Select role for user</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $title ?? old('title') }}{{ $user->title }}" required autofocus> --}}

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary text-white">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection