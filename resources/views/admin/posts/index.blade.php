@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('deleted'))

        <div class="alert alert-success" role="alert">
            {{session('deleted')}}
        </div>

        @endif


        <h2 class="fs-4 text-secondary my-4">
            Elenco dei progetti
        </h2>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Data</th>
                <th scope="col">Informazioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td><span class="badge text-bg-primary">{{$post->category?->name}}</span></td>
                    <td>{{$post->date}}</td>
                    <td>
                        <a href="{{route('admin.posts.show',$post)}}" class="btn btn-success"><i class="fa-regular fa-eye"></i></a>
                        <a href="{{route('admin.posts.edit',$post)}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form
                        action="{{route('admin.posts.destroy',$post)}}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('confermi l\'eliminazione del post: {{$post->title}}?')"
                        >

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
