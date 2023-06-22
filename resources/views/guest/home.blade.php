@extends('layouts.guest')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Registrati</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.posts.index')}}">Posts</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.posts.create')}}">Crea nuovo post</a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    <h1>Home</h1>
@endsection
