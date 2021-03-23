<div class="sidebar bg-dark">
    {{-- <div class="py-4 m-0 navbar-brand d-flex justify-content-center">
        {{ config('app.name', 'Laravel') }}
    </div> --}}
    <div>
        <a class="py-4 m-0 d-flex justify-content-center navbar-brand text-primary" href="{{ url('/') }}">
            {{ config('app.name', 'VidTube') }}
            {{-- VidTube --}}
        </a>
    </div>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('profile.show') }}">Profile</a>
    @can(['create', 'update', 'delete'], App\Models\User::class)
        <a href="{{ route('users.index') }}">Users</a>
    @endcan
    <a href="{{ route('admin.channel') }}">My Videos</a>
    <a href="{{ route('change.password') }}">Change Password</a>
</div>