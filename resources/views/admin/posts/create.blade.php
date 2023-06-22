@extends('layouts.app')

@section('content')
    <div class="contrainer p-5">
        <h2 class="my-4">
            {{$title}}
        </h2>

        <form action="{{$post->id === null ? route('admin.posts.store') : route('admin.posts.edit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input
                id="title"
                name="title"
                value="{{old('title') ? old('title') : $post->title}}"
                class="form-control"
                placeholder=Titolo
                type="text"
                >
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Descrizione</label>
                <textarea
                class="form-control "
                name="text"
                id="text"
                cols="30"
                rows="10"
                >{{old('title')}}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Aggungi un immagine</label>
                <input
                id="image"
                name="image"
                class="form-control"
                type="file"
                >
            </div>

            <button type="submit" class="btn btn-success">Crea</button>

        </form>


    </div>

        <script>
            ClassicEditor
                .create( document.querySelector( '#text' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

@endsection
