@extends('layouts.dashboard')

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <td>SN.</td>
                <td>Profile Picture</td>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key=>$user)
                {{-- {{dd($user->roles()->get())}} --}}
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><img src="{{ asset('storage/'.$user->image) }}" alt="" class="img-fluid thumbnail-table"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (count($user->roles) > 0)    
                            @foreach ($user->roles as $role)
                                {{-- {{ $user->roles }} --}}
                                {{ $role->name }}
                            @endforeach
                        @else
                            User
                        @endif
                    </td>
                    <td class="d-flex flex-row">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning mr-2">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center my-4">
        <div class="col-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection